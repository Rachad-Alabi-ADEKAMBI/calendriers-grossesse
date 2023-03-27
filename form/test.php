<?php

$out = [
    'username' => false,
    'password' => false,
    'firstname' => false,
    'lastname' => false,
    'email' => false,
    'website' => false,
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
$firstname = check_input($_POST['firstname']);
$lastname = check_input($_POST['lastname']);
$email = check_input($_POST['email']);
$website = check_input($_POST['website']);

if ($username == '') {
    $out['username'] = true;
    $out['message'] = 'Username is required';
} elseif (!preg_match('/^[a-zA-Z_1-9]*$/', $username)) {
    $out['username'] = true;
    $out['message'] = 'Only letters, numbers and underscore allowed';
} elseif ($password == '') {
    $out['password'] = true;
    $out['message'] = 'Password is required';
} elseif ($firstname == '') {
    $out['firstname'] = true;
    $out['message'] = 'Firstname is required';
} elseif (!preg_match('/^[a-zA-Z ]*$/', $firstname)) {
    $out['firstname'] = true;
    $out['message'] = 'Only letters and white space allowed';
} elseif ($lastname == '') {
    $out['lastname'] = true;
    $out['message'] = 'Lastname is required';
} elseif (!preg_match('/^[a-zA-Z ]*$/', $lastname)) {
    $out['lastname'] = true;
    $out['message'] = 'Only letters and white space allowed';
} elseif ($email == '') {
    $out['email'] = true;
    $out['message'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $out['email'] = true;
    $out['message'] = 'Invalid Email Format';
} elseif ($website == '') {
    $out['website'] = true;
    $out['message'] = 'Website is required';
} elseif (
    !preg_match(
        '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
        $website
    )
) {
    $out['website'] = true;
    $out['message'] = 'Invalid URL';
} else {
    $out['message'] = 'Form Validated';
}

header('Content-type: application/json');
echo json_encode($out);
die();