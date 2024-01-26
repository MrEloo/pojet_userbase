<?php

require 'managers/UserManager.class.php';
require 'config/connexion.php';

$userManage = new UserManager($db);


$userManage->loadUsers();
$users = $userManage->getUsers();
