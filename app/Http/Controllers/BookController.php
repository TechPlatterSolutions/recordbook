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

   public function userBooks(Request $request)
{
    $user = $request->user(); // get the authenticated user

    $books = $user->books()->latest()->get(); // fetch books related to user

    return response()->json([
        'status' => 'success',
        'books' => $books,
    ]);
}


    public function destroy($id)
{
    $book = Book::find($id);

    if (!$book) {
        return response()->json([
            'message' => 'Book not found.',
        ], 404);
    }

    $book->delete();

    return response()->json([
        'message' => 'Book deleted successfully.',
    ], 200);
}
}
