<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Function to store a new book
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensure the user_id exists in users table
            'book_name' => 'required|string|max:255',
        ]);

        // Create and save the new book
        $book = Book::create([
            'user_id' => $request->user_id,
            'book_name' => $request->book_name,
        ]);

        return response()->json([
            'message' => 'RecordBook added successfully',
            'book' => $book
        ], 201); // Return a 201 status code for successful creation
    }
}
