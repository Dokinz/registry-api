Follow these steps to set up and run the API:

1. Copy the environment file:
   ```sh
   cp .env.example .env
   ```

2. Install dependencies:
   ```sh
   composer install
   ```

3. Start the application (requires a free port 80, Docker, and Docker Compose):
   ```sh
   ./vendor/bin/sail up -d
   ```

4. Generate the application key:
   ```sh
   ./vendor/bin/sail artisan key:generate
   ```

5. Run database migrations:
   ```sh
   ./vendor/bin/sail artisan migrate
   ```

6. Generate API documentation:
   ```sh
   ./vendor/bin/sail artisan l5-swagger:generate
   ```

   **Documentation URL:** [http://localhost/api/documentation](http://localhost/api/documentation)

7. Run tests:
   ```sh
   ./vendor/bin/sail test
   ```

