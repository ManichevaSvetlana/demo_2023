<?php

namespace App\Http\Controllers;

use App\Filters\BooksFilter;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  BooksFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(BooksFilter $filter): AnonymousResourceCollection
    {
        $query = Book::orderBy('created_at');
        $filter->apply($query);
        $books = $query->paginate(9);

        return BookResource::collection($books);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return BookResource
     */
    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }
}
