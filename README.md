[![CI Main](https://github.com/claudio1994-oliveira/hey_professor/actions/workflows/laravel.yml/badge.svg?branch=main)](https://github.com/claudio1994-oliveira/hey_professor/actions/workflows/laravel.yml)

[![CI Develop](https://github.com/claudio1994-oliveira/hey_professor/actions/workflows/laravel.yml/badge.svg?branch=develop)](https://github.com/claudio1994-oliveira/hey_professor/actions/workflows/laravel.yml)

## About Hey Professor

Hey Professor is a Laravel application designed to facilitate the creation of questions, allowing them to be voted on. The most upvoted questions are highlighted, making it easier for teachers to prioritize and answer them.

## Features

-   Create and manage questions.
-   Allow students to vote on questions.
-   Highlight the most upvoted questions for the teacher's attention.

## Getting Started

Follow these steps to get your Hey Professor application up and running:

### Prerequisites

1. Make sure you have [Composer](https://getcomposer.org/) installed.
2. Install [Laravel](https://laravel.com/docs/8.x) if you haven't already.

### Installation

1. Clone the Hey Professor repository to your local machine:

    ```bash
    git clone https://github.com/yourusername/hey-professor.git

    ```

2. Change to the project's directory:

    ```bash
    cd hey-professor

    ```

3. Install the project dependencies:

    ```bash
    composer install

    ```

4. Create a copy of the .env file:

    ```bash
    cp .env.example .env

    ```

5. Generate a unique application key:

    ```bash
    php artisan key:generate

    ```

6. Configure your database settings in the .env file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

    ```

7. Migrate the database:

    ```bash
    php artisan migrate

    ```

8. Start the Laravel development server:

    ```bash
    php artisan serve

    ```

9. Access the application in your browser at http://localhost:8000.

## Usage

-   Sign in as a teacher to create and manage questions.
-   Students can vote on questions to prioritize them.
-   The most upvoted questions will be highlighted for the teacher to address.

## License

This project is licensed under the MIT License.

## Contact

If you have any questions or need assistance, feel free to contact:

-   Cláudio Oliveira
-   franciscoclaudiooliveira@gmail.com
