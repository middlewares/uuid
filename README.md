# middlewares/uuid

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]

Middleware to generate an UUID (Universally Unique Identifiers) and save it in the `X-Uuid` header of the request and response. Useful for debugging purposes.

The UUID generated is compatible with [RFC 4122](http://tools.ietf.org/html/rfc4122) version 4 using [ramsey/uuid](https://github.com/ramsey/uuid) for that.

## Requirements

* PHP >= 7.2
* A [PSR-7 http library](https://github.com/middlewares/awesome-psr15-middlewares#psr-7-implementations)
* A [PSR-15 middleware dispatcher](https://github.com/middlewares/awesome-psr15-middlewares#dispatcher)

## Installation

This package is installable and autoloadable via Composer as [middlewares/uuid](https://packagist.org/packages/middlewares/uuid).

```sh
composer require middlewares/uuid
```

## Usage

```php
Dispatcher::run([
	new Middlewares\Uuid(),

    function ($request) {
        //Get the UUID from the request
        echo $request->getHeaderLine('X-Uuid');
    }
]);

//Get the UUID from the response
echo $response->getHeaderLine('X-Uuid');
```

### header

This option allows to configure the header name. By default is `X-Uuid`.

```php
$uuid = (new Middlewares\Uuid())->header('X-Request-Id');
```

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/middlewares/uuid.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/middlewares/uuid/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/g/middlewares/uuid.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/middlewares/uuid.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/middlewares/uuid
[link-travis]: https://travis-ci.org/middlewares/uuid
[link-scrutinizer]: https://scrutinizer-ci.com/g/middlewares/uuid
[link-downloads]: https://packagist.org/packages/middlewares/uuid
