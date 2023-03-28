<?php

$out = [
    'username' => false,
    'password' => false,
];

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = check_input($_POST['username']);
$password = check_input($_POST['password']);

if ($password == '') {
    $result = date('d-m-Y', strtotime($username . ' +14 days')); // ajoute 14 jours
} elseif ($password != '' && $username != '') {
    $result = $password;
}

$out['message'] = $result;

header('Content-type: application/json');
echo json_encode($out['message']);
die();