# Fortress Project's FolkBundle

Folk's user bundle for Symfony.

FolkBundle provides a database-backed user system in Symfony5. It adds a flexible framework for user management and
 common tasks such as registration or password retrieval.

Features are:

* **Log in methods** (Guard authenticators):
  * *Planned:* HTTP digest method defined in [RFC7616](https://tools.ietf.org/html/rfc7616),
  * *Planned:* Form login method,
* *Planned:* Registration form with or without confirmation email,
* *Planned:* Password reset form,

## Documentation

Currently no compiled documentation are provided but you may lookup at the source code PHPDoc...

We will provide reStructuredText as soon as basic features are working.

## License

FolkBundle is released under the GNU GPL v3 (see the [LICENSE](LICENSE) file).

## Installation

Make sure Composer is installed globally, as explained in the
 [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require fortress-project/folk-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require fortress-project/folk-bundle
```

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Fortress\Folk\FortressFolkBundle::class => ['all' => true],
];
```

## Contributing

See [Contributing guidelines](CONTRIBUTING.md).
