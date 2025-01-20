# Roman Numerals API

This repo is for a technical test and not for practical or use in a production environment.

## Application Decisions

I decided to alter the originally provided `RomanNumeralConverter` service to encompass a driver manager pattern, this approach allows for future developers to extend and provide newer drivers of conversion using the provided interface `IntegerConverterInterface`.

By taking this approach it meant the database structure had to be flexible to also encompass this. I took the opportunity to provide two additional drivers as an example of what another unit of conversion might look like and how this could be integrated.

This is demonstrated in both the `Feature` and `Unit` tests through testing the converter directly and through driver implementation and again on a controller specific level ensuring results are correctly delivered with the use of `JsonResources`.

## Running the application

To run the application with Laravel Sail please follow the following instructions:

1. First run the following command via your designated terminal, this will install all required composer packages using PHP 8.4

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

2. Build the the pre-configured Ubuntu 24.04 image for our application by executing the following command:

```bash
./vendor/bin/sail build --no-cache
```

3. Start our newly built Ubuntu with the following command:

```bash
./vendor/bin/sail up -d
```

4. Migrate and seed our SQLite database by executing the following command:
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

Note to shut down the image simply enter: `./vendor/bin/sail down`

Alternatively if you do not wish to use Docker/Laravel Sail and have PHP/Composer installed locally you may follow the following steps instead:

1. `composer install -o`
2. `php artisan migrate:fresh --seed`
3. `php artisan serve`

The application will be served on `http://localhost:8000`


## Running Tests

Depending on how you executed the application you may execute tests via one of two commands `php artisan test` or `./vendor/bin/sail artisan test`

## Endpoints

- `[GET] - /api/conversions` - List all conversions for a specific driver (all by default, pass the query parameter `conversion` and a supported conversion driver name, e.g. `/api/conversion?conversion=kg_to_gram`)
- `[POST] - /api/conversions` - Post form data with the fields `value` and `conversion` to convert a value to the designated unit of conversion
- `[GET] - /api/conversions/popular` - Get the top 10 popular converted units of conversion (all by default, pass the query parameter `conversion` and a supported conversion driver name, e.g. `/api/conversion/popular?conversion=kg_to_gram`)
- `[GET] - /api/conversions/{conversion}` - Retrieve a previous conversion with a specified ID

