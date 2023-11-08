<?php

namespace App\Http\Controllers;

use App\Contracts\BookServiceInterface;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    /**
     * The book service instance.
     *
     * @var BookServiceInterface
     */
    protected BookServiceInterface $bookService;

    /**
     * Create a new controller instance.
     *
     * @param  BookServiceInterface  $bookService
     * @return void
     */
    public function __construct(BookServiceInterface $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of reviews for a specific book.
     *
     * @param int $bookId
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(int $bookId): \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse
    {
        // Retrieve all reviews for the given book ID.
        $reviews = Review::where('book_id', $bookId)->orderBy('created_at', 'desc')->get();

        return ReviewResource::collection($reviews);
    }

    /**
     * Store a newly created review in storage.
     *
     * @param  StoreReviewRequest  $request
     * @param int $bookId
     * @return JsonResponse
     */
    public function store(StoreReviewRequest $request, int $bookId): JsonResponse
    {
        // Validate the request using the StoreReviewRequest validation rules.
        $validated = $request->validated();

        // Create a new review with the validated data and the book ID.
        $review = Review::create([
            'book_id' => $bookId,
            'user_name' => $validated['user_name'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return response()->json($review, 201);
    }

    /**
     * Display the rating for a specific book.
     *
     * @param int $bookId
     * @return JsonResponse
     */
    public function rating(int $bookId): JsonResponse
    {
        // Retrieve the average rating for the given book ID.
        $rating = Review::where('book_id', $bookId)->avg('rating');
        $rating = round($rating);

        return response()->json(['rating' => $rating], 200);
    }
}
