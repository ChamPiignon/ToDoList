<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>ToDoList</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link href="css/utils.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png"  href="img/toDoList.png" />
    <script type="text/javascript" src="js/PopUp.js"></script>
</head>

<body class="row">
<div class="col col-3">
    <div class="section-menu">
        <div class="user">
            <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) : ?>
                <div class="text-block"><?php echo "Bonjour " . $_SESSION["prenom"] . "!"; ?></div>
            <?php endif; ?>
            <?php if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) : ?>
                <div class="text-block"><?php echo 'Visiteur'; ?></div>
            <?php endif; ?>
        </div>
        <div class="list-menu">
            <div class="section-menu">
                <?php if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) : ?>
                    <a href="./?action=login" class="button">Connexion</a>
                    <a href="./?action=register" class="button">S'inscrire</a>
                <?php endif; ?>
                <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) : ?>
                    <a href="./?action=disconnect" class="button">Deconnexion</a>
                <?php endif; ?>
                <a href="./?option=addProj" class="button">Ajouter un projet</a>
            </div>
            <?php if (isset($projects)) : ?>

                <?php $index = 0;
                foreach ($projects as $project):?>
                    <a class="list" href="./?project=<?= $index ?>"><?= $project->getTitle() ?></a>
                    <?php $index++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="main col col-9">
    <div class="edit-project">
        <div class="column row">
            <div class="column col col-6">
                <h1 class="heading"><?php if (isset($this->projectSelect)) : ?><?= $this->projectSelect->getTitle() ?><?php endif; ?></h1>
            </div>
            <div class="column col col-6">
                <a onclick="renamePopUp(<?php if (isset($_REQUEST['project'])) : ?><?=$_REQUEST['project']?>)<?php endif; ?>" class="button">Renommer projet</a>
                <a href="<?php if (isset($_REQUEST['project'])) : ?>./?project=<?= $_REQUEST['project'] ?>&option=removeProj<?php endif; ?>"
                   class="button">Supprimer projet</a>
            </div>
        </div>
    </div>
    <form action="./" method="POST">
    <div class="add-task">
        <input name="nameNewTask" type="text" class=" input text-field" maxlength="256"  data-name="Field" placeholder="Entrez votre nouvelle tâche" id="field"/>
        <input type="hidden"<?php if (isset($_REQUEST['project'])) : ?>name="project"  value="<?= $_REQUEST['project'] ?>"<?php endif; ?>>
        <input name="option" type="hidden" value="addTask">
        <button type="submit" class="button">Ajouter la tâche</button>
    </div>
    </form>
    <form method="POST" action="./">
        <div class="list-task">
            <input type="hidden"<?php if (isset($_REQUEST['project'])) : ?>name="project"  value="<?= $_REQUEST['project'] ?>"<?php endif; ?>>
            <?php if (isset($tasks)) : ?>
                <?php $index=0; ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="task">
                        <div class="column row">
                            <div class="col col-9"><label>
                                    <input type="checkbox" name="task<?= $index ?>"/>
                                    <span class="label"><?= $task->getDescription() ?></span>
                                </label>
                            </div>
                            <div class="col col-3">
                                <?php if (boolval($task->getIsDone())) : ?>
                                    <div class="stat-done">Fait</div>
                                <?php endif; ?>
                                <?php if (!boolval($task->getIsDone())) : ?>
                                    <div class="stat-to-do">A faire</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php $index++; ?>
                <?php endforeach; ?>
                <input type="hidden" name="nbCheckBox"  value="<?= $index ?>">
            <?php endif; ?>
        </div>
        <div class="edit-task">
            <button type="submit" value="markTasksDone" name="option" class="button">Marquer comme &quot;Fait&quot;</button>
            <button type="submit" value="markTasksDo"   name="option" class="button">Marquer comme &quot;A faire&quot;</button>
            <button type="submit" value="removeTasks"   name="option" class="button">Supprimer la sélection</button>
        </div>
    </form>
</div>


</body>
</html>