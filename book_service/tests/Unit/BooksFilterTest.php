<?php

namespace Tests\Unit;

use App\Filters\BooksFilter;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class BooksFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_books_by_title()
    {
        // Arrange
        Book::factory()->create(['title' => 'Test']);
        Book::factory()->create(['title' => 'Unit']);
        $request = new Request(['title' => 'Test']);
        $filter = new BooksFilter($request);

        // Act
        $booksQuery = Book::query();
        $filter->apply($booksQuery);
        $books = $booksQuery->get();

        // Assert
        $this->assertCount(1, $books);
        $this->assertEquals('Test', $books->first()->title);
    }
}
