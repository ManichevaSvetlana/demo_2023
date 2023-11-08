<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_books()
    {
        // Arrange: Create 3 books
        Book::factory()->count(3)->create();

        // Act: Fetch all books
        $response = $this->getJson('/api/books');

        // Assert: Status is 200 OK and we can see 3 books
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_fetch_a_single_book()
    {
        // Arrange: Create a single book
        $book = Book::factory()->create();

        // Act: Fetch the book by ID
        $response = $this->getJson("/api/books/{$book->id}");

        // Assert: Status is 200 OK and the book data matches
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author' => $book->author,
                    'description' => $book->description,
                    'isbn' => $book->isbn,
                    'pages' => $book->pages,
                ]
            ]);
    }
}
