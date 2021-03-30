<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Créer un compte</title>
	<meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png"  href="img/toDoList.png" />
</head>
<body>
    <div class="register-page">
        <div class="form">
            <h1>Créer un compte</h1>
            <form class="register-form" action="./" method="GET">
                <input name="firstName" type="text" placeholder="Nom"/>
                <input name="familyName" type="text" placeholder="Prénom"/>
                <input name="email" type="text" placeholder="Email"/>
                <input name="password" type="password" placeholder="Mot de passe"/>
                <input name="checkPassword" type="password" placeholder="Vérifier votre mot de passe"/>
                <button type="submit" name="action" value="register">S'inscrire</button>
                <a class="message" href="./?action=login" >Se connecter?</a></p>
            </form>
        </div>
    </div>
</body>
</html>