<?php

namespace App\Services\Contracts;

interface UserService {
    public function login(array $credentials): bool;

    public function createUser(array $data): void;

    public function updateUser(string $id, array $data);

    public function deleteUser(string $id);
}