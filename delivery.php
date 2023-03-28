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
                        Calendrier de grossesse
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
                                <input type='date' class='date' v-model='lastPeriodDate' name='lastPeriodDate'>
                            </label>

                            <div class='or'>
                                Ou
                            </div>

                            <label for=''>
                                <p>Date de conception</p>
                                <input type='date' class='date' v-model='conceptionDate' name='conceptionDate'>
                            </label>

                        </div>

                        <button @click='proceed()' type='submit' class='btn btn-primary' style='background: #f0c7c2;
                                    border: none; color: #393F82;'>
                            Calculer
                        </button>
                    </form>

                    <div class='results'>
                        <h2 class='subtitle'>
                            Date d'accouchement: <span><a href='#calendar'><i class='fas fa-question'></i></a></span>
                        </h2>
                        <p class='text text-justify'>
                            Date d'accouchement prévue: <span> <?= addDaysToDate(
                                $conceptionDate,
                                285
                            ) ?></span> <br>

                        </p>
                    </div>
                </div>
            </div>

            <div class='item' id='calendar'>
                <h2>
                    CALCUL DATE ACCOUCHEMENT
                </h2>


                <p class='text text-justify'>
                    Le calendrier de grossesse d'une femme est un outil utile pour suivre les différentes étapes de la
                    grossesse et s'assurer que tout se passe bien pour la mère et le bébé. Il commence généralement à la
                    date prévue de la dernière période menstruelle et se poursuit jusqu'à la naissance du bébé, soit
                    environ 40 semaines plus tard.
                </p>
            </div>
            <hr>

            <div class='item' id='vacancies'>
                <h2>
                    Dates congé maternité
                </h2>

                <p class='text text-justify' v-if='results != null'>
                    <label for=''>
                        Nombre d'enfant(s) déjà né(s) : <select name='' id='' v-model='kids' style='height: 28px'>
                            <option value='0'>0</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>
                    </label> <br>

                    <label for=''>
                        Vous êtes enceinte de <select name='' id='' v-model='kidsComing' style='height: 28px'>
                            <option value='jumeaux'>Jumeaux</option>
                            <option value='triples'>Triplés ou plus</option>
                        </select>
                    </label>

                    <button class='btn btn-primary' @click='proceedVac()'
                        style='color: #f0c7c2; margin-left: 10px; background-color: #393F82'>
                        Calculer
                    </button>
                </p>
                <br>

                <p class='text text-justify' v-if='resultsVac != null'>
                    <strong> Date limite pour déclarer votre grossesse:</strong> <span>{{ dateOfAnnounement}}</span>
                    <br>

                    <strong>Date de début de votre congé maternité: </strong> <span>{{ formatDate(dateVacA)}}</span>
                    <br>
                    <strong>Date de fin de votre congé maternité:</strong> <span>{{ formatDate(dateVacB)}}</span> <br>
                    <strong>Vous serez pris en charge à 100% par l'assurance maladie à partir du:</strong>
                    <span>{{ formatDate(dateCare) }}</span> <br>
                </p>


                <p class='text text-justify'>Pour bénéficier de tous vos droits, vous devez envoyer votre déclaration de
                    grossesse
                    dans les 14 premières semaines ou avant la fin du 3e mois.
                    Le congé maternité est un temps de repos accordé à la mère après l'accouchement pour récupérer et
                    prendre soin de son nouveau-né. Le calcul de la durée du congé maternité dépend en général, la durée
                    du
                    congé maternité est calculée à partir de la date prévue d'accouchement. Il offre également un temps
                    précieux pour créer des liens avec le nouveau-né, allaiter et prendre soin de lui. Le congé
                    maternité peut également aider à réduire le risque de complications de santé et à favoriser la
                    récupération et le bien-être de la mère et du bébé.
                </p>
            </div>
            <hr>

            <div class='links mx-auto text-center'>
                <a class='btn btn-primary' style='color: #393F82; border: #393F82;  background-color: bisque;'
                    href='https://www.calendriers-grossesse.com/'>
                    Calendrier grossesse
                </a>

                <a class='btn btn-primary' style='color: #393F82; border: #393F82; background-color: bisque;'
                    href='https://www.calendriers-grossesse.com/calcul-semaine-grossesse/'>
                    Calcul semaine grossesse
                </a>

                <a class='btn btn-primary' style='color: #393F82; border: #393F82; background-color: bisque;'
                    href='https://www.calendriers-grossesse.com/calcul-mois-grossesse/'>
                    Calcul mois grossesse
                </a>

            </div>
        </div>
    </div>
    <script src='./public/js/script.js'></script>
</body>

</html>