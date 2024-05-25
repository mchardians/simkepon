<?php

namespace App\Services\Implementations;
use Illuminate\Support\Facades\Auth;
use App\Services\Contracts\UserService;

class UserServiceImp implements UserService {
    /**
     *
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool {
        return Auth::attempt($credentials);
    }

    /**
     *
     * @param array $data
     */
    public function createUser(array $data): void {
    }

    /**
     *
     * @param string $id
     * @param array $data
     */
    public function updateUser(string $id, array $data) {
    }
    
    /**
     *
     * @param string $id
     */
    public function deleteUser(string $id) {
    }
}