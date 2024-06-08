<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\UserService;
use Illuminate\Support\Facades\Validator;
use App\Services\Contracts\WaliSantriService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class WaliSantriController extends Controller
{
    private WaliSantriService $waliSantriService;

    public function __construct(WaliSantriService $waliSantriService) {
        $this->waliSantriService = $waliSantriService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            return $this->waliSantriService->getWaliSantris();
        }

        return view('pages.admin.wali-santri');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|min:16|unique:wali_santri,nik',
                'name' => 'required',
                'email' => 'required|email|unique:wali_santri,email',
                'education' => 'required',
                'job' => 'required',
                'phone' => 'required|unique:wali_santri,phone|min:13|max:15',
                'address' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $isSuccess = $this->waliSantriService->createWaliSantri($validator->validated());

            if (!$isSuccess) {
                throw new HttpException(422, "Failed to create wali santri");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Wali Santri created successfully.",
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $walisantri = $this->waliSantriService->findWaliSantri($id);

            return response()->json([
                "success" => true,
                "status" => 200,
                "data" => $walisantri
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
                'nik' => 'required|min:16|unique:wali_santri,nik,'.$id,
                'name' => 'required',
                'email' => 'required|email|unique:wali_santri,email,'.$id,
                'education' => 'required',
                'job' => 'required',
                'phone' => 'required|min:13|max:15|unique:wali_santri,phone,'.$id,
                'address' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $isSuccess = $this->waliSantriService->updateWaliSantri($id, $validator->validated());

            if (!$isSuccess) {
                throw new HttpException(422, "Failed to update wali santri");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Wali Santri updated successfully.",
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $isSuccess = $this->waliSantriService->deleteWaliSantri($id);

            if (!$isSuccess) {
                throw new HttpException(422, "Failed to delete wali santri");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Wali Santri deleted successfully.",
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }
}
