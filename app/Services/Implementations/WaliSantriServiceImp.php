<?php

namespace App\Services\Implementations;

use App\Models\WaliSantri;
use App\Services\Contracts\WaliSantriService;
use Yajra\DataTables\Facades\DataTables;

class WaliSantriServiceImp implements WaliSantriService
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWaliSantris(): \Illuminate\Http\JsonResponse {
        $query = WaliSantri::query()->select(['id', 'nik', 'name', 'email', 'education', 'job', 'phone']);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('education', function($data) {
                switch ($data->education) {
                    case 'sd':
                        return ucwords('SD/ Sederajat');
                    case 'smp':
                        return ucwords('SMP/ Sederajat');
                    case 'sma':
                        return ucwords('SMA/ Sederajat');
                    case 'diploma':
                        return ucwords('Diploma I-III');
                    case 'sarjana':
                        return ucwords('Diploma IV/ Strata I');
                    case 'magister':
                        return ucwords('Strata II');
                    case 'doktor':
                        return ucwords('Strata III');
                    default:
                        return ucwords($data->education);
                }
            })
            ->addColumn('action', function ($data) {
                return (
                    '<button class="btn btn-action btn-primary mr-1 btn-edit" id="'.$data->id.'" data-toggle="modal" data-target="#editModal">
                        <i class="far fa-edit"></i>
                    </button>'.
                    '<button class="btn btn-action btn-danger btn-delete" id="'.$data->id.'"><i class="fas fa-trash"></i></button>'
                );
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *
     * @param string $id
     * @return \App\Models\WaliSantri|\Illuminate\Database\Eloquent\Collection
     */
    public function findWaliSantri(string $id): WaliSantri|\Illuminate\Database\Eloquent\Collection {
        return WaliSantri::findOrFail($id);
    }

    /**
     *
     * @param array $data
     * @return bool
     */
    public function createWaliSantri(array $data): bool {
        $data["phone"] = str_replace(" ", "", $data["phone"]);

        $walisantri = new WaliSantri();
        $walisantri->fill($data);
        return $walisantri->save();
    }
    /**
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateWaliSantri(string $id, array $data): bool {
        $data["phone"] = str_replace(" ", "", $data["phone"]);

        return WaliSantri::findOrFail($id)->update($data);
    }

    /**
     *
     * @param string $id
     * @return bool
     */
    public function deleteWaliSantri(string $id): bool {
        return WaliSantri::findOrFail($id)->delete();
    }



}