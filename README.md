Yii2 Tagable Models (Development Phase)
=======================================

A Yii2 extension that provides the Yii framework with the functionality of 
creating and assigning tags to your models.

## Installation

Include the package as dependency under the composer.json file.

To install, either run

```bash
$ php composer.phar require jlorente/yii2-tagable-models "*"
```

or add

```json
...
    "require": {
        // ... other configurations ...
        "jlorente/yii2-tagable-models": "*"
    }
```

to the ```require``` section of your `composer.json` file and run the following 
commands from your project directory.
```bash
$ composer update
$ ./yii migrate --migrationPath=@vendor/jlorente/yii2-tagable-models/src/migrations
```

## Usage

In construction

## License 
Copyright &copy; 2015 José Lorente Martín <jose.lorente.martin@gmail.com>.