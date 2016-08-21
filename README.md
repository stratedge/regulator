[![Build Status](https://travis-ci.org/stratedge/regulator.svg?branch=master)](https://travis-ci.org/stratedge/regulator)

# Regulator
An API filtering and output regulation toolbox for Laravel 5.*.

Out of the box Regulator is an easy-to-use library that formats the output of a Laravel-based API based on standardized parameters provided by the API consumer. At its core, it is a customizable framework that allows for controlled, individualized output of Laravel models and collections.

## Installation

Regulator can be installed with composer.

Since Regulator is not yet registered with packagist you will need to add it as a repository before you can complete a composer installation. Add the following to your composer.json file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/stratedge/regulator"
    }
]
```

Once the repository is added to your composer.json file, you can install the library with composer:

```sh
composer require stratedge/regulator
```

## Running Tests

To run the library's unit test suite, first make sure that you have the library's development dependencies by running:

```sh
composer install
```

Once all the dependencies are available, run the following command from the project root:

```sh
php vendor/bin/phpunit
``` 