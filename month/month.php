<?php
/*
 * Plugin Name:      month
 * Description:       monthly counter for pregnancy Calendar
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Codeur créatif
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       week
 * Domain Path:       /month
 */

function wpse16119877_init_session()
{
    if (!session_id()) {
        session_start();
    }
}

function getMonthsArray($startDate, $endDate)
{
    $months = [];
    $currentMonth = [];
    $currentDate = new DateTime($startDate);
    while ($currentDate <= new DateTime($endDate)) {
        $currentMonth[] = $currentDate->format('Y-m-d');
        $currentDate->add(new DateInterval('P1D'));
        if (
            $currentDate->format('d') === '01' ||
            $currentDate > new DateTime($endDate)
        ) {
            $months[] = $currentMonth;
            $currentMonth = [];
        }
    }
    return $months;
}

function displayMonth()
{
    $lastPeriodDate = $_SESSION['lastPeriodDate'];
    $conceptionDate = $_SESSION['conceptionDate'];

    $cycle = null;

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
            $_SESSION['lastPeriodDate'] = $lastPeriodDate;
        }
    }

    $duration = calculDuration($conceptionDate);

    $month = convertInMonths($duration);

    $echo0A = addDaysToDate($conceptionDate, 36);
    $echo0B = addDaysToDate($conceptionDate, 63);

    $echo1A = addDaysToDate($conceptionDate, 71);
    $echo1B = addDaysToDate($conceptionDate, 98);

    $echo2A = addDaysToDate($conceptionDate, 134);
    $echo2B = addDaysToDate($conceptionDate, 175);

    $echo3A = addDaysToDate($conceptionDate, 204);
    $echo3B = addDaysToDate($conceptionDate, 243);

    $app4A = addDaysToDate($conceptionDate, 106);
    $app4B = addDaysToDate($conceptionDate, 136);

    $app5A = addDaysToDate($conceptionDate, 137);
    $app5B = addDaysToDate($conceptionDate, 167);

    $app6A = addDaysToDate($conceptionDate, 168);
    $app6B = addDaysToDate($conceptionDate, 198);

    $app7A = addDaysToDate($conceptionDate, 200);
    $app7B = addDaysToDate($conceptionDate, 227);

    $app8A = addDaysToDate($conceptionDate, 228);
    $app8B = addDaysToDate($conceptionDate, 257);

    $app9A = addDaysToDate($conceptionDate, 258);
    $app9B = addDaysToDate($conceptionDate, 287);

    $today = new DateTime();

    $date = strtotime($conceptionDate);

    $endDatee = addDaysToDate($conceptionDate, 275);

    $monthsArray = getMonthsArray($conceptionDate, $endDatee);

    echo "
    <div class='app' id='app'>
    <div class='content'>
    <div class='main'>
    <div class='main__text'>
        <h1 class='title'>
            CALCUL MOIS DE GROSSESSE
        </h1>
        <p class='text text-center'>
            Toutes les dates importantes de votre grossesse
        </p>
    </div>

    <div class='items text-center'>
        <form class='proceed mx-auto' action='#' method='POST'>
            <div class='form'>
            <input type='hidden' value=$conceptionDate
                        id='conceptionDate' style='display: none'>

                        <label for=''>
                        <p>Date des dernières règles: </p>
                        <input class='date mx-auto text-center' name='lastPeriodDate' type='text'
                        onfocus='(this.type = `date`)'  style='width:150px; height: 30px; border-color: black'
                         placeholder='$lastPeriodDate' id='lastPeriodDatee'>
                            </label>

                            <div class='or'>
                                Ou
                            </div>

                            <label for=''>
                            <p>Date de conception: </p>
                            <input class='date mx-auto text-center'
                            name='conceptionDate' type='text'
                            onfocus='(this.type = `date`)'  style='width:150px; height: 30px; border-color: black'
                             placeholder='$conceptionDate' id='conceptionDatee'>
                            </label>

            </div>

            <button class='btn btn-primary ml-0'   style='background-color: #fa899c; border: none;
                        color: white;' type='submit'>
                            Calculer
                        </button>
        </form>
    </div>
</div>

        <div class='item' id='calendar'>
            <h2>
            CALENDRIER DE VOTRE GROSSESSE MOIS PAR MOIS
            </h2>

            <div class='months' v-if='conceptionDate !=``'>
            <div class='container table p-3'>
                <div class='tr row'>";
    foreach ($monthsArray as $index => $month):

        $currentMonthClass = '';
        $firstDayOfCurrentMonth = new DateTime($month[0]);
        $lastDayOfCurrentMonth = new DateTime(end($month));
        if (
            $today >= $firstDayOfCurrentMonth &&
            $today <= $lastDayOfCurrentMonth
        ) {
            $currentMonthClass = ' current-month';
        }
        ?>



