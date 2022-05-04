# Phone App

## Features

- API
- ~~Authentication~~
- Commands
- Facades
- ~~Tests~~

## Commands

```bash
php artisan parse:text <input>
```

```bash
php artisan parse:number <input>
```

## Facades

```php
use PhoneParser;
```

**Example 1**

Parse a text input to the number version

```php
use PhoneParser;

$output = PhoneParser::text('example'); // Output: ...
```

**Example 2**

Parse a number input to the text version

```php
use PhoneParser;

$output = PhoneParser::text('123222333*22'); // Output: ...
```

## API

**1. `GET` Parse a text input to the number version**

```
<url>/api/parse/text/<input>
```

**2. `GET` Parse a number input to the text version**

```
<url>/api/parse/number/<input>
```
