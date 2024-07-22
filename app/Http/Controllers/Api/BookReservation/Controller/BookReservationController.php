<?php

namespace App\Http\Controllers\Api\BookReservation\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BookReservation\Model\BookReservation;
use Illuminate\Http\Request;

class BookReservationController extends Controller
{
    public function index()
    {
        // Fetch all the Book Reservation objects
        return BookReservation::all(); // Use the correct model name
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_number' => 'required|string|max:10',
            'book_number' => 'required|string|max:10',
            'member_id' => 'required|exists:members,member_id',
            'book_id' => 'exists:books,book_id'
        ]);

        $reservation = BookReservation::create($request->all()); // Create a new Book Reservation instance
        return response()->json([
            'message' => 'Successfully created',
            'reservation' => $reservation // Return the created book reservation data
        ], 201);
    }

    public function show(string $reservation_id)
    {
        // Find the specific resource
        $reservation = BookReservation::find($reservation_id); // Use the correct model name
        if (!$reservation) {
            return response()->json(['message' =>  'Book Reservation not found'], 404); // Handle not found cases
        }
        return $reservation;
    }

    public function update(Request $request, string $reservation_id)
    {
        // Update the resource
        $reservation = BookReservation::find($reservation_id); // Use the correct model name
        if (!$reservation) {
            return response()->json(['message' => 'Book Reservation not found'], 404); // Handle not found cases
        }
        $reservation->update($request->all());
        return response()->json([
            'message' => 'Successfully updated',
            'reservation' => $reservation // Return the updated book reservation data
        ], 200);
    }

    public function destroy(string $reservation_id)
    {
        // Delete the resource
        $reservation = BookReservation::find($reservation_id); // Use the correct model name
        if (!$reservation) {
            return response()->json(['message' => 'Book Reservation not found'], 404); // Handle not found cases
        }
        $reservation->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
