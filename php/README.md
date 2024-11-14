## Usage

The purpose of this is to provide good examples for the refactoring workshop.

## Build

All you need to build this project is php-cli and composer

### DDEV alternative

This ddev configuration was created by using:
```shell
ddev config
```
* Project name (php): movie-rental-myself-php
* Project Type [backdrop, craftcms, django4, drupal10, drupal6, drupal7, drupal8, drupal9, laravel, magento, magento2, php, python, shopware6, silverstripe, typo3, wordpress] (php): php

All you need to run is:
```shell
sudo ddev composer i
```

## Testing

Unit tests can be run using composer:

```shell
composer test
```

### DDEV alternative

```shell
ddev composer run test
```

Tests are located in the root directory and run using phpunit.
