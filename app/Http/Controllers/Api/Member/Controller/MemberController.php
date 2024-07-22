<?php

namespace App\Http\Controllers\Api\Member\Controller;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Member\Model\Member;
use Illuminate\Support\Facades\Hash;

class MemberController extends BaseController
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerMember(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'roll_number' => 'required|integer',
            'username' => 'required| string |max:20|unique:members,username',
            'address' => 'required|string|max:500',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|regex:/@patancollege\.edu\.np$/|unique:members,email',
            'password' => 'required|string|min:8',
            'contact_number' => 'required|digits:10',
            'enrollment_year' => 'required|integer|min:1900|max:' . date('Y'),
            'image_link' => 'nullable|url',
        ]);

        $member = Member::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'roll_number' => $request->roll_number,
            'username' => $request->username,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_number' => $request->contact_number,
            'enrollment_year' => $request->enrollment_year,
            'account_status' => $request->account_status,
            'image_link' => $request->image_link,

        ]);

        $token = $member->createToken('mytoken', ['member'])->plainTextToken;

        return response()->json([[
            [ // Wrap the data in an array
                'data' => [
                    'member' => $member,
                    'token' => $token,
                ]
            ]
        ], 201]);
    }

    public function logoutMember(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $request->user()->tokens()->where('id', $token->id)->delete();

        return response()->json([[

            [
                'success' => true,
                'message' => 'User logged out',
            ],
        ], 200]);
    }

    public function loginMember(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $member = Member::where('email', $request->email)->first();

        if (!$member || !Hash::check($request->password, $member->password)) {
            return response()->json([[
                'message' => 'Invalid password provided.',
            ], 401]);
        }

        $token = $member->createToken('mytoken', ['member'])->plainTextToken;

        return response()->json([
            [
                'user' => $member,
                'token' => $token,
            ]
        ], 200);
    }
    public function index()
    {
        // Fetch all the Publisher objects
        return Member::all(); // Use the correct model name
    }


    public function show(string $user_id)
    {
        // Find the specific resource
        $member = Member::find($user_id); // Use the correct model name
        if (!$member) {
            return response()->json([['message' => 'User Not Found not found'], 404]); // Handle not found cases
        }
        return response()->json($member);
    }

    // public function update(Request $request, string $id)
    // {
    //     // Update the resource
    //     $publisher = User::find($id); // Use the correct model name
    //     if (!$publisher) {
    //         return response()->json(['message' => 'Publisher not found'], 404); // Handle not found cases
    //     }
    //     $publisher->update($request->all());
    //     return response()->json([
    //         'message' => 'Successfully updated',
    //         'user' => $publisher // Return the updated publisher data
    //     ], 200);
    // }

    // public function destroy(string $id)
    // {
    //     // Delete the resource
    //     $publisher = Publishers::find($id); // Use the correct model name
    //     if (!$publisher) {
    //         return response()->json(['message' => 'Publisher not found'], 404); // Handle not found cases
    //     }
    //     $publisher->delete();
    //     return response()->json([
    //         'message' => 'Successfully deleted'
    //     ], 200);
    // }
}
