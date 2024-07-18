<?php

namespace App\Http\Controllers\Api\Category\Controller;

use App\Http\Controllers\Helpers\Sort\SortHelper;
use App\Http\Controllers\Helpers\Filters\FilterHelper;
use App\Http\Controllers\Helpers\Pagination\PaginationHelper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Category\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by'); // sort_by params 
        $sortOrder = $request->input('sort_order'); // sort_order params
        $filters = $request->input('filters'); // filter params
        $perPage = $request->input('per_page', 5); // Default to 10 items per page

        $query = Category::query();

        // Apply Sorting
        $query = SortHelper::applySorting($query, $sortBy, $sortOrder);

        // Apply Filtering
        $query = FilterHelper::applyFiltering($query, $filters);

        // Get Total Count for Pagination
        $total = $query->count();

        // Apply Pagination
        $category = PaginationHelper::applyPagination(
            $query->paginate($perPage)->items(),
            $perPage,
            $request->input('page', 1), // Default to page 1
            $total
        );


        // foreach ($bookPurchase as $bookPurchase) {
        //     $bookPurchase->CoverImageForeign;
        // }

        return response()->json([[
            'data' => $category,
            'total' => $category->total(),
            'per_page' => $category->perPage(),
            'current_page' => $category->currentPage(),
            'last_page' => $category->lastPage(),
        ], 200]);
    }
    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'category_name' => 'required|string',
        ]);

        $category = Category::create($request->all()); // Create a new Publisher instance
        return response()->json([[
            'message' => 'Successfully created',
            'publisher' => $category // Return the created publisher data
        ], 201]);
    }

    public function show(string $category_id)
    {
        // Find the specific resource
        $category = Category::find($category_id); // Use the correct model name
        if (!$category) {
            return response()->json([['message' => 'Category not found'], 404]); // Handle not found cases
        }
        return  response()->json([$category]);
    }

    public function update(Request $request, string $category_id)
    {
        // Update the resource
        $category = Category::find($category_id); // Use the correct model name
        if (!$category) {
            return response()->json([['message' => 'Publisher not found'], 404]); // Handle not found cases
        }
        $category->update($request->all());
        return response()->json([[
            'message' => 'Successfully updated',
            'publisher' => $category // Return the updated publisher data
        ], 200]);
    }

    public function destroy(string $category_id)
    {
        // Delete the resource
        $category = Category::find($category_id); // Use the correct model name
        if (!$category) {
            return response()->json([['message' => 'Publisher not found'], 404]); // Handle not found cases
        }
        $category->delete();
        return response()->json([[
            'message' => 'Successfully deleted'
        ], 200]);
    }
}
