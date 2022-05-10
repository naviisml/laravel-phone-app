# Phone App

## Table of Contents

- [Table of Contents](#table-of-contents)
- [Features](#features)
- [Installation](#installation)
    - [Composer](#composer)
    - [NPM](#npm)
- [Development](#development)
    - [Docker](#docker)
    - [Local](#local)
- [Testing](#testing)
    - [Dusk](#dusk)
- [Usage](#usage)
    - [Seeder](#seeder)
    - [Commands](#commands)
    - [API](#api)

_Please read through this to make sure you know all the ins and outs, thats less digging for you._

## Features

- Parse messages to and from the 9-digit phone layout
    - [Commands](#commands)
    - [API](#api)
    - Front-End interface for users
    - (+++) History of last 4 translations (saved locally)
    - (+++) Remove translation from history
- (+++) Scheduled Command: _Every hour, the `php artisan swapi:character` command gets executed which creates or updates a character in our database._
- Logs
    - (+++) Extensive log messages
    - (+++) Delete a log (which get logged under another `action`)
- Authentication
    - Login/logout
    - Registering
- Testing
    - Seeders for User and Log creation
    - Utilizing Dusk to test the browser functions
    - Utilizing PHPUnit for Feature, Service and API testing

_*(+++) Some super bonus features_

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

# Development

## Docker

_w.i.p_

## Local

For local development, use these commands.

**Run development server**

```bash
php artisan serve
```

**Compile assets**

```bash
php run dev
```

**Run worker**

```bash
php artisan schedule:work
```

Now visit your website @ http://127.0.0.1:8000

# Testing

```bash
php artisan test
```

## Dusk

Tests that replicate the actual browser.

**Step 1. Install dusk service**

```bash
php artisan dusk:install
```

**Step 2. Run tests**

```bash
php artisan dusk
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

**Retrieve a character from swapi.dev and save or update it to the database**

```bash
php artisan swapi:character
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
