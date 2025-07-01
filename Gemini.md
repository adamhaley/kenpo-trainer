This is a Laravel project with a Vue.js frontend.

## Backend

The backend is a standard Laravel application.

### Dependencies

PHP dependencies are managed with Composer. To install them, run:

```bash
composer install
```

### Database

The application uses a database. The configuration is in `config/database.php`. By default, it's configured to use MySQL. You'll need to create a `.env` file (you can copy `.env.example`) and set your database credentials.

To run the database migrations, use:

```bash
php artisan migrate
```

To seed the database with initial data, use:

```bash
php artisan db:seed
```

### Testing

The project uses PHPUnit for testing. To run the tests, use:

```bash
./vendor/bin/phpunit
```

## Frontend

The frontend uses Vue.js and is managed with Vite.

### Dependencies

Node.js dependencies are managed with npm or yarn. To install them, run:

```bash
npm install
```
or
```bash
yarn install
```

### Development

To run the frontend development server, use:

```bash
npm run dev
```

### Building

To build the frontend for production, use:

```bash
npm run build
```

## Architecture Analysis

This project follows the standard Laravel MVC (Model-View-Controller) architecture.

*   **Main Modules and Their Responsibilities:**
    *   `app/Http/Controllers`: Controllers handle user requests, retrieve data from models, and pass it to views. Key controllers include `TechniqueController`, `AttackController`, and `TrainingSessionController`.
    *   `app/Models`: Models represent the application's data and business logic. Key models include `Technique`, `Attack`, `Belt`, and `TrainingSession`.
    *   `resources/views`: Views are the presentation layer, containing the HTML templates. The project uses Blade templating.
    *   `routes`: Defines the application's endpoints and maps them to controller actions. `web.php` is for web routes, and `api.php` is for API routes.
    *   `database`: Contains database migrations, seeders, and factories.
    *   `public`: The web server's document root, containing the `index.php` entry point and compiled assets.
    *   `resources/js`: Contains the Vue.js frontend components.
    *   `tests`: Contains the application's tests, including unit and feature tests.

*   **Data Flow and Dependencies:**
    1.  A user request hits a URL defined in `routes/web.php` or `routes/api.php`.
    2.  The route forwards the request to the appropriate controller in `app/Http/Controllers`.
    3.  The controller interacts with the necessary models in `app/Models` to retrieve or manipulate data.
    4.  The models interact with the database.
    5.  The controller passes the data to a view in `resources/views`.
    6.  The view renders the final HTML, which is sent back to the user's browser.
    7.  Frontend assets (CSS, JS) are managed by Vite and referenced in the views.

*   **Use of Design Patterns:**
    *   **Model-View-Controller (MVC):** The core architectural pattern of Laravel.
    *   **Facade:** Laravel uses facades to provide a simple, static interface to services in the service container (e.g., `DB`, `Cache`).
    *   **Repository (implied):** While not explicitly implemented with interfaces, the controllers effectively act as repositories by encapsulating data access logic.
    *   **Factory:** Used for creating model instances for testing and seeding (`database/factories`).
    *   **Singleton:** The Laravel service container manages singletons for many services.

*   **Potential Architecture Issues:**
    *   **Fat Controllers:** Some controllers might become bloated with logic that could be extracted into service classes or other objects. This is a common issue in MVC applications.
    *   **Lack of a Service Layer:** For more complex business logic, a dedicated service layer between controllers and models would improve separation of concerns and reusability.
    *   **Tight Coupling to Eloquent:** The controllers are directly coupled to Eloquent models. While convenient, this can make testing and refactoring more difficult. Using a repository pattern with interfaces could decouple the controllers from the data access implementation.
    *   **Frontend/Backend Coupling:** The frontend and backend are in the same repository. While this is fine for smaller projects, it can become difficult to manage as the application grows. A separate frontend application that communicates with a dedicated API could be a better long-term solution.
