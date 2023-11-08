<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Services\BookService;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookService = new BookService();
        $page = 1;

        // Continue fetching books until there are no more pages
        do {
            // Get books from the current page
            $booksData = $bookService->getBooks($page);

            if (!$booksData || empty($booksData['data'])) {
                break; // Exit if there are no more books
            }

            // Create reviews for each book on the current page
            foreach ($booksData['data'] as $book) {
                $reviewsCount = rand(7, 30);
                for ($i = 0; $i < $reviewsCount; $i++) {
                    Review::create([
                        'book_id' => $book['id'],
                        'user_name' => "User {$i}",
                        'rating' => rand(1, 5),
                        'comment' => "This is a review for book {$book['id']} by User {$i}.",
                    ]);
                }
            }

            // Check if there is a next page
            $nextPage = $booksData['links']['next'] ?? null;

            // Increment page number if there is a next page
            if ($nextPage) {
                $page++;
            } else {
                break; // Exit if there are no more pages
            }

        } while (true);
    }
}
