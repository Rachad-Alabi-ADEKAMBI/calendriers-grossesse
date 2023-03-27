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
?>

<!DOCTYPE html>
<html lang='en'>

<head>

    <title>Calendrier de grossesse - Semaine</title>

</head>
<?php include 'menu.php'; ?>

<body>
    <div class='app' id=''>
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
                            Mon calendrier de grossesse <span><a href='#calendar'><i
                                        class='fas fa-question'></i></a></span>
                        </h2>
                        <p class='text text-justify'>
                            Vous êtes enceinte de: <?= calculDuration(
                                $conceptionDate
                            ) ?></span> <br>
                            Durée d'aménorrhées: <span> </span> <br>
                            bravo, vous avez fait: <span> <?= (100 * 100) /
                                280 ?> % du
                                chemin</span>
                            <br>

                        </p>
                    </div>
                </div>
            </div>

            <div class='item' id='calendar'>
                <h2>
                    Calendrier semaine par semaine
                </h2>

                <button class='btn btn-primary' @click='proceedCalendar()' v-if='showButton' style='background-color: #393F82;
                color: #f0c7c2'>
                    Afficher le calendrier
                </button>

                <div class='calendar mb-3' v-if='showCalendar'>
                    <div class='close mr-2 mt-1' @click='closeCalendar()'>
                        X
                    </div>
                    <p class='text text-center mt-2'>
                        Semaine de grossesse: {{ currentWeek +1}}
                    </p>
                    <div class='weeks'>
                        <div class='container'>
                            <div class='row'>
                                <div v-for='(week, index) in calendar' :key='index' class='week col-sm-12 col-md-2'
                                    :class='{ box: index === currentWeek }'>
                                    <h4>Semaine {{ index + 1 }}</h4>
                                    <ul>
                                        <li v-for='(day, dayIndex) in week' :key='dayIndex'>
                                            {{ day }}
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <p class='text text-justify'>
                    Le calendrier de grossesse d'une femme est un outil utile pour suivre les différentes étapes de la
                    grossesse et s'assurer que tout se passe bien pour la mère et le bébé. Il commence généralement à la
                    date prévue de la dernière période menstruelle et se poursuit jusqu'à la naissance du bébé, soit
                    environ 40 semaines plus tard.
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
    <script src="./public/js/app.js"></script>
</body>

</html>