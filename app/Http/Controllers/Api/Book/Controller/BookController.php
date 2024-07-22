<?php

namespace App\Http\Controllers\Api\Book\Controller;

use App\Http\Controllers\Helpers\Sort\SortHelper;
use App\Http\Controllers\Helpers\Filters\FilterHelper;
use App\Http\Controllers\Helpers\Pagination\PaginationHelper;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Book\Model\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by'); // sort_by params 
        $sortOrder = $request->input('sort_order'); // sort_order params
        $filters = $request->input('filters'); // filter params
        $perPage = $request->input('per_page', 10); // Default to 10 items per page

        $query = Book::query();

        // Apply Sorting
        $query = SortHelper::applySorting($query, $sortBy, $sortOrder);

        // Apply Filtering
        $query = FilterHelper::applyFiltering($query, $filters);

        // Get Total Count for Pagination
        $total = $query->count();

        // Apply Pagination
        $book = PaginationHelper::applyPagination(
            $query->paginate($perPage)->items(),
            $perPage,
            $request->input('page', 1), // Default to page 1
            $total
        );


        // foreach ($bookPurchase as $bookPurchase) {
        //     $bookPurchase->CoverImageForeign;
        // }

        return response()->json([[
            'data' => $book,
            'total' => $book->total(),
            'per_page' => $book->perPage(),
            'current_page' => $book->currentPage(),
            'last_page' => $book->lastPage(),
        ], 200]);

        // Return the data as a JSON response

    }


    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'book_status'=>'required|string',
       'purchase_id'=>'required|string|exists:book_purchases,purchase_id',
        ]);

        $book = Book::create($request->all()); // Create a new Publisher instance
        return response()->json([[
            'message' => 'Successfully created',
            'book' => $book // Return the created publisher data
        ], 201]);
    }

    public function show(string $book_id)
    {
        // Find the specific resource
        $book = Book::find($book_id); // Use the correct model name
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404); // Handle not found cases
        }
        $book->bookPurchaseForeign();
        return response()->json([($book)->jsonSerialize(), 200]);
    }
    

    public function update(Request $request, string $book_id)
    {
        // Update the resource
        $book= Book::find($book_id); // Use the correct model name
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404); // Handle not found cases
        }
        $book->update($request->all());
        return response()->json([
            'message' => 'Successfully updated',
            'book' => $book // Return the updated publisher data
        ], 200);
    }

    public function destroy(string $book_id)
    {
        // Delete the resource
        $book = Book::find($book_id); // Use the correct model name
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404); // Handle not found cases
        }
        $book->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
