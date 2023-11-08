# Book Catalog Fullstack Application

This repository contains a fullstack application for a book catalog, utilizing a microservices architecture for the
backend services and Vue.js for the frontend.
It allows users to brows and review books.

## Overview

- **Book Service**: Microservice responsible for managing book data.
- **Review Service**: Microservice responsible for managing book reviews and ratings.
- **Vue Frontend**: User interface for interacting with the book catalog.

## Features

- Microservices architecture.
- Full CRUD operations for books and reviews.
- Search and filter capabilities.
- Responsive Vue.js frontend.
- Dockerized containers for each service and the frontend.

## Tech Stack

- Backend: Laravel (PHP), MySQL
- Frontend: Vue.js 3, Pinia, Vue Router, Tailwind CSS
- DevOps: Docker, Docker Compose

## Project Setup

### Prerequisites

- Docker and Docker Compose
- Node.js and npm/yarn (for Vue frontend)

### Getting Started

To get the application running locally:

1. Clone the repository:

```
git clone https://github.com/ManichevaSvetlana/demo_project books_catalog
cd books_catalog
```

2. Start the backend services:

```
docker-compose up -d
```

3. Apply the migrations and seeders:

```
docker-compose exec books_app php artisan migrate --seed
docker-compose exec reviews_app php artisan migrate --seed
```

4. Start the frontend:

```
cd vue_application
npm install
npm run dev
```

The application will be available on http://localhost:5173/ for the frontend, and the backend services will be accessible on their respective ports as defined in the Docker Compose files.

## Usage

- Use the Vue frontend to interact with the application.
- Access the backend APIs directly for integration or testing purposes.

## Testing

Run the following commands in the services directory for the respective service:

```
docker-compose exec books_app php artisan test
docker-compose exec reviews_app php artisan test
```

