<?php
/*
 * Plugin Name:      week
 * Description:       weekly counter for pregnancy Calendar
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Codeur créatif
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       week
 * Domain Path:       /week
 */

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

function convertInMonths($numberOfDays)
{
    if ($numberOfDays < 30) {
        return '1er mois';
    } else {
        $numberOfMonths = ceil($numberOfDays / 30);
        return $numberOfMonths . 'ème mois';
    }
}

function displayWeek()
{
    $lastPeriodDate = $_SESSION['lastPeriodDate'];
    $conceptionDate = $_SESSION['conceptionDate'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['lastPeriodDate'] != '') {
            $lastPeriodDate = $_POST['lastPeriodDate'];
            $lastPeriodDate = strtotime($lastPeriodDate);
            $lastPeriodDate = date('d-m-Y', $lastPeriodDate);
            $conceptionDate = addDaysToDate($lastPeriodDate, 14);
            $_SESSION['conceptionDate'] = $conceptionDate;
            $_SESSION['lastPeriodDate'] = $lastPeriodDate;
        }

        if ($_POST['conceptionDate'] != '') {
            $conceptionDate = $_POST['conceptionDate'];
            $conceptionDate = strtotime($conceptionDate);
            $conceptionDate = date('d-m-Y', $conceptionDate);

            $lastPeriodDate = addDaysToDate($conceptionDate, -14);

            $_SESSION['conceptionDate'] = $conceptionDate;
        }
    }

    $duration = calculDuration($conceptionDate);

    $convertedDuration = convertInWeeks($duration);

    $convertedAnDuration = convertInWeeks(calculDuration($conceptionDate) + 14);

    $month = convertInMonths($duration);

    $dueDate = addDaysToDate($conceptionDate, 273);

    $percentage = number_format(($duration * 100) / 284, '0', '', ' ');

    $endDatee = addDaysToDate($conceptionDate, 280);

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
    // $endDate = date('Y-m-d', $endDate);
    $weeksArray = getWeeksArray($conceptionDate, $endDatee);

    echo "
    <div class='app' id='app'>


    <div class='content'>

        <div class='main'>
            <div class='main__text'>
                <h1 class='title'>
                    CALCUL SEMAINE ET MOIS DE GROSSESSE
                </h1>
                <p class='text text-center'>
                    Toutes les dates importantes de votre grossesse
                </p>
            </div>

            <div class='items'>

            <form class='proceed' action='#' method='POST'>
            <div class='form'>

            <input type='hidden' value=$conceptionDate
            id='conceptionDate' style='display: none'>

            <label for=''>
            <p>Date des dernières règles: </p>
            <input class='date mx-auto text-center' name='lastPeriodDate' type='text'
            onfocus='(this.type = `date`)'  style='width:150px; height: 30px; border-color: black'
             placeholder='$lastPeriodDate'>
                </label>

                <div class='or'>
                    Ou
                </div>

                <label for=''>
                <p>Date de conception: </p>
                <input class='date mx-auto text-center'
                name='conceptionDate' type='text'
                onfocus='(this.type = `date`)'  style='width:150px; height: 30px; border-color: black'
                 placeholder='$conceptionDate'>
                </label>


                </div>

            <button class='btn btn-primary ml-0' style='background-color: #fa899c; border: none;
                                    color: white;' type='submit'>
            Calculer
         </button>
        </form>
                <div class='results'>
                    <div class='results__top'>
                    <h2 class='subtitle'>
                    MON CALENDRIER DE GROSSESSE
                </h2>
                <p class='text'>
                    Vous êtes enceinte de: <span v-if='conceptionDate !=``'> $convertedDuration </span> <br>

                    Durée d'aménorrhées (absence de règles): <span  v-if='conceptionDate !=``'> $convertedAnDuration </span> <br>
                    <br>

                </p>

                    </div>
                </div>
            </div>
        </div>

        <div class='item' id='calendar'>
            <h2>
            CALCUL SEMAINE DE GROSSESSE
            </h2>


            <div class='weeks' v-if='conceptionDate != ``'>s
            <div class='container table'>
                <div class='tr row'>";
    foreach ($weeksArray as $index => $week):

        $currentWeekClass = '';
        $firstDayOfCurrentWeek = new DateTime($week[0]);
        $lastDayOfCurrentWeek = new DateTime(end($week));
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
    endforeach;
    echo "</div>
            </div>
        </div>
            <p class='text mt-4'>
            La durée de la grossesse est un sujet important pour les femmes enceintes et leurs médecins. Il est important de comprendre les différentes méthodes de calcul pour déterminer le nombre de semaines de grossesse et d'aménorrhée.
            <br><br>
            La grossesse dure en moyenne 39 semaines de grossesse et 41 semaines d'aménorrhées. Pour calculer le nombre de semaines de grossesse, il faut prendre la date de conception comme point de départ. En revanche, pour calculer le nombre de semaines d'aménorrhée, il faut prendre le premier jour des dernières règles.
            <br><br>
            Il existe une différence d'environ deux semaines entre les semaines de grossesse et les semaines d'aménorrhée. Les semaines de grossesse prennent pour référence la date de fécondation, tandis que les semaines d'aménorrhée prennent pour référence le premier jour des dernières règles. Les professionnels de santé préfèrent utiliser les semaines d'aménorrhée car la date des dernières règles est plus précise. Il est donc important de comprendre cette différence de 15 jours entre ces deux méthodes de calcul.
            <br><br>
            Enfin, le terme 'aménorrhée' signifie simplement 'absence de règle, selon le dictionnaire Larousse. Il est utilisé pour calculer la durée de la grossesse en prenant en compte le début de l'absence de règles comme point de départ.
            </p>
        </div>
        <hr>

    </div>

    <div class='item' id='calendar'>
        <h2>
        CALCUL MOIS DE GROSSESSE
        </h2>

        <div class='bottom'>

        <p class='text text-justify'> <br>
        Vous êtes dans le: <span >";
    if ($conceptionDate != '') {
        echo $month;
    }
    echo "</span> de grossesse </span>
    </p>
