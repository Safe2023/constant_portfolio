<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('newsletter') }}" method="POST">
    @csrf
    <label for="email">Votre email :</label>
    <input type="email" name="email" required>
    <button type="submit">S'abonner</button>
</form>

</body>
</html>