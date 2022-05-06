# Phone App

## Features

- API
- ~~Authentication~~
- Commands
- Facades
- ~~Tests~~
- ~~Databasing~~

## Commands

```bash
php artisan parse:text <input>
```

```bash
php artisan parse:number <input>
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
