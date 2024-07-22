<?php

namespace App\Http\Controllers\Api\BookOnline\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BookOnline\Model\BookOnline;
use Illuminate\Http\Request;

class BookOnlineController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all the BookOnline objects
        return BookOnline::all();
        // $bookOnlines = $query->simplePaginate(10);// Use the correct model name
    }

    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'url' => 'required|string|max:2048'
        ]);

        $bookOnline = BookOnline::create($request->all()); // Create a new Book Online instance
        return response()->json([
            'message' => 'Successfully created',
            'bookOnline' => $bookOnline // Return the created book online data
        ], 201);
    }

    public function show(string $bookOnline_id)
    {
        // Find the specific resource
        $bookOnline = BookOnline::find($bookOnline_id); // Use the correct model name
        if (!$bookOnline) {
            return response()->json(['message' => 'Book Online not found'], 404); // Handle not found cases
        }
        return $bookOnline;
    }

    public function update(Request $request, string $bookOnline_id)
    {
        // Update the resource
        $bookOnline = BookOnline::find($bookOnline_id); // Use the correct model name
        if (!$bookOnline) {
            return response()->json(['message' => 'Book Online not found'], 404); // Handle not found cases
        }
        $bookOnline->update($request->all());
        return response()->json([
            'message' => 'Successfully updated',
            'bookOnline' => $bookOnline // Return the updated publisher data
        ], 200);
    }

    public function destroy(string $bookOnline_id)
    {
        // Delete the resource
        $bookOnline = BookOnline::find($bookOnline_id); // Use the correct model name
        if (!$bookOnline) {
            return response()->json(['message' => 'Book Online not found'], 404); // Handle not found cases
        }
        $bookOnline->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
