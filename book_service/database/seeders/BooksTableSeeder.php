<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(30)->create()->each(function ($book) {
            try {
                $id = rand(500, 700);
                $book->addMediaFromUrl("https://picsum.photos/id/$id/300/300.jpg")
                    ->toMediaCollection('cover');
            } catch (\Exception $e) {
                echo $e->getMessage() . PHP_EOL;
            }
        });
    }
}
