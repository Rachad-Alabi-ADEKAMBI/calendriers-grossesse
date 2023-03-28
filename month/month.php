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

function wpse16119872_init_session()
{
    if (!session_id()) {
        session_start();
    }

    if (isset($_POST['lastPeriodDate'])) {
        $_SESSION['arrayImg'] = $_POST['lastPeriodDate'];
    }

    if (array_key_exists('arrayImg', $_SESSION)) {
        $abc = $_SESSION['arrayImg'];
    } else {
        $abc = 'NOT IN SESSION DATA';
    }
}

function displayMonth()
{
    $conceptionDate = '01/01/2023';

    $duration = calculDuration($conceptionDate);

    $convertedDuration = convertInWeeks($duration);

    $convertedAnDuration = convertInWeeks(calculDuration($conceptionDate) + 14);

    $month = convertInMonths($duration);

    $percentage = number_format(($duration * 100) / 285, '0', '', ' ');

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

    $prematureDate = addDaysToDate($conceptionDate, 253);
    $anesth = addDaysToDate($conceptionDate, 257);
    $vagA = addDaysToDate($conceptionDate, 239);
    $vagB = addDaysToDate($conceptionDate, 266);
    echo "
    <div class='app' id='app'>
    <div class='content'>
    <div class='main'>
    <div class='main__text'>
        <h1 class='title'>
            CALENDRIERS-GROSSESSE
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
                  Aujourd'hui, vous êtes dans votre <span>$month de grossesse</span> <br>
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
                CALCUL MOIS DE GROSSESSE
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
                    Mois de grossesse: {{ currentWeek +1}}
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

        <div class='item' id='echography'>
            <h2>
                CALENDRIER DES ECHOGRAPHIES
            </h2>

            <p class='text text-justify'>
                Echographie précoce: entre le <span> $echo0A</span>
                et le <span> $echo0B </span>
                <br>

                1ère échographie recommandée: entre le <span> $echo1A </span> et le
                <span> $echo1B </span> <br>

                2ème échographie recommandée: entre le <span> $echo2A </span>
                et le <span> $echo2B </span> <br>

                3ème échographie recommandée:
                entre le <span> $echo3A </span> et le
                <span> $echo3B </span>
            </p>

            <p class='text text-justify'>
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
        </h2>

        <p class='text text-justify'>
            4ème mois de grossesse: entre le <span> $app4A</span> et le
            <span> $app4B </span> <br>

            5ème mois de grossesse: entre le <span> $app5A </span> et le
            <span>$app5B </span> <br>

            6ème mois de grossesse: entre le <span> $app6A </span> et le
            <span> $app6B </span> <br>

            7ème mois de grossesse: entre le <span> $app7A </span> et le
            <span> $app7B </span> <br>

            8ème mois de grossesse: entre le <span>$app8A </span> et le
            <span> $app8B </span> <br>

            9ème mois de grossesse: entre le <span> $app9A </span> et le
            <span> $app9B </span>
        </p>

        <p class='text text-justify'>
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
            <a class='btn btn-primary' style='color: #393F82; border: #393F82; background-color: bisque;'
                href='https://www.calendriers-grossesse.com'>
                Calendrier grossesse
            </a>

            <a class='btn btn-primary' style='color: #393F82; border: #393F82; background-color: bisque;'
                href='https://www.calendriers-grossesse.com/calcul-semaine-grossesse/'>
                Calcul semaine grossesse
            </a>

            <a class='btn btn-primary' style='color: #393F82; border: #393F82;  background-color: bisque;'
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
add_action('init', 'wpse16119872_init_session');
//add_action('wp_enqueue_scripts', 'displaySolidaire');