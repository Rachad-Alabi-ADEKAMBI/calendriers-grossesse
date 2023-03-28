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
}

function displayWeek()
{
    $abc = wpse1611987_init_session();
    // $conceptionDate = date('d/m/Y', strtotime());
    $conceptionDate = '01/01/2023';

    $duration = calculDuration($conceptionDate);

    $convertedDuration = convertInWeeks($duration);

    $convertedAnDuration = convertInWeeks(calculDuration($conceptionDate) + 14);

    $month = convertInMonths($duration);

    $percentage = number_format(($duration * 100) / 285, '0', '', ' ');

    echo "
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