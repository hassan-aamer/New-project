<?php

namespace App\Services\Auth;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    //All Users
    public function allUsers()
    {
        $users = User::all();
        return response()->json([
            'status' => true,
            'message' => 'All Users Successfully',
            'data' => UserResource::collection($users),
        ], 200);
    }

    // Registers Users
    public function register($request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:8|confirmed',
                    'phone' => 'required|string|unique:users,phone|regex:/^01[0125][0-9]{8}$/|size:11',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                "user" => new UserResource($user),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // Login Users
    public function login($request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validateUser->errors(),
                ]);
            }

            $user = new UserResource(User::where('email', $request->email)->first());

            if (!Auth::guard('api')->attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                "user" => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    //Logout User
    public function logout($request)
    {
        Auth::logout();
        return response(["status" => true, "message" => "Logout success"], 200);
    }


    // Update User
    public function update($request, $id)
    {
        try {
            // التحقق من وجود المستخدم
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 404);
            }

            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'phone' => 'required|string|unique:users,phone|regex:/^01[0125][0-9]{8}$/|size:11',
                    'password' => 'sometimes|required|string|min:8|confirmed',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validateUser->errors()
                ], 422); // استخدم 422 للإشارة إلى أن البيانات غير صالحة
            }

            // تحديث بيانات المستخدم
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'user' => new UserResource($user),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // Delete One User From ID
    public function delete($id)
    {
        User::destroy($id);
        return response(["status" => true, "message" => "deleted success"], 200);
    }


    //Get One User From ID
    public function show($id)
    {
        $user = new UserResource(User::find($id));

        if (!$user) {
            return response([
                "status" => false,
                "user" => null,
                "message" => "User not found",
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Get One User successfully',
            'user' => $user,
        ], 200);
    }
}
