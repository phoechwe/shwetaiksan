<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
               'data' => (object) [],
            ], 200);
        }

        $user = User::where('phone_no', $request->phone_no)->first();
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
               'data' => (object) [],
            ], 200);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Incorrect Password!',
               'data' => (object) [],
            ], 200);
        }

        return response()->json([
            'token' =>  $user->createToken('mobile')->plainTextToken,
            'status' => 200,
            'message' => 'Login Success!',
            'data' => $user,
        ]);
    }

    public  function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|unique:users,phone_no',
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => (object) [],
            ], 200);
        }

        $user = User::create([
            'phone_no' => $request->phone_no,
            'password' => $request->password,
            'name'   => $request->name
        ]);
        $user->roles()->sync(3);

        return response()->json([
            'status' => 200,
            'message' => 'Register Success!',
            'data' => $user,
        ]);
    }

    public function userDetails()
    {
        if (Auth::check()) {

            $authUser = Auth::user();

            return response()->json([
                'status' => 200,
                'message' => 'User Details',
                'data' => $authUser,

            ], 200);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized',
          'data' => (object) [],
        ], 200);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

         return response()->json([
            'status' => 200,
            'message' => 'Logout success!',
          'data' => (object) [],
        ], 200);
    }

    public function test()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Test Success!',
            'data' => [],
        ]);
    }
    public function testPost(Request $request)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Test Post Success!',
            'data' => $request->all(),
        ]);
    }
}
