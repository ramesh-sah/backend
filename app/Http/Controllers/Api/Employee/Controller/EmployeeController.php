<?php

namespace App\Http\Controllers\Api\Employee\Controller;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Employee\Model\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class EmployeeController extends BaseController
{
    /**
     * Register a new admin user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerEmployee(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required',
            'username' => 'required|string|unique:employees,username',
            'email' => 'required|email|regex:/@patancollege\.edu\.np$/|unique:admins,email',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:8',
            'address' => 'required|string',
            'role' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'contact_number' => 'required|digits:10',
            'enrollment_year' => 'required',
            'account_status' => 'required|in:active,inactive,suspended',
            'image_link' => 'nullable|url',
        ]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'username' => $request->username,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'role' => $request->role,
            'contact_number' => $request->contact_number,
            'enrollment_year' => $request->enrollment_year,
            'account_status' => $request->account_status,
            'image_link' => $request->image_link,
        ]);

        $token = $employee->createToken('admin token', ['employee'])->plainTextToken; //created the admin token

        return response()->json([
            'data' => [
                'employee data' => $employee->jsonSerializer(),
                'token' => $token,
            ]
        ], 201);
    }

    public function logoutEmployee(Request $request)
    {
        //check and  validate the token and then delete the token
        $token = $request->user('employee')->currentAccessToken();
        $request->user('employee')->tokens()->where('id', $token->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee  logged out successfully',
        ], 200);
    }

    public function loginEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            return response()->json([
                'message' => 'Invalid password provided.',
            ], 401);
        }

        $token = $employee->createToken('mytoken', ['employee'])->plainTextToken; //created the admin token after the login

        return response()->json([
            'employee data' => $employee,
            'token' => $token,
        ], 201);
    }

    public function index()
    {
        // Fetch all the admin objects
        return Employee::all();
    }

    public function show(string $user_id)
    {
        // Find the specific admin resource
        $admin = Employee::find($user_id);
        if (!$admin) {
            return response()->json([['message' => 'Admin user not found'], 404]);
        }
        return $admin;
    }
}
