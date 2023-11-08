<?php

namespace App\Contracts;

interface BookServiceInterface
{
    /**
     * Get a book by its ID.
     *
     * @param int $bookId
     * @return array|null
     */
    public function getBook(int $bookId): ?array;

    /**
     * Get books list.
     *
     * @param int $page
     * @return array|null
     */
    public function getBooks(int $page = 1): ?array;
}
