<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    private $isSuccess;
    private $exception;

    public function __construct()
    {
        $this->isSuccess = true;
        $this->exception = "";

    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required',
           'password' => 'required',
           'email' => 'required|email|unique:users',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'erorr' => $validator->errors()->getMessages()
            ], 201);
        }

        $data = [];
        DB::connection()->beginTransaction();
        try {
            
            $store = User::Create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password)

            ]);


            DB::connection()->commit();
        } catch (\Exception $error) {
            DB::connection()->rollBack();
            $this->isSuccess = false;
            $this->exception = $error;
        }
        return response()->json([
            "status" => $this->isSuccess ?? false,
            "code" => $this->isSuccess ? 200 : 600,
            "message" => $this->isSuccess ? "Save data success!" : $this->exception->getMessage(),
            "data" => $this->isSuccess ? $store : []
        ], 201);
    }

    //function Login User
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => 'required',
            "password" => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->getMessages()
            ]);
        }

        $checkLogin = DB::table('users')->where([
            ["no_hp", $request->email]
        ])->first();

        if ($checkLogin) {
            if (Hash::check($request->password, $checkLogin->password)) {
                return response()->json([
                    "status" => true,
                    "code" => 201,
                    "message" => "Login Success",
                    "data" => [
                        "detail_user" => $checkLogin
                    ]
                ], 201);
            } else {
                return response()->json([
                    "status" => false,
                    "code" => 600,
                    "message" => "Login Failded, Wrong Password!",
                    "data" => []
                ], 201);
            }
        } else {
            return response()->json([
                "status" => false,
                "code" => 600,
                "message" => "Login Failed",
            ], 201);
        }
    }


    // edit user 
    public function updateUser(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     "email" => 'required',
        //     // "password" => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         "error" => $validator->errors()->getMessages()
        //     ]);
        // }

        // $checkEmail = DB::table('users')->where([
        //     ["email", $request->email]
        // ])->first();

        // if($checkEmail->id != $request->id){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Email sudah digunakan!',
        //     ], 401);
        // }

        $update = User::whereId($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'role' => 'customer',
            'no_hp' => $request->no_hp,
        ]);

        if ($update) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Diupdate!',
                'data' => User::whereId($request->id)->first()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Diupdate!',
            ], 401);
        }

    }
}
