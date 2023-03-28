<?php
/*
 * Plugin Name:      delivery
 * Description:       delivery date for pregnancy Calendar
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Codeur créatif
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       week
 * Domain Path:       /delivery
 */

function wpse16119871_init_session()
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

function displayDelivery()
{
    $conceptionDate = '01/01/2023';

    $duration = calculDuration($conceptionDate);

    $convertedDuration = convertInWeeks($duration);

    $convertedAnDuration = convertInWeeks(calculDuration($conceptionDate) + 14);

    $dueDate = addDaysToDate($conceptionDate, 285);

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
                                <p>Date de conception:</p>
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
                       Date d'accouchement prévue': <span> $dueDate </span> <br>

                   </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class='item' id='calendar'>
                <h2>
                    CALCUL DATE ACCOUCHEMENT
                </h2>


                <p class='text text-justify'>
                La date d'accouchement prévue ou présumée (DPA) est une étape importante pour les femmes enceintes et leurs médecins. Cette date est calculée à partir de la date de conception. En théorie, il suffit d'ajouter neuf mois à la date de début de grossesse pour déterminer la DPA.
                    <br><br>
                Cependant, il est important de noter que chaque femme est différente et que la durée de la grossesse peut varier d'une personne à l'autre. De plus, la date de conception peut être difficile à déterminer avec précision, surtout si une femme a des cycles menstruels irréguliers. C'est pourquoi les médecins utilisent souvent des méthodes plus précises pour estimer la date d'accouchement, telles que l'échographie.
                <br><br>
                La date d'accouchement prévue est importante car elle permet aux femmes enceintes de se préparer mentalement et physiquement pour l'arrivée de leur bébé. Cependant, il est important de noter que la DPA n'est qu'une estimation et que l'accouchement peut se produire à tout moment, que ce soit avant ou après la date prévue.
                <br><br>
                En cas de dépassement de la DPA, les médecins peuvent recommander des mesures pour déclencher l'accouchement, telles que l'administration d'ocytocine ou une césarienne. Cependant, il est important de noter que chaque grossesse est unique et que les décisions concernant l'accouchement doivent être prises au cas par cas, en tenant compte de la santé de la mère et du bébé.
                </p>
            </div>
            <hr>

            <div class='item' id='vacancies'>
                <h2>
                    DATES CONGES MATERNITE
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

add_shortcode('due', 'displayDelivery');
// Start session on init hook.
add_action('init', 'wpse16119871_init_session');
//add_action('wp_enqueue_scripts', 'displaySolidaire');