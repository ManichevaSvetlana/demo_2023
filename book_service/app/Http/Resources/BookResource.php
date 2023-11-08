<?php

namespace App\Http\Resources;

use App\Services\ReviewService;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request): array
    {
        // Initialize the ReviewService
        $reviewService = new ReviewService();

        // Get the rating for the book
        $rating = $reviewService->getRating($this->id);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'isbn' => $this->isbn,
            'pages' => $this->pages,
            'cover' => $this->getFirstMediaUrl('cover'),
            'rating' => $rating['rating'] ?? null,
        ];
    }
}
