<?php

namespace App\Http\Controllers\Api\Author\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Author\Model\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        // Fetch all the Author objects
        return Author::all();
       
    }

    public function store(Request $request)
    {
        // Post request
        $request->validate([
           'author_first_name' =>'required|string',
            'author_middle_name' => 'nullable|string',
           'author_last_name' =>'required|string',
        

        ]);

        $author = Author::create($request->all()); // Create a new Author instance
        return response()->json([
            'message' => 'Successfully created',
            'author' => $author // Return the created Author data
        ], 201);
    }

    public function show(string $author_id)
    {
        // Find the specific resource
        $author = Author::find($author_id); // Use the correct model name
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404); // Handle not found cases
        }
        return response()->json(['author data' => $author]);
    }

    public function update(Request $request, string $author_id)
    {
        // Update the resource
        $author= Author::find($author_id); // Use the correct model name
        if (!$author) {
            return response()->json(['message' => 'author not found'], 404); // Handle not found cases
        }
        $author->update($request->all());
        return response()->json([[
            'message' => 'Successfully updated',
            'author' => $author // Return the updated Author data
        ], 200]);
    }

    public function destroy(string $author_id)
    {
        // Delete the resource
        $author = Author::find($author_id); // Use the correct model name
        if (!$author) {
            return response()->json([['message' => 'Author not found'], 404]); // Handle not found cases
        }
        $author->delete();
        return response()->json([[
            'message' => 'Successfully deleted'
        ], 200]);
    }
}
