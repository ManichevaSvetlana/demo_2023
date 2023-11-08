<?php

namespace App\Services;

use App\Contracts\BookServiceInterface;
use Illuminate\Support\Facades\Http;

class BookService implements BookServiceInterface
{
    /**
     * The base URL for the book service.
     *
     * @var string
     */
    protected string $baseUrl;

    /**
     * BookService constructor.
     */
    public function __construct()
    {
        $this->baseUrl = config('services.book_service.base_url');
    }

    /**
     * Get a book by its ID.
     *
     * @param int $bookId
     * @return array|null
     */
    public function getBook(int $bookId) : ?array
    {
        $response = Http::get("{$this->baseUrl}/books/{$bookId}");

        return $response->successful() ? $response->json() : null;
    }

    /**
     * Get books list.
     *
     * @param int $page
     * @return array|null
     */
    public function getBooks(int $page = 1) : ?array
    {
        $response = Http::get("{$this->baseUrl}/books?page={$page}");

        return $response->successful() ? $response->json() : null;
    }
}
