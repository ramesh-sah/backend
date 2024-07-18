<?php

namespace App\Http\Controllers\Api\BookPurchaseCategory\Controller;


use App\Http\Controllers\Helpers\Sort\SortHelper;
use App\Http\Controllers\Helpers\Filters\FilterHelper;
use App\Http\Controllers\Helpers\Pagination\PaginationHelper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BookPurchaseCategory\Model\BookPurchaseCategory;
use Illuminate\Http\Request;

class BookPurchaseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by'); // sort_by params 
        $sortOrder = $request->input('sort_order'); // sort_order params
        $filters = $request->input('filters'); // filter params
        $perPage = $request->input('per_page', 5); // Default to 10 items per page

        $query = BookPurchaseCategory::query();

        // Apply Sorting
        $query = SortHelper::applySorting($query, $sortBy, $sortOrder);

        // Apply Filtering
        $query = FilterHelper::applyFiltering($query, $filters);

        // Get Total Count for Pagination
        $total = $query->count();

        // Apply Pagination
        $bookPurchaseCategory= PaginationHelper::applyPagination(
            $query->paginate($perPage)->items(),
            $perPage,
            $request->input('page', 1), // Default to page 1
            $total
        );


        // foreach ($bookPurchase as $bookPurchase) {
        //     $bookPurchase->CoverImageForeign;
        // }

        return response()->json([[
            'data' => $bookPurchaseCategory,
            'total' => $bookPurchaseCategory->total(),
            'per_page' => $bookPurchaseCategory->perPage(),
            'current_page' => $bookPurchaseCategory->currentPage(),
            'last_page' => $bookPurchaseCategory->lastPage(),
        ], 200]);

        // Return the data as a JSON response

    }


    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'purchase_id'=>'required|string|exists:book_purchases,purchase_id',
            'category_id'=>'required|string|exists:categories,category_id',
        ]);

        $bookPurchaseCategory= BookPurchaseCategory::create($request->all()); // Create a new Publisher instance
        return response()->json([[
            'message' => 'Successfully created',
            'publisher' => $bookPurchaseCategory // Return the created publisher data
        ], 201]);
    }

    public function show(string $book_purchases_categories_id)
    {
        // Find the specific resource
        $bookPurchaseCategory= BookPurchaseCategory::find($book_purchases_categories_id); // Use the correct model name
        if (!$bookPurchaseCategory) {
            return response()->json([['message' => 'Publisher not found'], 404]); // Handle not found cases
        }
        $bookPurchaseCategory->bookPurchaseForeign->categoryForeign;
        return response()->json(($bookPurchaseCategory)->jsonSerializer());
    }

    public function update(Request $request, string $book_purchases_categories_id)
    {
        // Update the resource
        $bookPurchaseCategory = BookPurchaseCategory::find($book_purchases_categories_id); // Use the correct model name
        if (!$bookPurchaseCategory) {
            return response()->json([['message' => 'Publisher not found'], 404]); // Handle not found cases
        }
        $bookPurchaseCategory->update($request->all());
        return response()->json([[
            'message' => 'Successfully updated',
            'publisher' => $bookPurchaseCategory // Return the updated publisher data
        ], 200]);
    }

    public function destroy(string $book_purchases_categories_id)
    {
        // Delete the resource
        $bookPurchaseCategory = BookPurchaseCategory::find($book_purchases_categories_id); // Use the correct model name
        if (!$bookPurchaseCategory) {
            return response()->json([['message' => 'Publisher not found'], 404]); // Handle not found cases
        }
        $bookPurchaseCategory->delete();
        return response()->json([[
            'message' => 'Successfully deleted'
        ], 200]);
    }
}
