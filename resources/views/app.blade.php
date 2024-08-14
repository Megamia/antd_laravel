<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://static-00.iconduck.com/assets.00/vue-icon-512x442-j09z7tua.png" type="image/png">
    <title>Lavarel</title>
    @vite('resources/js/app.js')
</head>

<body style="margin: 0">
    <div id="app"></div>
</body>

</html>
