<?php

namespace App\Http\Controllers;


use Cookie;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateInfoRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Partner;
use App\Models\Roles;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    //
    public function register(Request $request)
    {
        //valdiate
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|unique:users|unique:partners',
            'phone' => ['required', 'regex:/^[0-9]{8}$/'],
            'password' => 'required|string|min:6',
            'roleId' => 'exists:roles,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors(),
                "status" => 400
            ]);
        }
        //create new user in users table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->roleId
        ]);

        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];
        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        // validate inputs
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid input',
                'errors' => $validator->errors(),
                'status' => 400
            ]);
        }

        // find user by email in users or partners table
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = Partner::where('email', $request->email)->first();
        }

        if (!$user || $user->status == 'INACTIVE') {
            return response()->json([
                'message' => 'Incorrect email or password',
                'status' => 401
            ]);
        }

        $user_role = $user->Roles;

        if ($request->path() === 'api/admin/login') {
            // admin login
            if ($user_role->type != "admin") {
                return response()->json([
                    "message" => "Access Denied",
                    "status" => 401
                ]);
            }

            if (Hash::check($request->password, $user->password)) {
                // if user email found and password is correct
                $scope = 'admin';
                $token = $user->createToken('token', [$scope])->plainTextToken;

                return response([
                    "status" => 200,
                    'message' => 'success',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    "message" => 'Incorrect email or password',
                    "status" => 401
                ]);
            }
        } elseif ($request->path() === 'api/user/login') {
            // user login
            if ($user_role->type != "user") {
                return response()->json([
                    "message" => "Access Denied",
                    "status" => 401
                ]);
            }

            if (Hash::check($request->password, $user->password)) {
                // if user email found and password is correct
                $scope = 'user';
                $token = $user->createToken('token', [$scope])->plainTextToken;

                return response([
                    "status" => 200,
                    'message' => 'success',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    "message" => 'Incorrect email or password',
                    "status" => 401
                ]);
            }
        } elseif ($request->path() === 'api/partner/login') {
            // partner login
            if ($user_role->type != "partner") {
                return response()->json([
                    "message" => "Access Denied",
                    "status" => 401
                ]);
            }

            if (Hash::check($request->password, $user->password)) {
                // if user email found and password is correct
                $scope = 'partner';
                $token = $user->createToken('token', [$scope])->plainTextToken;

                return response([
                    "status" => 200,
                    'message' => 'success',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    "message" => 'Incorrect email or password',
                    "status" => 401
                ]);
            }
        } else {
            return response()->json([
                "message" => "Invalid request path",
                "status" => 400
            ]);
        }
    }

    public function user(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $request->user();
        $user->update($request->only('name', 'email', 'phone'));
        return response($user, Response::HTTP_ACCEPTED);
    }


    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);
        return response($user, Response::HTTP_ACCEPTED);
    }
}
