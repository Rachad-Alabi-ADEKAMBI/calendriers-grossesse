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
?>

<!DOCTYPE html>
<html lang='en'>

<head>


    <title>Calendrier de grossesse - Accouchement</title>

</head>

<?php include 'menu.php'; ?>

<body>
    <div class='app' id='app'>
        <div class='content'>
            <div class='main'>
                <div class='main__text'>
                    <h1 class='title'>
                        CALCUL DE LA DATE D'ACCOUCHEMENT
                    </h1>
                </div>

                <div class='items text-center'>
                    <form class='proceed mx-auto' action='#' method='POST'>
                        <div class='form'>
                            <label for=''>
                                <p>Date des dernières règles: </p>
                                <input class='date mx-auto text-center' name='lastPeriodDate' type=`text`
                                    placeholder=$lastPeriodDate onfocus='(this.type=`date`)' onblur=`(this.type='text'
                                    )` style='width:150px;'>
                            </label>

                            <div class='or'>
                                Ou
                            </div>


                            <label for=''>
                                <p>Date des dernières règles: </p>
                                <input class='date mx-auto text-center' name='conceptionDate' type=`text`
                                    placeholder=$conceptionDate onfocus='(this.type=`date`)' onblur=`(this.type='text'
                                    )` style='width:150px; '>
                            </label>

                        </div>

                        <button type='submit' class='btn btn-primary' style='background-color: #fa899c;
                        border: none; color: white;'>
                            Calculer
                        </button>
                    </form>
                </div>
            </div>

            <div class='item' id='calendar'>
                <h2>
                    DATE D'ACCOUCHEMENT
                </h2>


                <p class='text text-justify'>
                    La date d'accouchement prévue ou présumée (DPA) est une étape importante pour les femmes enceintes
                    et leurs médecins. Cette date est calculée à partir de la date de conception. En théorie, il suffit
                    d'ajouter neuf mois à la date de début de grossesse pour déterminer la DPA.
                    <br><br>
                    Cependant, il est important de noter que chaque femme est différente et que la durée de la grossesse
                    peut varier d'une personne à l'autre. De plus, la date de conception peut être difficile à
                    déterminer avec précision, surtout si une femme a des cycles menstruels irréguliers. C'est pourquoi
                    les médecins utilisent souvent des méthodes plus précises pour estimer la date d'accouchement,
                    telles que l'échographie.
                    <br><br>
                    La date d'accouchement prévue est importante car elle permet aux femmes enceintes de se préparer
                    mentalement et physiquement pour l'arrivée de leur bébé. Cependant, il est important de noter que la
                    DPA n'est qu'une estimation et que l'accouchement peut se produire à tout moment, que ce soit avant
                    ou après la date prévue.
                    <br><br>
                    En cas de dépassement de la DPA, les médecins peuvent recommander des mesures pour déclencher
                    l'accouchement, telles que l'administration d'ocytocine ou une césarienne. Cependant, il est
                    important de noter que chaque grossesse est unique et que les décisions concernant l'accouchement
                    doivent être prises au cas par cas, en tenant compte de la santé de la mère et du bébé.
                </p>
            </div>
            <hr> <br>

            <div class='bottom'>
                <h2 class='subtitle'>
                    Date d'accouchement:
                </h2>
                <p class='text text-justify'>
                    Date d'accouchement prévue: <span> $dueDate</span> <br>

                </p>
            </div> <br>
            <hr>


            <div class='links mx-auto text-center'>
                <a class='btn btn-primary' style='background-color: #fa899c;
                border: none; color: white;' href='https://www.calendriers-grossesse.com/'>
                    Calendrier grossesse
                </a>

                <a class='btn btn-primary' style='background-color: #fa899c;
                border: none; color: white;' href='https://www.calendriers-grossesse.com/calcul-semaine-de-grossesse/'>
                    Calcul semaine de grossesse
                </a>

                <a class='btn btn-primary' style='background-color: #fa899c;
                border: none; color: white;' href='https://www.calendriers-grossesse.com/calcul-mois-de-grossesse/'>
                    Calcul mois de grossesse
                </a>

            </div>
        </div>
    </div>
    <script src='./public/js/script.js'></script>
</body>

</html>