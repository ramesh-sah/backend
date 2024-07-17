<?php

namespace App\Http\Controllers\Api\BookPurchase\Controller;


use App\Http\Controllers\Helpers\Sort\SortHelper;
use App\Http\Controllers\Helpers\Filters\FilterHelper;
use App\Http\Controllers\Helpers\Pagination\PaginationHelper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BookPurchase\Model\BookPurchase;
use Illuminate\Http\Request;

class BookPurchaseController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by'); // sort_by params 
        $sortOrder = $request->input('sort_order'); // sort_order params
        $filters = $request->input('filters'); // filter params
        $perPage = $request->input('per_page', 5); // Default to 10 items per page

        $query = BookPurchase::query();

        // Apply Sorting
        $query = SortHelper::applySorting($query, $sortBy, $sortOrder);

        // Apply Filtering
        $query = FilterHelper::applyFiltering($query, $filters);

        // Get Total Count for Pagination
        $total = $query->count();

        // Apply Pagination
        $bookPurchase = PaginationHelper::applyPagination(
            $query->paginate($perPage)->items(),
            $perPage,
            $request->input('page', 1), // Default to page 1
            $total
        );


        // foreach ($bookPurchase as $bookPurchase) {
        //     $bookPurchase->CoverImageForeign;
        // }

        return response()->json([[
            'data' => $bookPurchase,
            'total' => $bookPurchase->total(),
            'per_page' => $bookPurchase->perPage(),
            'current_page' => $bookPurchase->currentPage(),
            'last_page' => $bookPurchase->lastPage(),
        ], 200]);

        // Return the data as a JSON response

    }


    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'class_number' => 'required|string',
            'book_number' => 'required|string',
            'title' => 'required|string',
            'sub_title' => 'string|nullable',
            'edition_statement' => 'string|nullable',
            'number_of_pages' => 'required|string',
            'publication_year' => 'required|string',
            'series_statement' => 'string|nullable',
            'quantity' => 'required|integer',
            'online' => 'string|nullable',
            'image_id' => 'required|string',

        ]);

        $bookPurchase = BookPurchase::create($request->all()); // Create a new Publisher instance
        return response()->json([[
            'message' => 'Successfully created book purchase',
            'publisher' => $bookPurchase->jsonSerialize() // Return the created publisher data
        ], 201]);
    }

    public function show(string $purchase_id)
    {
        // Find the specific resource
        $bookPurchase = BookPurchase::find($purchase_id); // Use the correct model name
        if (!$bookPurchase) {
            return response()->json([['message' => 'Book Purchased not found'], 404]); // Handle not found cases
        }
        $bookPurchase->coverImageForeign;  // Get the foreign key data i.e-> CoverImageForeign from the Model instance function
        return response()->json([($bookPurchase)->jsonSerialize(), 200]);
    }

    public function update(Request $request, string $purchase_id)
    {
        // Update the resource
        $bookPurchase = BookPurchase::find($purchase_id); // Use the correct model name
        if (!$bookPurchase) {
            return response()->json([['message' => 'Book Purchased not found'], 404]); // Handle not found cases
        }
        $bookPurchase->update($request->all());
        return response()->json([[
            'message' => 'Successfully updated',
            'publisher' => $bookPurchase->jsonSerialize() // Return the updated publisher data
        ], 200]);
    }

    public function destroy(string $purchase_id)
    {
        // Delete the resource
        $bookPurchase = BookPurchase::find($purchase_id); // Use the correct model name
        if (!$bookPurchase) {
            return response()->json([['message' => 'Purchased Book  not found'], 404]); // Handle not found cases
        }


        return response()->json([[
            'message' => 'Successfully deleted '
        ], 200]);
    }
}
