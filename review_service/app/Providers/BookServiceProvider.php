<?php

namespace App\Providers;

use App\Contracts\BookServiceInterface;
use App\Services\BookService;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(BookServiceInterface::class, function ($app) {
            return new BookService();
        });
    }
}
