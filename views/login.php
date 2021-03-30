<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Se connecter</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png"  href="img/toDoList.png" />
</head>
<body>
    <div class="login-page">
        <div class="form">
            <h1>Se connecter</h1>
            <form class="login-form" action="./?action=login" method="POST">
                <input name="email" placeholder="Email" required=""/>
                <input name="password" type="password" placeholder="Mot de passe" required=""/>
                <label class="message" for="chkbx">Rester connecté</label>
                <input name="isRemember" type="checkbox" id="chkbx"/>
                <button name="login">Se connecter</button>
                <a class="message" href="./?action=register">Créer un compte?</a>
            </form>
        </div>
    </div>
</body>
</html>