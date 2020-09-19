<?php


if (isset($_GET["redirect"])) {
    $redirect = $_GET["redirect"];
    header("Location: $redirect.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>

<body>
    <a href="?redirect=login">Fazer Login</a>
</body>

</html>