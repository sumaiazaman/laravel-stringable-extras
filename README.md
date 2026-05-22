# Laravel Stringable Extras

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sumaiazaman/laravel-stringable-extras.svg?style=flat-square)](https://packagist.org/packages/sumaiazaman/laravel-stringable-extras)
[![Tests](https://img.shields.io/github/actions/workflow/status/sumaiazaman/laravel-stringable-extras/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sumaiazaman/laravel-stringable-extras/actions/workflows/tests.yml)
[![License](https://img.shields.io/packagist/l/sumaiazaman/laravel-stringable-extras.svg?style=flat-square)](LICENSE)

Adds the missing `whenDoesntContain()` and `whenDoesntContainAll()` methods to Laravel's fluent `Stringable` class.

Laravel ships with `whenContains()` and `whenContainsAll()`, and has negative counterparts for start/end (`whenDoesntStartWith`, `whenDoesntEndWith`), but the negative counterpart for `contains` was never added to the framework. This package fills that gap.

## Requirements

- PHP 8.2+
- Laravel 11, 12, or 13

## Installation

```bash
composer require sumaiazaman/laravel-stringable-extras
```

The service provider is auto-discovered — no manual registration needed.

## Usage

### `whenDoesntContain()`

Executes the callback when the string does **not** contain the given substring. Accepts a string or an array of strings (any match counts).

```php
// Callback fires — string doesn't contain 'xxx'
$result = str('hello world')
    ->whenDoesntContain('xxx', fn ($s) => $s->upper());
// 'HELLO WORLD'

// Callback is skipped — string contains 'world'
$result = str('hello world')
    ->whenDoesntContain('world', fn ($s) => $s->upper());
// 'hello world'

// With a default callback
$result = str('hello world')
    ->whenDoesntContain(
        'world',
        fn ($s) => $s->upper(),
        fn ($s) => $s->title(),
    );
// 'Hello World'

// Array of needles — callback fires only if none are present
$result = str('hello world')
    ->whenDoesntContain(['foo', 'bar'], fn ($s) => $s->upper());
// 'HELLO WORLD'
```

### `whenDoesntContainAll()`

Executes the callback when the string does **not** contain all of the given substrings. If even one needle is missing, the callback fires.

```php
// Callback fires — 'xxx' is not in the string
$result = str('hello world')
    ->whenDoesntContainAll(['hello', 'xxx'], fn ($s) => $s->upper());
// 'HELLO WORLD'

// Callback is skipped — both needles are present
$result = str('hello world')
    ->whenDoesntContainAll(['hello', 'world'], fn ($s) => $s->upper());
// 'hello world'
```

## Testing

```bash
composer test
```

## License

MIT. See [LICENSE](LICENSE).
