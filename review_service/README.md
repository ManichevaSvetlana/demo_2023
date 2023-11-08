# Review Service

The Review Service is a part of a microservices-based application designed to manage and aggregate reviews and ratings for books. 
This service is responsible for creating and retrieving reviews for books cataloged in the Book Service.

## Features

- Store, index operations for review entities.
- Calculation and provision of average book ratings.
- Dockerized environment setup.
- Feature tests to ensure the quality of the service.

## Tech Stack

- **Language**: PHP
- **Framework**: Laravel
- **Database**: MySQL
- **Containerization**: Docker
- **Testing**: PHPUnit

### Prerequisites

- Docker
- Docker Compose

### Usage
The service exposes the following endpoints:

- GET /api/books/{bookId}/reviews: List all reviews for a specific book.
- POST /api/books/{bookId}/reviews: Create a new review for a book.
- GET /api/books/{bookId}/rating: Get the average rating for a specific book.

### Components
- **BookResource.php**: API resource that transforms the book model into a JSON structure.
- **BookServiceInterface.php**: Contract for the Book Service functionality.
- **BookServiceProvider.php**: Service provider for registering the Book Service.
- **BookService.php**: Service class that handles communication with the database for managing reviews.
- **Dockerfile**: Configuration for creating a Docker container for the service.
- **ReviewTest.php**: Feature tests for the review-related endpoints.

### Testing
To run the automated tests for this system, use the following command:

`docker-compose exec review_service php artisan test`
