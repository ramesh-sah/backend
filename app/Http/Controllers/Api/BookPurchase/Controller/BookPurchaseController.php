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
    public function addBooks(Request $request)
    {
        $isbns = null;
        $authors = null;
        $categories = null;
        $publisher = null;
        $coverImage = null;
        $barcodes = null;
        $bookOnlines = null;
        $allData = $request->all();

        // validate data for book purchase
        $validation = Validator::make($allData, [
            'class_number' => 'required|max:30',
            'book_number' => 'required|max:30',
            'title' => 'required|max:225',
            'sub_title' => 'max:225',
            'edition_statement' => 'max:225',
            'number_of_pages' => 'required|max:100',
            'publication_year' => 'required|max:4',
            'series_statement' => 'max:224',
            'quantity' => 'required',
            'online' => 'max:2048',
            'barcode' => 'required'
        ]);

        if ($validation->fails()) {
            return $this->sendError('Validation failed', $validation->errors(), 400);
        }

        //validate isbn
        if ($request->has('isbn')) {
            $isbns = $request->isbn;
            foreach ($isbns as $isbn) {
                $isbnValidation = Validator::make($isbn, [
                    'isbn' => 'required|max:13'
                ]);

                if ($isbnValidation->fails()) {
                    return $this->sendError('Validation failed', $isbnValidation->errors(), 400);
                }
            }
        }

        // validate author
        if ($request->has('author_name')) {
            $authors = $request->author_name;
            foreach ($authors as $author) {
                $authorValidation = Validator::make($author, [
                    'author_first_name' => 'required|max:100',
                    'author_last_name' => 'required|max:100'
                ]);

                if ($authorValidation->fails()) {
                    return $this->sendError('Validation failed', $authorValidation->errors(), 400);
                }
            }
        }

        // validate category
        if ($request->has('category_name')) {
            $categories = $request->category_name;
            foreach ($categories as $category) {
                $categoryValidation = Validator::make($category, [
                    'category_name' => 'required|max:100',
                ]);

                if ($categoryValidation->fails()) {
                    return $this->sendError('Validation failed', $categoryValidation->errors(), 400);
                }
            }
        }

        // validate publisher
        if ($request->has('publisher_name')) {
            $publisher = $request->publisher_name;
            $publisherValidation = Validator::make($publisher, [
                'publisher_name' => 'required|max:100',
                'publication_place' => 'required|max:225',
            ]);

            if ($publisherValidation->fails()) {
                return $this->sendError('Validation failed', $publisherValidation->errors(), 400);
            }
        }

        // validate barcode
        if ($request->has('barcode')) {
            $barcodes = $request->barcode;
            if (count($barcodes) == $allData['quantity']) {

                foreach ($barcodes as $barcode) {
                    $barcodeValidator = Validator::make($barcode, [
                        'barcode' => 'required'
                    ]);

                    if ($barcodeValidator->fails()) {
                        return $this->sendError('Validation failed', $barcodeValidator->errors(), 400);
                    }
                }
            } else {
                return $this->sendError('Validation failed', 'Barcode count should be equal to quantity', 400);
            }
        }

        // validate book onlines
        if ($request->has('book_online')) {
            $bookOnlines = $request->book_online;
            foreach ($bookOnlines as $bookOnline) {
                $bookOnlineValidator = Validator::make($bookOnline, [
                    'name' => 'required|max:225',
                    'price' => 'required',
                    'url' => 'required|max:2048'
                ]);

                if ($bookOnlineValidator->fails()) {
                    return $this->sendError('Validation failed', $bookOnlineValidator->errors(), 400);
                }
            }
        }

        // validate and store cover image in server
        if ($request->hasFile('cover_image')) {
            $coverImangeValidator = Validator::make($request->all(), [
                'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($coverImangeValidator->fails()) {
                return $this->sendError('Validation failed', $coverImangeValidator->errors(), 400);
            }
            $coverImage = $request->file('cover_image')->store('public/uploads/cdn');
        }

        // create publisher
        if ($coverImage) {
            $coverImage = CoverImage::create([
                "link" => $coverImage
            ]);
            $allData['image_id'] = $coverImage->image_id;
        }

        // create publisher
        if ($publisher) {
            $publisher = Publisher::create($publisher);
            $allData['publisher_id'] = $publisher->publisher_id;
        }

        // create book purchase
        $bookPurchase = BookPurchase::create($allData);

        // create barcode
        if ($barcodes) {
            foreach ($barcodes as $barcode) {

                // create barcode
                $barcode = Barcode::create([
                    'barcode' => $barcode['barcode'],
                    'purchase_id' => $bookPurchase->purchase_id,
                ]);
            }
        }

        /**
         * create isbn
         * create book purchase isbn
         */
        if ($isbns) {
            foreach ($isbns as $isbn) {

                // create isbn
                $isbn = Isbn::create([
                    'isbn' => $isbn['isbn'],
                ]);

                // create book purchase isbn
                $bookPurchaseIsbn = BookPurchasesIsbns::create([
                    'purchase_id' => $bookPurchase->purchase_id,
                    'isbn_id' => $isbn->isbn_id
                ]);
            }
        }

        /**
         * create author
         * create book purchase author
         */
        if ($authors) {
            foreach ($authors as $author) {
                $authorMiddleName = isset($author['author_middle_name']) ? $author['author_middle_name'] : null;

                // create author
                $author = Author::create([
                    'author_first_name' => $author['author_first_name'],
                    'author_middle_name' => $authorMiddleName,
                    'author_last_name' => $author['author_last_name']
                ]);

                // create book purchase author
                $bookPurchaseAuthor = BookPurchaseAuthors::create([
                    'purchase_id' => $bookPurchase->purchase_id,
                    'author_id' => $author->author_id
                ]);
            }
        }

        /**
         * create category
         * create book purchase category
         */
        if ($categories) {
            foreach ($categories as $category) {

                // create category
                $category = Category::create([
                    'category_name' => $category['category_name']
                ]);

                // create book purchase category
                $bookPurchaseCategories = BookPurchasesCategories::create([
                    'purchase_id' => $bookPurchase->purchase_id,
                    'category_id' => $category->category_id
                ]);
            }
        }

        /**
         * create book online
         * create book purchase book online
         */
        if ($bookOnlines) {
            foreach ($bookOnlines as $bookOnline) {

                // create book online
                $bookOnline = BookOnline::create([
                    'name' => $bookOnline['name'],
                    'price' => $bookOnline['price'],
                    'url' => $bookOnline['url']
                ]);

                // create book purchase book online
                $bookPurchaseBookOnline = BookPurchasesBookOnlines::create([
                    'purchase_id' => $bookPurchase->purchase_id,
                    'online_id' => $bookOnline->online_id
                ]);
            }
        }

        return $this->sendResponse($bookPurchase, 'Book purchase created successfully');
    }

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
