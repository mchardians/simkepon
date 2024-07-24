<?php

namespace App\Services\Implementations;

use Carbon\Carbon;
use App\Models\Santri;
use App\Models\WaliSantri;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Contracts\SantriService;

class SantriServiceImp implements SantriService {

    /**
     *
     * @param string|null $gender
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSantris(string $gender = null): \Illuminate\Http\JsonResponse {
        $query = Santri::query()->select(['id', 'nis', 'name', 'gender', 'birth_place', 'birth_date']);

        if($gender !== null) {
            $query = Santri::query()->select(['id', 'nis', 'name', 'gender', 'birth_place', 'birth_date'])->where('gender', '=', $gender);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('gender', function ($data) {
                return ($data->gender == 'laki-laki') ? 'Laki-laki' : 'Perempuan';
            })
            ->editColumn('birth_place', function ($data) {
                return ucwords($data->birth_place);
            })
            ->editColumn('birth_date', function ($data) {
                return Carbon::parse($data->birth_date)->translatedFormat('d F Y');
            })
            ->addColumn('action', function ($data) {
                return (
                    '<button class="btn btn-action btn-primary mr-1 btn-edit" id="'.$data->id.'" data-toggle="modal" data-target="#editModal">
                        <i class="far fa-edit"></i>
                    </button>'.
                    '<button class="btn btn-action btn-danger mr-1 btn-delete" id="'.$data->id.'"><i class="fas fa-trash"></i></button>'.
                    '<a class="btn btn-action btn-info btn-detail" href="'.route('admin.santri.show', $data->id).'"><i class="fas fa-info-circle"></i></a>'
                );
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *
     * @param string $id
     * @return \App\Models\Santri|\Illuminate\Database\Eloquent\Collection
     */
    public function findSantri(string $id): Santri|\Illuminate\Database\Eloquent\Collection {
        return Santri::findOrFail($id);
    }

    /**
     *
     * @param array $data
     * @return bool
     */
    public function createSantri(array $data): bool {
        $santri = new Santri();
        $santri->fill($data);

        return $santri->save();
    }

    /**
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateSantri(string $id, array $data): bool {
        return Santri::findOrFail($id)->update($data);
    }

    /**
     *
     * @param string $id
     * @return bool
     */
    public function deleteSantri(string $id): bool {
        $santri = Santri::findOrFail($id);

        if(Storage::disk('public')->exists('santri/'.$santri["picture"])) {
            Storage::disk('public')->delete('santri/'.$santri["picture"]);
        }

        return $santri->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWaliSantris(): \Illuminate\Database\Eloquent\Collection {
        return WaliSantri::query()->select(['id', 'name', 'nik'])->get();
    }
    /**
     *
     * @param string $id
     * @return Santri|\Illuminate\Database\Eloquent\Collection
     */
    public function getDetailsSantri(string $id): Santri|\Illuminate\Database\Eloquent\Collection {
        return Santri::with('walisantri')->findOrFail($id);
    }

    /**
     * @param string $params
     * @return Santri|\Illuminate\Database\Eloquent\Collection
     */
    public function showSantrisByNameOrNis($params): Santri|\Illuminate\Database\Eloquent\Collection {
        return Santri::query()->select(['id', 'nis', 'name'])
            ->where('name', 'like', '%'.$params.'%')
            ->orWhere('nis', 'like', '%'.$params.'%')
            ->get();
    }
}