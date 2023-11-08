<?php

namespace Tests\Feature;

use App\Contracts\BookServiceInterface;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_reviews_for_a_book()
    {
        $bookId = 1; // Test book id

        $review = new Review([
            'book_id' => $bookId,
            'user_name' => 'Test User',
            'rating' => 3,
            'comment' => 'The book was ok.',
        ]);
        $review->save();

        $this->mock(BookServiceInterface::class, function ($mock) use ($bookId) {
            // Assume that the book exists
            $mock->shouldReceive('getBook')->with($bookId)->andReturn(['id' => $bookId]);
        });

        $response = $this->getJson(route('reviews.index', ['bookId' => $bookId]));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'book_id',
                    'user_name',
                    'rating',
                    'comment',
                ]
            ],
            'links',
            'meta',
        ]);
    }

    /** @test */
    public function a_user_can_submit_a_review_for_a_book()
    {
        $bookId = 1; // Test book id

        // Mock the BookService to return an array as if a book was found
        $this->mock(BookServiceInterface::class, function ($mock) use ($bookId) {
            $mock->shouldReceive('getBook')->with($bookId)->andReturn(['id' => $bookId, 'title' => 'Sample Book']);
        });

        $reviewData = [
            'user_name' => 'Test User',
            'rating' => 4,
            'comment' => 'The book was good.',
        ];

        $response = $this->postJson(route('reviews.store', ['bookId' => $bookId]), $reviewData);

        $response->assertCreated();
        $response->assertJson($reviewData);
        $this->assertDatabaseHas('reviews', [
            'book_id' => $bookId,
            'user_name' => 'Test User',
            'rating' => 4,
            'comment' => 'The book was good.',
        ]);
    }

    /** @test */
    public function review_creation_fails_if_the_book_does_not_exist()
    {
        $bookId = 999; // Non existent test book id

        $this->mock(BookServiceInterface::class, function ($mock) use ($bookId) {
            // Simulate we do not have this book
            $mock->shouldReceive('getBook')->with($bookId)->andReturn(null);
        });

        $reviewData = [
            'user_name' => 'Test User',
            'rating' => 4,
            'comment' => 'The book was good.',
        ];

        $response = $this->postJson(route('reviews.store', ['bookId' => $bookId]), $reviewData);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Book not found']);
    }

    /** @test */
    public function review_creation_fails_if_required_fields_are_missing()
    {
        $bookId = 1; // Test book id

        $this->mock(BookServiceInterface::class, function ($mock) use ($bookId) {
            $mock->shouldReceive('getBook')->with($bookId)->andReturn(true);
        });

        // Missing 'rating' and 'user_name'
        $reviewData = [
            'comment' => 'Missing required fields',
        ];

        $response = $this->postJson(route('reviews.store', ['bookId' => $bookId]), $reviewData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['user_name', 'rating']);
    }

    /** @test */
    public function review_creation_fails_if_rating_is_out_of_range()
    {
        $bookId = 1; // Test book id

        $this->mock(BookServiceInterface::class, function ($mock) use ($bookId) {
            $mock->shouldReceive('getBook')->with($bookId)->andReturn(true);
        });

        $reviewData = [
            'user_name' => 'Test User',
            'rating' => 6, // Invalid rating, as it's out of range 1-5
            'comment' => 'Invalid rating',
        ];

        $response = $this->postJson(route('reviews.store', ['bookId' => $bookId]), $reviewData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['rating']);
    }
}
