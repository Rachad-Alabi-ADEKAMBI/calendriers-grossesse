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

function wpse1611987_init_session()
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

    echo $abc;
}

function displayWeek()
{
    $abc = wpse1611987_init_session();
    echo "

    <div class='app' id='app'>

    <div class='content'>
    {{ detail }}
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
                        Vous êtes enceinte de: <span> {{  durationInDays  }}</span> <br>
                        Durée d'aménorrhées: <span>{{ convertInWeeks(Anduration) }} </span> <br>
                        bravo, vous avez fait: <span> {{ format((durationInDays *100)/280 ) }} % du
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
    ";

    echo '<script>';
    echo "var dateValue = '" . $abc . "';";
    echo '</script>';

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
// Start session on init hook.
add_action('init', 'wpse1611987_init_session');
//add_action('wp_enqueue_scripts', 'displaySolidaire');