<?php

require_once '../models/User.class.php';
require '../config/connexion.php';
require '../managers/UserManager.class.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role'])) {
    $newUser = new User(
        $_POST['username'],
        $_POST['email'],
        $_POST['password'],
        $_POST['role'],
    );
}

$newInstance = new UserManager($db);

$newInstance->saveUser($newUser);


header('location: http://localhost/projet-userbase/pojet_userbase/index.php?route=user-list');
