<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface UserService {
    public function login(array $credentials): bool;

    public function getUsers(): JsonResponse;

    public function findUser(string $id): Collection|User;

    public function createUser(array $data): bool;

    public function updateUser(string $id, array $data): bool;

    public function deleteUser(string $id): bool;
}