# Phone App

## Table of Contents

- [Table of Contents](#table-of-contents)
- [Features](#features)
- [Installation](#installation)
    - [Composer](#composer)
    - [NPM](#npm)
    - [Testing](#testing)

_Please read through this to make sure you know all the ins and outs, thats less digging for you._

## Features

- Parse messages to and from the 9-digit phone layout
    - [Commands](#commands)
    - [API](#api)
- Logs
    - Extensive log messages
    - Delete a log (which get logged under another `action`)
- Authentication
    - Login/logout
    - Registering
- Testing
    - Seeders for User and Log creation
    - Utilizing Dusk to test the browser functions
    - Utilizing PHPUnit for Feature, Service and API testing

# Installation

## Composer

**Step 1. Install Depencencies**

```bash
composer install
```

**Step 2. Generate keys**

```bash
php artisan key:generate
```

```bash
php artisan jwt:secret
```

## NPM

**Step 1. Install Depencencies**

```bash
npm install
```

**Step 2. Compile assets**

```bash
npm run dev # Compile the assets for development
npm run watch # Compile the assets with hot-reloading
npm run prod # Compile the assets for production
```

## Dusk

**Step 1. Install dusk service**

```bash
php artisan dusk:install
```

**Step 2. Run tests**

```bash
php artisan test # Run the normal test cases
php artisan dusk # Run the dusk test cases
```

# Usage

## Seeder

**Logs**

Creates 50 example translations

```bash
php artisan db:seed --class=TranslationSeeder
```

**Example user**

```
php artisan db:seed --class=UserSeeder
```

**Email:** `admin@email.com`
**Password:** `password`

## Commands

**Parse a string to the number equivelent**

```bash
php artisan parse:text <string>
```

**Parse a number to the string equivelent**

```bash
php artisan parse:number <number>
```

## API

### `GET` Logs

Get the translated messages, paginated by 25. (For authenticated users only)

**URL**

```
http://localhost:8000/api/parser/logs
```

**Parameters**

| Key               | Value             |
| ----------------- | ----------------- |
| `page`            | The page you wanna see the results for |

### `POST` Parse Text

Parse a string to the number equivelent

**URL**

```
http://localhost:8000/api/parser/text
```

**Parameters**

| Key               | Value             |
| ----------------- | ----------------- |
| `string`          | The string you want to parse |

### `POST` Parse Number

Parse a number to the string equivelent

**URL**

```
http://localhost:8000/api/parser/number
```

**Parameters**

| Key               | Value             |
| ----------------- | ----------------- |
| `number`          | The number you want to parse |
