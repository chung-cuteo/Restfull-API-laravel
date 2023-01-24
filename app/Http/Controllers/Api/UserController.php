<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $where = [];

        if ($request->name) {
            $where[] = ['name', 'like', '%' . $request->name . '%'];
        }

        $user = User::orderBy('id', 'desc');

        if (!empty($where)) {
            $user = $user->where($where);
        }

        $user = $user->get();

        $status = 'get fail';

        if ($user->count() > 0) {
            $status = 'get success';
        };

        $reponse = [
            'status' => $status,
            'data' => $user,
        ];

        return $reponse;
    }

    public function detail($id)
    {
        $user = User::find($id);

        $status = 'not user';
        if ($user) {
            $status = 'get success';
        }

        $reponse = [
            'status' => $status,
            'data' => $user,

        ];

        return $reponse;
    }

    public function create(Request $request)
    {
        $rules = $request->validate(
            [
                'name' => 'required|min:5',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5',
            ],
            [
                'name.required' => 'ten phai nhap bat buoc',
                'name.min' => 'ten phai lon hon 5 ki tu',
                'email.required' => 'email phai dk nhap',
                'email.email' => 'email phai dung dinh dang',
                'name.unique' => 'email phai khong dk trung',
                'name.required' => 'password phai phai nhap',
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        if ($user->id) {
            $reponse = [
                'status' => 'update succes',
                'data' => $user,
            ];
        } else {
            $reponse = [
                'status' => 'update fail',
                'data' => $user,
            ];
        }

        return $reponse;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $method =  $request->method();

        if (!$user) {
            $reponse = [
                'status' => 'no data',
                'data' => $user
            ];
            return $reponse;
        } else {
            if ($method == 'PUT') {
                $user->name = $request->name;
                $user->email = $request->email;
                if ($user->password) {
                    $user->password = Hash::make($request->password);
                };

                $user->save();

                $reponse = [
                    'status' => 'update success',
                    'data' => $user
                ];

                return $reponse;
            } else {
                if ($request->name) {
                    $user->name = $request->name;
                }
                if ($request->email) {
                    $user->email = $request->email;
                }
                if ($request->password) {
                    $user->password = $request->password;
                }

                $user->save();

                $reponse = [
                    'status' => 'update success',
                    'data' => $user
                ];

                return $reponse;
            };
        }
    }

    public function delete(Request $request, User $user)
    {
        return $user;
    }
}
