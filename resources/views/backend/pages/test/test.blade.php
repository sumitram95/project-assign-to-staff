<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('date.changer') }}" method="POST">
        @csrf
        <input type="number" placeholder="Year" name="year">
        <input type="number" placeholder="month" name="month">
        <input type="number" placeholder="day" name="day">
        <input type="submit">
    </form>
</body>

</html>
