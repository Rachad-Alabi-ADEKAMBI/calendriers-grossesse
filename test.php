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

if ($username == '') {
    $out['username'] = true;
    $out['message'] = 'Username is required';
} elseif ($password == '') {
    $out['username'] = true;
    $out['message'] = 'Only letters, numbers and underscore allowed';
} else {
    $out['message'] = $username;
}

header('Content-type: application/json');
echo json_encode($out);
die();