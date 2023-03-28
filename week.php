<?php

$conceptionDate = '01/01/2023';

function addDaysToDate($date, $daysToAdd)
{
    $date = strtotime($date);
    $newDate = strtotime('+' . $daysToAdd . ' days', $date);
    return date('d-m-Y', $newDate);
}

function calculDuration($date)
{
    $now = time();
    $dateTimestamp = strtotime($date);
    $difference = $now - $dateTimestamp;
    return floor($difference / (60 * 60 * 24));
}

function convertInWeeks($nb_jours)
{
    $nb_semaines = floor($nb_jours / 7); // Calculer le nombre de semaines entières
    $nb_jours_restants = $nb_jours % 7; // Calculer le nombre de jours restants

    // Construire la chaîne de caractères résultante
    $resultat = '';
    if ($nb_semaines > 0) {
        $resultat .=
            $nb_semaines . ' semaine' . ($nb_semaines > 1 ? 's' : '') . ' ';
    }
    if ($nb_jours_restants > 0) {
        $resultat .=
            $nb_jours_restants .
            ' jour' .
            ($nb_jours_restants > 1 ? 's' : '') .
            ' ';
    }

    return trim($resultat); // Retourner le résultat en enlevant les espaces en trop
}

function convertInMonths($nb_jours)
{
    $nb_mois = floor($nb_jours / 30); // Calculer le nombre de mois entiers

    // Construire la chaîne de caractères résultante
    $resultat = '';
    if ($nb_mois > 0) {
        $resultat .= $nb_mois . ($nb_mois > 1 ? 'ème' : 'er') . ' mois';
    }

    return $resultat;
}

function getWeeksArray($startDate, $endDate)
{
    $weeks = [];
    $currentWeek = [];
    $currentDate = new DateTime($startDate);
    while ($currentDate <= new DateTime($endDate)) {
        $currentWeek[] = $currentDate->format('Y-m-d');
        $currentDate->add(new DateInterval('P1D'));
        if (
            $currentDate->format('w') === '0' ||
            $currentDate > new DateTime($endDate)
        ) {
            $weeks[] = $currentWeek;
            $currentWeek = [];
        }
    }
    return $weeks;
}

$today = new DateTime();
$conceptionDatee = '01/01/2023';
$weeksArray = getWeeksArray($conceptionDatee, '2023-12-28');
?>

<!DOCTYPE html>
<html lang='en'>

<head>

    <title>Calendrier de grossesse - Semaine</title>

</head>
<?php include 'menu.php'; ?>

<body>
    <div class='app' id='app'>

        <div class='content'>

            <div class='main'>
                <div class='main__text'>
                    <h1 class='title'>
                        CALENDRIERS GROSSESSE
                    </h1>
                    <p class='text text-center'>
                        Toutes les dates importantes de votre grossesse
                    </p>
                </div>

                <div class='items'>
                    <form class='proceed' action='#' method='POST'>
                        <div class='form'>
                            <label for=''>
                                <p>Date des dernières règles:</p>
                                <input type='date' class='date' name='lastPeriodDate'>
                            </label>

                            <div class='or'>
                                Ou
                            </div>

                            <label for=''>
                                <p>Date de conception:</p>
                                <input type='date' class='date' name='conceptionDate'>
                            </label>

                        </div>

                        <button type='submit' class='btn btn-primary' style='background: #f0c7c2;
                            border: none; color: black;'>
                            Calculer
                        </button>
                    </form>

                    <div class='results'>
                        <div class='results__top'>
                            <h2 class='subtitle'>
                                Mon calendrier de grossesse <span><a href='#calendar'><i
                                            class='fas fa-question'></i></a></span>
                            </h2>
                            <p class='text text-justify'>
                                Vous êtes enceinte de: <span> $convertedDuration </span> <br>
                                Durée d'aménorrhées: <span> $convertedAnDuration </span> <br>
                                bravo, vous avez fait: <span> $percentage % du
                                    chemin</span>
                                <br>

                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class='item' id='calendar'>
                <h2>
                    Calendrier semaine par semaine
                </h2>
                <div class='weeks'>
                    <div class='container table'>
                        <div class='tr row'>
                            <?php foreach ($weeksArray as $index => $week):

                                $currentWeekClass = '';
                                $firstDayOfCurrentWeek = new DateTime($week[0]);
                                $lastDayOfCurrentWeek = new DateTime(
                                    end($week)
                                );
                                if (
                                    $today >= $firstDayOfCurrentWeek &&
                                    $today <= $lastDayOfCurrentWeek
                                ) {
                                    $currentWeekClass = ' current-week';
                                }
                                ?>
                            <div class='td week col-9 mx-auto <?= $currentWeekClass ?>'>
                                <p class='text text-center'>Semaine <?= $index +
                                    1 ?> Du <?= $firstDayOfCurrentWeek->format(
     'd/m/Y'
 ) ?> au <?= $lastDayOfCurrentWeek->format('d/m/Y') ?></p>
                            </div>
                            <?php
                            endforeach; ?>
                        </div>
                    </div>
                </div>


                <br>
                <p class='text text-justify'>
                    La durée de la grossesse est un sujet important pour les femmes enceintes et leurs médecins. Il est
                    important de comprendre les différentes méthodes de calcul pour déterminer le nombre de semaines de
                    grossesse et d'aménorrhée.
                    <br><br>
                    La grossesse dure en moyenne 39 semaines de grossesse et 41 semaines d'aménorrhées. Pour calculer le
                    nombre de semaines de grossesse, il faut prendre la date de conception comme point de départ. En
                    revanche, pour calculer le nombre de semaines d'aménorrhée, il faut prendre le premier jour des
                    dernières règles.
                    <br><br>
                    Il existe une différence d'environ deux semaines entre les semaines de grossesse et les semaines
                    d'aménorrhée. Les semaines de grossesse prennent pour référence la date de fécondation, tandis que
                    les semaines d'aménorrhée prennent pour référence le premier jour des dernières règles. Les
                    professionnels de santé préfèrent utiliser les semaines d'aménorrhée car la date des dernières
                    règles est plus précise. Il est donc important de comprendre cette différence de 15 jours entre ces
                    deux méthodes de calcul.
                    <br><br>
                    Enfin, le terme 'aménorrhée' signifie simplement 'absence de règle, selon le dictionnaire Larousse.
                    Il est utilisé pour calculer la durée de la grossesse en prenant en compte le début de l'absence de
                    règles comme point de départ.
                </p>
            </div>
            <hr>

            <div class='links mx-auto text-center'>
                <a class='btn btn-primary' style='color: #393F82; border: #393F82; background-color: bisque;'
                    href='https://www.calendriers-grossesse.com/calcul-semaine-grossesse/'>
                    Calcul semaine grossesse
                </a>

                <a class='btn btn-primary' style='color: #393F82; border: #393F82; background-color: bisque;'
                    href='https://www.calendriers-grossesse.com/calcul-mois-grossesse/'>
                    Calcul mois grossesse
                </a>

                <a class='btn btn-primary' style='color: #393F82; border: #393F82;  background-color: bisque;'
                    href='https://www.calendriers-grossesse.com/calcul-date-daccouchement/'>
                    Calcul date d'accouchement
                </a>
            </div>
        </div>
    </div>
    <script src='./public/js/app.js'></script>
</body>


<style>

</style>


</html>