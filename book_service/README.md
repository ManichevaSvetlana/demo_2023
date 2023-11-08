# Book Service

The Book Service is a part of a microservices-based application designed to manage a catalog of books. 
This service is responsible for retrieving book information. 
It also communicates with the Review Service to aggregate reviews and ratings associated with each book.

## Features

- Index, show operations for book entities.
- Integration with Review Service for fetching reviews and ratings.
- Books filtering capabilities.
- Dockerized environment setup.
- Unit and Feature tests to ensure the quality of the service.

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

- GET /api/books: List all books with optional filters.
- GET /api/books/{id}: Retrieve a book by ID.

### Components

- **BooksFilter.php**: A query filter class for applying various filters to the books listing.
- **BookResource.php**: API resource that transforms the book model into a JSON structure.
- **ReviewServiceInterface.php**: Contract for the Review Service integration.
- **ReviewServiceProvider.php**: Service provider for registering and bootstrapping the Review Service.
- **ReviewService.php**: Service class that communicates with the Review Service.
- **Dockerfile**: Configuration for creating a Docker container for the service.
- **BookTest.php**: Feature tests for the book-related endpoints.
- **BooksFilterTest.php**: Unit tests for the book filtering functionality.

### Testing

To run the automated tests for this system, use the following command:

`docker-compose exec book_service php artisan test`



