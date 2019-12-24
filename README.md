## Free Trial Email Verification Tool



### Installation

1. Clone this repository
2. Run `composer install` to download and configure the project's PHP dependencies
3. Rename `.env.example` to the main configuration file `.env` and update your database connection directives (DB_*) 
4. Run `php artisan key:generate` to generate the application key
5. Create a database using your favorite (and supported by [doctrine/dbal](https://github.com/doctrine/dbal)) DBMS
6. Run `php artisan migrate` to create the `emails` table  

### Back End

Laravel 6 was chosen to leverage it's MVC, API, Database Migrations and Testing features.

`Email`'s Model and Controller were created through Artisan in their default directory and a `EmailService` custom class was created within `/app/Services`.

Basic error handling was implemented to return the proper (format and status) API responses.

No Authentication was implemented as it was not part of the requirement.

This projects enforces [PSR-2](https://www.php-fig.org/psr/psr-2/).

### Database

No built-in laravel migration was used to stick to what was requested (just an email table).

This is the only table needed/created for the exercise:

```sql
CREATE TABLE `emails` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE KEY `emails_email_unique` USING BTREE (`email`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;
```

### Testing

This project was built under _TDD_ using [PHPUnit](https://phpunit.de/) to write Feature Tests (to cover API Endpoints). Integration and Unit Tests will still be written.       

The database was mocked by creating, on the fly, a testing instance and running migrations and seeders on it. In Memory database was not used to make it easier for whom is evaluating it (SQLite won't be required). 

The `.env.testing` (see below) directive `DB_PERSIST_TEST_DATA` (0 or 1) allows the data generated during the tests to be persisted after the tests have finished.

To run PHPUnit Tests, copy the `/.env` file to `/.env.testing` with the following changes:
   * `APP_ENV` should be `testing`
   * `DB_DATABASE` should end with `-test` (will be created during the tests)
   * if you want the Test's data to be persisted, add a directive `DB_PERSIST_TEST_DATA=1`  

### Front End

The interface was built using Bootstrap 4 and jQuery (for notification and the AJAX requests) but you can check a recent project of mine using Vue [here](https://github.com/fknoedt/lara-blog).
