<?php

namespace App\Http\Controllers\Api\Author\Controller;

use App\Http\Controllers\Api\Author\Model\Author;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Filters\FilterHelper;
use App\Http\Controllers\Helpers\Pagination\PaginationHelper;
use App\Http\Controllers\Helpers\Sort\SortHelper;
use Illuminate\Http\Request;
use PharIo\Manifest\Author as ManifestAuthor;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by'); // sort_by params 
        $sortOrder = $request->input('sort_order'); // sort_order params
        $filters = $request->input('filters'); // filter params
        $perPage = $request->input('per_page', 5); // Default to 10 items per page

        $query = Author::query();

        // Apply Sorting
        $query = SortHelper::applySorting($query, $sortBy, $sortOrder);

        // Apply Filtering
        $query = FilterHelper::applyFiltering($query, $filters);

        // Get Total Count for Pagination
        $total = $query->count();

        // Apply Pagination
        $author = PaginationHelper::applyPagination(
            $query->paginate($perPage)->items(),
            $perPage,
            $request->input('page', 1), // Default to page 1
            $total
        );
        // Fetch all the author objects
        // return Author::all();
        // $Author = $query->simplePaginate(10);// Use the correct model name

        // Return the data as a JSON response
        return response()->json([[
            'data' => $author,
            'total' => $author->total(),
            'per_page' => $author->perPage(),
            'current_page' => $author->currentPage(),
            'last_page' => $author->lastPage(),
        ], 200]);
    }

    public function store(Request $request)
    {
        // Post request
        $request->validate([
            'author_first_name' => 'required|string|max:100',
            'author_first_name' => 'nullable|string|max:100',
            'author_first_name' => 'required|string|max:100',
        ]);

        $author = Author::create($request->all()); // Create a new Author instance
        return response()->json([
            'message' => 'Successfully created',
            'author' => $author // Return the created author data
        ], 201);
    }

    public function show(string $author_id)
    {
        // Find the specific resource
        $author = Author::find($author_id); // Use the correct model name
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404); // Handle not found cases
        }
        return $author;
    }

    public function update(Request $request, string $author_id)
    {
        // Update the resource
        $author = Author::find($author_id); // Use the correct model name
        if (!$author) {
            return response()->json([['message' => 'Author not found'], 404]); // Handle not found cases
        }
        $author->update($request->all());
        return response()->json([[
            'message' => 'Successfully updated',
            'author' => $author // Return the updated author data
        ], 200]);
    }


    public function destroy(string $author_id)
    {
        // Delete the resource
        $author = Author::find($author_id); // Use the correct model name
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404); // Handle not found cases
        }
        $author->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ], 200);
    }
}
