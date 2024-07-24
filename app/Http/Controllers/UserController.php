<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\UserService;
use App\Services\Contracts\WaliSantriService;
use Exception;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    private UserService $userService;
    private WaliSantriService $waliSantriService;

    public function __construct(UserService $userService, WaliSantriService $waliSantriService) {
        $this->userService = $userService;
        $this->waliSantriService = $waliSantriService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            return $this->userService->getUsers();
        }

        return;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            if(request()->ajax()) {
                if(request()->has('walisantri_id')) {
                    $walisantri = $this->waliSantriService->findWaliSantri(request()->get('walisantri_id'));

                    return response()->json([
                        "success" => true,
                        "data" => $walisantri
                    ]);
                }

                $walisantris = $this->waliSantriService->getDataWaliSantri();

                if(request()->has('search')) {
                    $walisantris = $this->waliSantriService->getDataWaliSantri(request()->get('search'));
                }

                return response()->json([
                    "success" => true,
                    "data" => $walisantris
                ]);
            }

            return;
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
                "name" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:8",
                "role_id" => "required"
            ]);

            if($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $isSuccess = $this->userService->createUser($validator->validated());

            if(!$isSuccess) {
                throw new HttpException(422, "Failed to create user");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "User created successfully.",
            ], 200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = $this->userService->findUser($id);

            return response()->json([
                "success" => true,
                "status" => 200,
                "data" => $user
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
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
                "name" => "required",
                "email" => "required|email|unique:users,email,".$id,
            ]);

            if($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $isSuccess = $this->userService->updateUser($id, $validator->validated());

            if(!$isSuccess) {
                throw new HttpException(422, "Failed to update user");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "User updated successfully.",
            ], 200);
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
            $isSuccess = $this->userService->deleteUser($id);

            if(!$isSuccess) {
                throw new HttpException(422, "Failed to delete user");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "User deleted successfully.",
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }
}
