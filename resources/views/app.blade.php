<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lavarel</title>
    @vite('resources/js/app.js')
</head>
<body style="margin: 0">
    <div id="app"></div>
</body>
</html>