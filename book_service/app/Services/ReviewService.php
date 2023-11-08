<?php

namespace App\Services;

use App\Contracts\ReviewServiceInterface;
use Illuminate\Support\Facades\Http;

class ReviewService implements ReviewServiceInterface
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
        $this->baseUrl = config('services.review_service.base_url');
    }

    /**
     * Get reviews for a book.
     *
     * @param int $bookId
     * @return array|null
     */
    public function getReviews(int $bookId): ?array
    {
        $response = Http::get("{$this->baseUrl}/books/{$bookId}/reviews");

        return $response->successful() ? $response->json() : null;
    }

    /**
     * Get a book's rating.
     *
     * @param int $bookId
     * @return array|null
     */
    public function getRating(int $bookId): ?array
    {
        $response = Http::get("{$this->baseUrl}/books/{$bookId}/rating");

        return $response->successful() ? $response->json() : null;
    }
}
