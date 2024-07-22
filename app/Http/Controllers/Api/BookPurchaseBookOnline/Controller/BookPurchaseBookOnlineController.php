<?php

namespace App\Http\Controllers\Api\BookPurchaseBookOnline\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BookPurchaseBookOnline\Model\BookPurchasesBookOnline;
use Illuminate\Http\Request;

class BookPurchaseBookOnlineController extends Controller
{
    public function index()
    {
        // Fetch all the Book Purchase Book Online objects
        return BookPurchasesBookOnline::all();
        // $bookPurchaseBookOnlines = $query->simplePaginate(10);// Use the correct model name
    }

    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'purchase_id' => 'required|exists:book_purchases,purchase_id',
            'online_id' => 'required|exists:book_onlines,online_id'
        ]);

        $bookPurchaseBookOnline = BookPurchasesBookOnline::create($request->all()); // Create a new Book Purchase Book Online instance
        return response()->json([
            'message' => 'Successfully created',
            'bookpurchasebookonline' => $bookPurchaseBookOnline // Return the created book purchase book online data
        ], 201);
    }

    public function show(string $bookPurchaseBookOnline_id)
    {
        // Find the specific resource
        $bookPurchaseBookOnline = BookPurchasesBookOnline::find($bookPurchaseBookOnline_id); // Use the correct model name
        if (!$bookPurchaseBookOnline) {
            return response()->json(['message' => 'Book Purchase Book Online not found'], 404); // Handle not found cases
        }
        return $bookPurchaseBookOnline;
    }

    public function update(Request $request, string $bookPurchaseBookOnline_id)
    {
        // Update the resource
        $bookPurchaseBookOnline = BookPurchasesBookOnline::find($bookPurchaseBookOnline_id); // Use the correct model name
        if (!$bookPurchaseBookOnline) {
            return response()->json(['message' => 'Book Purchase Book Online not found'], 404); // Handle not found cases
        }
        $bookPurchaseBookOnline->update($request->all());
        return response()->json([
            'message' => 'Successfully updated',
            'bookpurchasebookonline' => $bookPurchaseBookOnline // Return the updated book purchase book online data
        ], 200);
    }

    public function destroy(string $bookPurchaseBookOnline_id)
    {
        // Delete the resource
        $bookPurchaseBookOnline = BookPurchasesBookOnline::find($bookPurchaseBookOnline_id); // Use the correct model name
        if (!$bookPurchaseBookOnline) {
            return response()->json(['message' => 'Book Purchase Book Online not found'], 404); // Handle not found cases
        }
        $bookPurchaseBookOnline->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
