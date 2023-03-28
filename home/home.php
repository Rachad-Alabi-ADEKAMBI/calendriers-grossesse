<?php
/*
 * Plugin Name:      home
 * Description:        counter for pregnancy Calendar
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Codeur créatif
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       home
 * Domain Path:       /home
 */

/*
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
*/
function wpse16119879_init_session()
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

function displayHome()
{
    $abc = wpse16119879_init_session();
    // $conceptionDate = date('d/m/Y', strtotime());
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
            CALENDRIERS GROSSESSE
        </h1>
        <p class='text text-center'>
            Toutes les dates importantes de votre grossesse
        </p>
    </div>

    <p class='text text-center' v-if='errorMsg'>
        {{ errorMsg }}
    </p>



    <div class='items'>
        <form class='proceed' action='#' method='POST'>
            <div class='form'>
                <label for=''>
                    <p>Date des dernières règles: </p>
                    <input type='date' class='date' name='lastPeriodDate'>
                </label>

                <div class='or'>
                    Ou
                </div>

                <label for=''>
                    <p>Date de conception: </p>
                    <input type='date' class='date' name='conceptionDate'>
                </label>

            </div>

            <button class='btn btn-primary ml-0' style='background: #f0c7c2;
                        border: none; height: 40px; color: black;' tyoe='submit'>
                Calculer
            </button>
        </form>

        <div class='results'>
            <div class='results__top' v-if='showResults'>
                <h2 class='subtitle'>
                    Mon calendrier de grossesse <span><a href='#calendar'><i class='fas fa-question'
                                style='color: #fa899c'></i></a></span>
                </h2>
                <p class='text text-justify'>
                    Vous êtes enceinte de: <span>$convertedDuration</span> <br>
    Durée d'aménorrhées: <span> $convertedAnDuration</span> <br>
    Vous êtes dans le : <span> $month </span> <br>
    Bravo, êtes à : <span> $percentage % de votre grossesse</span>
    <br>

    </p>
    </div>

    <div class='results__top' v-if='showEchography'>
            <h2 class='subtitle'>
            DATES D'ECHOGRAPHIE <span><a href='#echography'><i class='fas fa-question'
                            style='color: #fa899c'></i></a></span>
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
    </div>


         <div class='results__top' v-if='showAppointments'>
                <h2 class='subtitle'>
                   DATE DES CONSULTATIONS PRENATALES <span><a href='#appointments'><i class='fas fa-question' style='color: #fa899c'></i></a></span>
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
            </div>

            <div class='results__top' v-if='showVacancies'>
                <h2 class='subtitle'>
                    Congés <span><a href='#vacancies'><i class='fas fa-question' style='color: #fa899c'></i></a></span>
                </h2>
                <form action='#' method='POST'>
                    <p class='text text-justify'>
                        <label for=''>
                            Nombre d'enfant(s) déjà né(s) : <select name='' id='' v-model='kids'>
                                <option value='0'>0</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                            </select>
                        </label> <br>

                        <label for=''>
                            Vous êtes enceinte de <select name='' id='' v-model='kidsComing'>
                                <option value='jumeaux'>Jumeaux</option>
                                <option value='triples'>Triplés ou plus</option>
                            </select>
                        </label>

                        <button class='btn btn-primary ' @click='proceedVac()'
                            style='background-color: rgb(250, 137, 156); color: white; margin-left: 10px'>
                            Calculer
                        </button>
                    </p>
                </form>

                <p class='text text-justify' v-if='resultsVac != null'>
                    Début de votre congé maternité : <span>{{ dateVacA}}</span> <br>
                    Fin de votre congé maternité : <span>{{ dateVacB}}</span> <br>
                    Date de pris en charge l'assurance maladie:
                    <span>{{ dateCare }}</span> <br>
                </p>



                </p>
            </div>


            <div class='results__top' v-if='showMore'>
                <h2 class='subtitle'>
                    Plus <span><a href='#more'><i class='fas fa-question' style='color: #fa899c'></i></a></span>
                </h2>
                <p class='text text-justify'>
                    A partir du <span>$prematureDate </span> votre bébé n'est plus prématuré. <br>
                    La consultation avec l'anesthésiste est à effectuer à partir du <span> $anesth </span>
            <br>
            Le prélèvement vaginal est à éffectuer entre le <span>$vagA</span> et le
            <span> $vagB </span>
            </p>
        </div>



    <div v-if='showButtons' class='buttons'>
        <label>
            <input type='radio' name='menu-option' value='results' @click='displayResults()'>
            Calendrier
        </label>

        <label>
            <input type='radio' name='menu-option' value='echographie' @click='displayEchography()'>
            Echographie
        </label>

        <label>
            <input type='radio' name='menu-option' value='consultations' @click='displayAppointments()'>
            Consultations
        </label>

        <label>
            <input type='radio' name='menu-option' value='conges-maternite' @click='displayVacancies()'>
            Congés maternité
        </label>

        <label>
            <input type='radio' name='menu-option' value='plus' @click='displayMore()'>
            Plus
        </label>
    </div>
</div> <br>

    <hr>


    <div class='item mt-5' id='calendar'>
    <h2>
        CALENDRIER SEMAINE PAR SEMAINE
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
                    <div v-for='(week, index) in calendar' :key='index'
                        class='week col-sm-12 col-md-2' :class='{ box: index === currentWeek }'>
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
        Le calendrier de grossesse d'une femme est un outil utile pour suivre les différentes étapes
        de la
        grossesse et s'assurer que tout se passe bien pour la mère et le bébé. Il commence
        généralement à la
        date prévue de la dernière période menstruelle et se poursuit jusqu'à la naissance du bébé,
        soit
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

<div class='item' id='vacancies'>
    <h2>
        DATES CONGE MATERNITE
    </h2>

    <p class='text text-justify' v-if='results != null'>
        <label for=''>
            Nombre d'enfant(s) déjà né(s) : <select name='' id='' v-model='kids'
                style='height: 28px'>
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
        <strong> Date limite pour déclarer votre grossesse:</strong>
        <span>{{ dateOfAnnounement}}</span>
        <br>

        <strong>Date de début de votre congé maternité: </strong>
        <span>{{ formatDate(dateVacA)}}</span>
        <br>
        <strong>Date de fin de votre congé maternité:</strong>
        <span>{{ formatDate(dateVacB)}}</span> <br>
        <strong>Vous serez pris en charge à 100% par l'assurance maladie à partir du:</strong>
        <span>{{ formatDate(dateCare) }}</span> <br>
    </p>


    <p class='text text-justify'>Pour bénéficier de tous vos droits, vous devez envoyer votre
        déclaration de
        grossesse
        dans les 14 premières semaines ou avant la fin du 3e mois.
        Le congé maternité est un temps de repos accordé à la mère après l'accouchement pour
        récupérer et
        prendre soin de son nouveau-né. Le calcul de la durée du congé maternité dépend en général,
        la durée
        du
        congé maternité est calculée à partir de la date prévue d'accouchement. Il offre également
        un temps
        précieux pour créer des liens avec le nouveau-né, allaiter et prendre soin de lui. Le congé
        maternité peut également aider à réduire le risque de complications de santé et à favoriser
        la
        récupération et le bien-être de la mère et du bébé.
    </p>
</div>
<hr>

<div class='item' id='ovulation'>
    <h2>
        CALCUL DATE D'OVULATION
    </h2>

    <p class='text text-justify' v-if='results != null'>
        <label for=''>
            Cycle : <select name='' id='' v-model='cycle' style='height: 28px'>
                <option value='24'>24</option>
                <option value='28'>28</option>
                <option value='36'>36</option>
            </select>
        </label> <br>


        <button class='btn btn-primary ml-5' @click='proceedFert()' style='color: #f0c7c2; margin-left: 10px;
    background-color: #393F82'>
            Calculer
        </button>
    </p>


    <p class='text text-justify' v-if='resultsFert != null'>
        <strong>Période d'ovulation:</strong> entre le <span> {{  formatDate(fecondDateA)  }}
        </span>
        et le
        <span>{{  formatDate(fecondDateB) }}</span> <br>
    </p>


    <p class='text text-justify'>
        Pour déterminer votre cycle d’ovulation, il suffit en définitive de connaître votre cycle
        menstruel.
        Celui-ci commence le premier jour de vos règles et s’achève le premier jour des règles
        suivantes. En
        moyenne, le cycle menstruel est de 28 jours, mais certaines femmes ont des cycles plus
        courts,
        jusqu’à 22 jours, tandis que d’autres ont des cycles beaucoup plus longs, pouvant durer
        jusqu’à 35,
        voire 40 jours. <br>

        Il existe plusieurs méthodes pour déterminer la date d'ovulation, notamment en surveillant
        la
        température corporelle basale, en utilisant des tests d'ovulation ou en surveillant les
        changements
        dans la glaire cervicale. Il est important de comprendre les signes de l'ovulation pour
        planifier
        une grossesse ou pour éviter une grossesse non désirée. Cependant, il est important de noter
        que ces
        méthodes ne sont pas toujours précises et ne garantissent pas une conception réussie.
    </p>
</div>
<hr>

<div class='item' id='more'>
    <h2>
       AUTRES INFORMATIONS IMPORTANTES
    </h2>


    <p class='text text-justify'>
    A partir du <span>$prematureDate </span> votre bébé n'est plus prématuré. <br>
    La consultation avec l'anesthésiste est à effectuer à partir du <span> $anesth </span>
<br>
Le prélèvement vaginal est à éffectuer entre le <span>$vagA</span> et le
<span> $vagB </span>
</p>

    <p class='text text-justify'>
    <ul>
        <li>
            <strong>Le test de trisomie21</strong> est réalisé en début de grossesse entre la 11ème
            et la
            14ème semaine
            d'aménorrhée Il
            comprend une prise de sang et une échographie afin d'évaluer le risque de trisomie 21
            mais aussi
            de
            trisomie 18 et un éventuel défaut de fermeture du tube neural.
        </li>

        <li>
            C'est au cours du 8e mois que votre <strong>rendez-vous avec l'anesthésiste</strong> est
            préconisé. En cas de
            grossesse difficile ou de naissance multiple, le rendez-vous est avancé au 6e ou 7e
            mois.
            Parfois, vous pouvez y aller au tout début du 9e mois.
        </li>

        <li>
            En général, votre professionnel de la santé procédera à un <strong>examen
                vaginal</strong>
            seulement au cours des visites près de votre date prévue d'accouchement.
        </li>
    </ul>

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
        'font',
        esc_url('https://kit.fontawesome.com/b14771b76e.js'),
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

add_shortcode('pregnancyCalendar', 'displayHome');
// Start session on init hook.
add_action('init', 'wpse16119879_init_session');
//add_action('wp_enqueue_scripts', 'displaySolidaire');