<?php

require '../config/connexion.php';
require '../managers/UserManager.class.php';


if (isset($_GET['id'])) {
    $deleteManager = new UserManager($db);

    $deleteManager->deleteUser($_GET['id']);
}

header('location: http://localhost/projet-userbase/pojet_userbase/index.php?route=user-list');
