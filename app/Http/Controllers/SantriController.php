<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\Contracts\SantriService;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SantriController extends Controller
{
    private SantriService $santriService;

    public function __construct(SantriService $santriService) {
        $this->santriService = $santriService;
    }

    public function dashboard() {
        $totalSantri = Santri::count();
        $santriwan = Santri::query()->where('gender', '=', 'laki-laki')->count();
        $santriwati = Santri::query()->where('gender', '=', 'perempuan')->count();

        return view('pages.admin.dashboard', ['santriwan' => $santriwan, 'santriwati' => $santriwati, 'totalSantri' => $totalSantri]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(request()->ajax()) {
            if($request->has('gender')) {
                if($request->gender !== null) {
                    return $this->santriService->getSantris($request->gender);
                }
            }

            return $this->santriService->getSantris();
        }

        $totalSantri = Santri::count();
        $totalSantriwan = Santri::query()->where('gender', '=', 'laki-laki')->count();
        $totalSantriwati = Santri::query()->where('gender', '=', 'perempuan')->count();

        return view('pages.admin.santri', [
            'totalSantri' => $totalSantri,
            'totalSantriwan' => $totalSantriwan,
            'totalSantriwati' => $totalSantriwati
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return response()->json([
                'wali_santri' => $this->santriService->getWaliSantris(),
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nis' => 'required|min:18|max:18|unique:santri,nis',
                'name' => 'required',
                'gender' => 'required',
                'birth_place' => 'required',
                'birth_date' => 'required|date|date_format:d-m-Y',
                'wali_santri_id' => 'required|exists:wali_santri,id',
                'address' => 'required',
                'picture' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ]);
            }

            if ($request->hasFile('picture')) {
                $picture = $request->file('picture');
                $validatedData = $validator->validated();

                $pictureName = $validatedData['nis'] . '.' . $picture->getClientOriginalExtension();

                $validatedData["birth_date"] = date('Y-m-d', strtotime($validatedData["birth_date"]));
                $validatedData["picture"] = $pictureName;

                $isSuccess = $this->santriService->createSantri($validatedData);

                if (!$isSuccess) {
                    throw new HttpException(422, 'Gagal menyimpan data santri');
                }

                $picture->storePubliclyAs('santri', $pictureName, ['disk' => 'public']);

                return response()->json([
                    "success" => $isSuccess,
                    "status" => 200,
                    "message" => "Santri created successfully!",
                ]);
            }

            $validatedData = $validator->validated();
            $validatedData["birth_date"] = date('Y-m-d', strtotime($validatedData["birth_date"]));

            $isSuccess = $this->santriService->createSantri($validatedData);

            if (!$isSuccess) {
                throw new HttpException(422, 'Gagal menyimpan data santri');
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Santri created successfully!",
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $details = $this->santriService->getDetailsSantri($id);

            return view('pages.admin.detail-santri', compact('details'));
        } catch (HttpException $e) {
            Log::error("Error fetching santri details: " . $e->getMessage());

            return view('pages.fallback.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $santri = $this->santriService->findSantri($id);

            if(isset($santri["picture"])) {
                $santri["url"] = asset("storage/santri/".$santri["picture"]);
            }

            return response()->json([
                "success" => true,
                "status" => 200,
                "data" => $santri
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nis' => 'required|min:18|max:18|unique:santri,nis,'.$id,
                'name' => 'required',
                'gender' => 'required',
                'birth_place' => 'required',
                'birth_date' => 'required|date|date_format:d-m-Y',
                'wali_santri_id' => 'required|exists:wali_santri,id',
                'address' => 'required',
                'picture' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ]);
            }

            if ($request->hasFile('picture')) {
                $validatedData = $validator->validated();
                $picture = $request->file('picture');
                $pictureName = $validatedData['nis'] . '.' . $picture->getClientOriginalExtension();

                $santri = $this->santriService->findSantri($id);

                if(Storage::disk('public')->exists('santri/'.$santri["picture"])) {
                    Storage::disk('public')->delete('santri/'.$santri["picture"]);
                }

                $validatedData["birth_date"] = date('Y-m-d', strtotime($validatedData["birth_date"]));
                $validatedData["picture"] = $pictureName;

                $isSuccess = $this->santriService->updateSantri($id, $validatedData);

                if (!$isSuccess) {
                    throw new HttpException(422, 'Gagal menyimpan data santri');
                }

                $picture->storePubliclyAs('santri', $pictureName, ['disk' => 'public']);

                return response()->json([
                    "success" => $isSuccess,
                    "status" => 200,
                    "message" => "Santri updated successfully!",
                ]);
            }

            $validatedData = $validator->validated();
            $validatedData["birth_date"] = date('Y-m-d', strtotime($validatedData["birth_date"]));

            $isSuccess = $this->santriService->updateSantri($id, $validatedData);

            if (!$isSuccess) {
                throw new HttpException(422, 'Gagal menyimpan data santri');
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Santri updated successfully!",
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $isSuccess = $this->santriService->deleteSantri($id);

            if (!$isSuccess) {
                throw new HttpException(422, 'Gagal menghapus data santri');
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Santri deleted successfully!",
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    public function report() {
        $totalSantri = Santri::count();
        $totalSantriwan = Santri::query()->where('gender', '=', 'laki-laki')->count();
        $totalSantriwati = Santri::query()->where('gender', '=', 'perempuan')->count();

        return view('pages.admin.laporan-santri', [
            'totalSantri' => $totalSantri,
            'totalSantriwan' => $totalSantriwan,
            'totalSantriwati' => $totalSantriwati
        ]);
    }
}
