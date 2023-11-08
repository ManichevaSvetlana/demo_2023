<?php

namespace App\Providers;

use App\Contracts\ReviewServiceInterface;
use App\Services\ReviewService;
use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ReviewServiceInterface::class, function ($app) {
            return new ReviewService();
        });
    }
}
