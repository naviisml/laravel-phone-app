<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>{{ config('app.name') }}</title>

	<link rel="stylesheet" href="{{ mix('/dist/css/app.css') }}">
</head>
<body>
	@yield('body')

	<script src="/assets/js/fontawesome.js"></script>
	@yield('javascript')
</body>
</html>
