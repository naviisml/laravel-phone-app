# Phone App

## Table of Contents

- [Table of Contents](#table-of-contents)
- [Features](#features)
- [Installation](#installation)
    - [Testing](#testing)

## Features

- [Commands](#commands)
- [API](#api)

_Please read through this to make sure you know all the ins and outs, thats less digging for you._

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

## Usage

**Example user**

```
php artisan db:seed --class=UserSeeder
```

**Email:** `admin@email.com`
**Password:** `password`

## Testing

**Step 1. Install dusk service**

```bash
php artisan dusk:install
```

**Step 2. Run tests**

```bash
php artisan test # Run the normal test cases
php artisan dusk # Run the dusk test cases
```

# Commands

**Parse a string to the number equivelent**

```bash
php artisan parse:text <string>
```

**Parse a number to the string equivelent**

```bash
php artisan parse:number <number>
```

# API

## `POST` Parse Text

Parse a string to the number equivelent

```
http://localhost:8000/api/parser/text
```

**Parameters**

| Key               | Value             |
| ----------------- | ----------------- |
| `string`          | The string you want to parse |

## `POST` Parse Number

Parse a number to the string equivelent

```
http://localhost:8000/api/parser/number
```

| Key               | Value             |
| ----------------- | ----------------- |
| `number`          | The number you want to parse |
