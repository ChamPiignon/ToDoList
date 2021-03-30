<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Erreur</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link href="css/error.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png"  href="img/toDoList.png" />
</head>

<body class="row">
<figure>
    <div class="sad-mac"></div>
    <figcaption>
        <?php
        foreach ($errors as $errors) {
            echo "<h1>$errors</h1>";
        }
        ?>
    </figcaption>
</figure>
</body>
</html>

