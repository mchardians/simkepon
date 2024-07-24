<?php

namespace App\Services\Implementations;
use App\Models\User;
use App\Models\WaliSantri;
use Illuminate\Support\Facades\Auth;
use App\Services\Contracts\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

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
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse {
        $query = User::query()->select(['users.id as id', 'users.name as name', 'email', 'roles.name as role'])
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where('roles.name', '=', 'walisantri');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('role', function ($data) {
                return ucwords((substr($data->role, 0, 4)." ".substr($data->role, 4)));
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
     */
    public function findUser(string $id): Collection|User {
        return User::findOrFail($id);
    }

    /**
     *
     * @param array $data
     */
    public function createUser(array $data): bool {
        $data['password'] = bcrypt($data['password']);

        $user = new User();
        $user->fill($data);
        return $user->save();
    }

    /**
     *
     * @param string $id
     * @param array $data
     */
    public function updateUser(string $id, array $data): bool {
        return User::findOrFail($id)->update($data);
    }

    /**
     *
     * @param string $id
     */
    public function deleteUser(string $id): bool {
        return User::findOrFail($id)->delete();
    }

}