<?php

namespace App\Http\Controllers\Api\AdminUser\Controller;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AdminUser\Model\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    /**
     * Register a new admin user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'parent_table' => 'required|string',
            'username' => 'required|string|unique:admins,username',
            
            'email' => 'required|email|regex:/@patancollege\.edu\.np$/|unique:admins,email',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'mobile' => 'nullable|string',
            'status' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $admin = Admin::create([
            'parent_table' => $request->parent_table,
            'username' => $request->username,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'is_active' => $request->is_active,
        ]);

        $token = $admin->createToken('admin token', ['admin'])->plainTextToken; //created the admin token

        return response()->json([[
            'data' => [
                'admin user' => $admin->jsonSerialize(),
                'token' => $token,
            ]
        ], 201]);
    }

    public function logoutAdmin(Request $request)
    { 
        //check and  validate the token and then delete the token
        $token = $request->user('admin')->currentAccessToken();
        $request->user('admin')->tokens()->where('id', $token->id)->delete();

        return response()->json([[
            'success' => true,
            'message' => 'Admin user logged out',
        ], 200]);
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([[
                'message' => 'Invalid password provided.',
            ], 401]);
        }

        $token = $admin->createToken('mytoken', ['admin'])->plainTextToken; //created the admin token after the login

        return response()->json([[
            'admin user' => $admin->toArray(),
            'token' => $token,
        ],201]);
    }

    public function index()
    {
        // Fetch all the admin objects
        return Admin::all();
    }

    public function show(string $user_id)
    {
        // Find the specific admin resource
        $admin = Admin::find($user_id);
        if (!$admin) {
            return response()->json([['message' => 'Admin user not found'], 404]);
        }
        return $admin;
    }
}
