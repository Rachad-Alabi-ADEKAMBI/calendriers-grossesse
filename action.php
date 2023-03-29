<?php

if (!empty($_POST)) {
    // Initialize $conceptionDate to null
    $conceptionDate = null;

    // Check if 'lastPeriodDate' is set
    if (isset($_POST['lastPeriodDate'])) {
        // Calculate the conception date by adding 14 days to 'lastPeriodDate'
        $conceptionDate = strtotime($_POST['lastPeriodDate'] . ' +14 days');
        $conceptionDate = date('d-m-Y', $conceptionDate);
    }

    if (isset($_POST['conceptionDate'])) {
        // Use the 'conceptionDate' if it is set
        $conceptionDate = strtotime($_POST['conceptionDate']);
        $conceptionDate = date('d-m-Y', $conceptionDate);
    }

    // Save the $conceptionDate to the $_SESSION superglobal under the 'preg' key
    $_SESSION['preg'] = [
        'conceptionDate' => $conceptionDate,
    ];
}