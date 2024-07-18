<?php

namespace App\Http\Controllers\Api\BookPurchaseAuthor\Controller;

use App\Http\Controllers\Api\BookPurchaseAuthor\Model\BookPurchaseAuthor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookPurchaseAuthorController extends Controller
{
    public function index()
    {
        // Fetch all the Book Purchase Author objects
        return BookPurchaseAuthor::all();
        // $bookPurchaseAuthor = $query->simplePaginate(10);// Use the correct model name
    }

    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'publisher_id' => 'required|exists:authors,author_id',
            'author_id' => 'required|exists:authors,author_id',
        ]);

        $bookPurchaseAuthor = BookPurchaseAuthor::create($request->all()); // Create a new Book Purchase Author instance
        return response()->json([
            'message' => 'Successfully created',
            'publisher' => $bookPurchaseAuthor // Return the created Book Purchase Author data
        ], 201);
    }

    public function show(string $bookPurchaseAuthor_id)
    {
        // Find the specific resource
        $bookPurchaseAuthor = BookPurchaseAuthor::find($bookPurchaseAuthor_id); // Use the correct model name
        if (!$bookPurchaseAuthor) {
            return response()->json(['message' => 'Book Purchase Author not found'], 404); // Handle not found cases
        }
        return $bookPurchaseAuthor;
    }

    public function update(Request $request, string $bookPurchaseAuthor_id)
    {
        // Update the resource
        $bookPurchaseAuthor = BookPurchaseAuthor::find($bookPurchaseAuthor_id); // Use the correct model name
        if (!$bookPurchaseAuthor) {
            return response()->json(['message' => 'Book Purchase Author not found'], 404); // Handle not found cases
        }
        $bookPurchaseAuthor->update($request->all());
        return response()->json([
            'message' => 'Successfully updated',
            'publisher' => $bookPurchaseAuthor // Return the updated Book Purchase Author data
        ], 200);
    }

    public function destroy(string $bookPurchaseAuthor_id)
    {
        // Delete the resource
        $bookPurchaseAuthor = BookPurchaseAuthor::find($bookPurchaseAuthor_id); // Use the correct model name
        if (!$bookPurchaseAuthor) {
            return response()->json(['message' => 'Book Purchase Author not found'], 404); // Handle not found cases
        }
        $bookPurchaseAuthor->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