</div>

       <p>
       Le calcul de votre mois de grossesse est une étape importante pour suivre la croissance et le développement de votre
        bébé. Le premier jour de votre dernière période menstruelle est utilisé pour déterminer la date de début de votre
        grossesse. Chaque mois de grossesse est généralement considéré comme équivalent
        à quatre semaines, soit 28 jours. Cependant, il est important de noter que chaque
         grossesse est unique, et que la durée de gestation peut varier de quelques jours à plusieurs semaines.
         <br><br>
       Le développement de votre bébé est divisé en trois trimestres, chacun d'une durée d'environ 13 semaines. Au cours du premier trimestre, votre bébé passera d'un simple amas de cellules à un petit être humain formé. Les organes vitaux se développeront, y compris le cerveau, le cœur, le foie et les reins. Les bras et les jambes se développeront également, ainsi que les doigts et les orteils.
       <br><br>
       Au cours du deuxième trimestre, votre bébé continuera à se développer rapidement. Les cheveux, les ongles et les dents commenceront à se former. Votre bébé commencera également à bouger et vous pourrez peut-être sentir les premiers mouvements. À la fin du deuxième trimestre, votre bébé sera assez grand pour que vous puissiez voir les contours de son corps lors d'une échographie.
       <br><br>
       Le troisième trimestre est le dernier trimestre de votre grossesse, et votre bébé sera pratiquement prêt à naître. Il continuera à prendre du poids et à se préparer à la naissance. Vous pourrez peut-être ressentir des contractions de Braxton Hicks, qui sont des contractions d'entraînement pour votre corps en préparation de l'accouchement.
       <br><br>
       En fin de compte, il est important de se rappeler que chaque grossesse est unique. Le suivi régulier de votre grossesse auprès de votre médecin ou sage-femme est essentiel pour garantir la santé de votre bébé et de vous-même. Ils pourront vous donner des informations plus précises sur le développement de votre bébé et sur le moment de votre accouchement prévu.
       </p>
    </div>


</div>
    ";
    wp_enqueue_script(
        'vue',
        esc_url('https://unpkg.com/vue@3/dist/vue.global.js'),
        [],
        null,
        true
    );
    wp_enqueue_script(
        'app',
        esc_url(plugin_dir_url(__FILE__) . 'public/js/app.js'),
        ['vue'],
        null,
        true
    );
    wp_enqueue_style(
        'bootstrap',
        esc_url(
            'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css'
        ),
        [],
        null
    );
    wp_enqueue_style(
        'app',
        esc_url(plugin_dir_url(__FILE__) . 'public/css/style.css'),
        ['bootstrap'],
        null
    );
    wp_enqueue_script(
        'jquery',
        'https://code.jquery.com/jquery-3.3.1.slim.min.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'popper',
        'https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js',
        ['jquery'],
        null,
        true
    );
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js',
        ['jquery', 'popper'],
        null,
        true
    );
}

add_shortcode('week', 'displayWeek');
//add_action('init', 'wpse16119872_init_session');
//add_action('wp_enqueue_scripts', 'displaySolidaire');