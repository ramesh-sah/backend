<?php

namespace App\Http\Controllers\Api\BookOnline\Controller;


use App\Http\Controllers\Helpers\Sort\SortHelper;
use App\Http\Controllers\Helpers\Filters\FilterHelper;
use App\Http\Controllers\Helpers\Pagination\PaginationHelper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BookOnline\Model\BookOnline;
use Illuminate\Http\Request;

class BookOnlineController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by'); // sort_by params 
        $sortOrder = $request->input('sort_order'); // sort_order params
        $filters = $request->input('filters'); // filter params
        $perPage = $request->input('per_page', 5); // Default to 10 items per page

        $query = BookOnline::query();

        // Apply Sorting
        $query = SortHelper::applySorting($query, $sortBy, $sortOrder);

        // Apply Filtering
        $query = FilterHelper::applyFiltering($query, $filters);

        // Get Total Count for Pagination
        $total = $query->count();

        // Apply Pagination
        $bookOnline= PaginationHelper::applyPagination(
            $query->paginate($perPage)->items(),
            $perPage,
            $request->input('page', 1), // Default to page 1
            $total
        );


        // foreach ($bookPurchase as $bookPurchase) {
        //     $bookPurchase->CoverImageForeign;
        // }

        return response()->json([[
            'data' => $bookOnline,
            'total' => $bookOnline->total(),
            'per_page' => $bookOnline->perPage(),
            'current_page' => $bookOnline->currentPage(),
            'last_page' => $bookOnline->lastPage(),
        ], 200]);

        // Return the data as a JSON response

    }

    public function store(Request $request)
    {
        // Post request
        $request->validate([
          'name'=>'required|string',
          'price'=>'required|numeric',
          'url'=>'required|url'
        
        ]);

        $bookOnline = BookOnline::create($request->all()); // Create a new Publisher instance
        return response()->json([[
            'message' => 'Successfully created',
            'publisher' => $bookOnline // Return the created publisher data
        ], 201]);
    }

    public function show(string $online_id)
    {
        // Find the specific resource
        $bookOnline = BookOnline::find($online_id); // Use the correct model name
        if (!$bookOnline) {
            return response()->json([['message' => 'online book not found'], 404]); // Handle not found cases
        }
        return $bookOnline;
    }

    public function update(Request $request, string $online_id)
    {
        // Update the resource
        $bookOnline = BookOnline::find($online_id); // Use the correct model name
        if (!$bookOnline) {
            return response()->json([['message' => 'Online Book not found'], 404]); // Handle not found cases
        }
        $bookOnline->update($request->all());
        return response()->json([
            'message' => 'Successfully updated',
            'online book' => $bookOnline // Return the updated publisher data
        ], 200);
    }

    public function destroy(string $online_id)
    {
        // Delete the resource
        $bookOnline = BookOnline::find($online_id); // Use the correct model name
        if (!$bookOnline) {
            return response()->json(['message' => 'online book not found'], 404); // Handle not found cases
        }
        $bookOnline->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