<div class='td month col-4 mx-auto<?= $currentMonthClass ?>'>
    <p class='text text-center'><?php
    setlocale(LC_TIME, 'fr_FR.UTF-8');
    echo strftime('%B %Y', $firstDayOfCurrentMonth->getTimestamp());
    ?></p>
</div>
<?php
    endforeach;
    echo "</div>
            </div>
        </div>


            <p class='text'>
                Le calendrier de grossesse d'une femme est un outil utile pour suivre les différentes étapes de la
                grossesse et s'assurer que tout se passe bien pour la mère et le bébé. Il commence généralement à la
                date prévue de la dernière période menstruelle et se poursuit jusqu'à la naissance du bébé, soit
                environ 40 semaines plus tard.
            </p>
        </div>

        <hr>

        <div class='item' id='echography'>
            <h2>
                CALENDRIER DES ECHOGRAPHIES
            </h2>

           ";
    if ($conceptionDate != '') {
        echo "
            <p class='text' >
            Echographie précoce: entre le <span v-if='conceptionDate !=``'> $echo0A</span>
            et le <span v-if='conceptionDate !=``'> $echo0B </span>
            <br>

            1ère échographie recommandée: entre le <span v-if='conceptionDate !=``'> $echo1A </span> et le
            <span v-if='conceptionDate !=``'> $echo1B </span> <br>

            2ème échographie recommandée: entre le <span v-if='conceptionDate !=``'> $echo2A </span>
            et le <span v-if='conceptionDate !=``'> $echo2B </span> <br>

            3ème échographie recommandée:
            entre le <span v-if='conceptionDate !=``'> $echo3A </span> et le
            <span v-if='conceptionDate !=``'> $echo3B </span>
        </p>
           ";
    }
    echo "

            <p class='text'>
                Les échographies sont cruciales pour évaluer la croissance et la santé du fœtus. Elles permettent de
                vérifier la vitalité du fœtus, son âge gestationnel, la position de placenta, la quantité de liquide
                amniotique et les malformations. Les échographies peuvent être recommandées à différents moments de
                la grossesse en fonction des besoins individuels de chaque femme enceinte et de son fœtus. Elles
                sont généralement sans danger pour la mère et le fœtus.
            </p>
        </div>
    <hr>

    <div class='item' id='appointments'>
        <h2>
            CALENDRIER DES CONSULTATIONS PRENATALES
        </h2>";

    if ($conceptionDate != '') {
        echo "
        <p class='text' >
            4ème mois de grossesse: entre le <span v-if='conceptionDate !=``'> $app4A</span> et le
            <span v-if='conceptionDate !=``'> $app4B </span> <br>

            5ème mois de grossesse: entre le <span v-if='conceptionDate !=``'> $app5A </span> et le
            <span v-if='conceptionDate !=``'>$app5B </span> <br>

            6ème mois de grossesse: entre le <span v-if='conceptionDate !=``'> $app6A </span> et le
            <span v-if='conceptionDate !=``'> $app6B </span> <br>

            7ème mois de grossesse: entre le <span v-if='conceptionDate !=``'> $app7A </span> et le
            <span v-if='conceptionDate !=``'> $app7B </span> <br>

            8ème mois de grossesse: entre le <span v-if='conceptionDate !=``'>$app8A </span> et le
            <span v-if='conceptionDate !=``'> $app8B </span> <br>

            9ème mois de grossesse: entre le <span v-if='conceptionDate !=``'> $app9A </span> et le
            <span v-if='conceptionDate !=``'> $app9B </span>
            </p>
            ";
    }
    echo "

        <p class='text'>
            Le calcul des dates pendant la grossesse permet de déterminer la date d'accouchement et de
            suivre le
            développement du bébé. Les consultations prénatales sont essentielles pour surveiller la
            santé de la
            mère et du bébé, détecter d'éventuels problèmes et fournir des informations et un soutien
            émotionnel
            et psychologique.
        </p>
    </div>
    <hr>

        <div class='links mx-auto text-center'>
            <a class='btn btn-primary'  style='background-color: #fa899c;
            border: none; color: white;'
                href='https://www.calendriers-grossesse.com'>
                Calendrier grossesse
            </a>

            <a class='btn btn-primary'   style='background-color: #fa899c;
            border: none; color: white;'
                href='https://www.calendriers-grossesse.com/calcul-semaine-de-grossesse/'>
                Calcul semaine de grossesse
            </a>

            <a class='btn btn-primary' style='background-color: #fa899c;
            border: none; color: white;'
                href='https://www.calendriers-grossesse.com/calcul-date-daccouchement/'>
                Calcul date d'accouchement
            </a>
        </div>
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

add_shortcode('month', 'displayMonth');
// Start session on init hook.
add_action('init', 'wpse16119877_init_session');
//add_action('wp_enqueue_scripts', 'displaySolidaire');