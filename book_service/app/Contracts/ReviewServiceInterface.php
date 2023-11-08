<?php

namespace App\Contracts;

interface ReviewServiceInterface
{
    /**
     * Get reviews for a book.
     *
     * @param int $bookId
     * @return array|null
     */
    public function getReviews(int $bookId): ?array;

    /**
     * Get a book's rating.
     *
     * @param int $bookId
     * @return array|null
     */
    public function getRating(int $bookId): ?array;
}
