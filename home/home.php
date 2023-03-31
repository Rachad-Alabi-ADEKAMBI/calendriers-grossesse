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

function wpse1611987_init_session()
{
    if (!session_id()) {
        session_start();
        echo 'no session';
    } else {
        echo 'session';
    }
}

function displayHome()
{
    if (array_key_exists('conceptionDate', $_SESSION)) {
        $abc = $_SESSION['conceptionDate'];
        $conceptionDate = $_SESSION['conceptionDate'];
        $lastPeriodDate = $_SESSION['lastPeriodDate'];
    } else {
        $abc = 'NOT IN SESSION DATA';
        $conceptionDate = 'JJ-MM-AAAA';
        $lastPeriodDate = 'JJ-MM-AAAA';
    }
    echo $lastPeriodDate;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['lastPeriodDate'] != 'JJ-MM-AAAA') {
            $lastPeriodDate = $_POST['lastPeriodDate'];
            $lastPeriodDate = strtotime($lastPeriodDate);
            $lastPeriodDate = date('d-m-Y', $lastPeriodDate);
            $conceptionDate = addDaysToDate($lastPeriodDate, 14);
            $_SESSION['conceptionDate'] = $conceptionDate;
            $_SESSION['lastPeriodDate'] = $lastPeriodDate;
        }

        if ($_POST['conceptionDate'] != 'JJ-MM-AAAA') {
            $conceptionDate = $_POST['conceptionDate'];
            $conceptionDate = strtotime($conceptionDate);
            $conceptionDate = date('d-m-Y', $conceptionDate);

            $lastPeriodDate = addDaysToDate($conceptionDate, -14);

            $_SESSION['conceptionDate'] = $conceptionDate;
        } else {
            $conceptionDate = $_SESSION['conceptionDate'];
            $lastPeriodDate = $_SESSION['lastPeriodDate'];
        }
    }

    $duration = calculDuration($conceptionDate);

    $convertedDuration = convertInWeeks($duration);

    $convertedAnDuration = convertInWeeks(calculDuration($conceptionDate) + 14);

    $month = convertInMonths($duration);

    $echo0A = addDaysToDate($conceptionDate, 36 - 14);
    $echo0B = addDaysToDate($conceptionDate, 63 - 14);

    $echo1A = addDaysToDate($conceptionDate, 71 - 14);
    $echo1B = addDaysToDate($conceptionDate, 98 - 14);

    $echo2A = addDaysToDate($conceptionDate, 134 - 14);
    $echo2B = addDaysToDate($conceptionDate, 175 - 14);

    $echo3A = addDaysToDate($conceptionDate, 204 - 14);
    $echo3B = addDaysToDate($conceptionDate, 243 - 14);

    $app4A = addDaysToDate($conceptionDate, 106 - 14);
    $app4B = addDaysToDate($conceptionDate, 136 - 14);

    $app5A = addDaysToDate($conceptionDate, 137 - 14);
    $app5B = addDaysToDate($conceptionDate, 167 - 14);

    $app6A = addDaysToDate($conceptionDate, 168 - 14);
    $app6B = addDaysToDate($conceptionDate, 198 - 14);

    $app7A = addDaysToDate($conceptionDate, 200 - 14);
    $app7B = addDaysToDate($conceptionDate, 227 - 14);

    $app8A = addDaysToDate($conceptionDate, 228 - 14);
    $app8B = addDaysToDate($conceptionDate, 257 - 14);

    $app9A = addDaysToDate($conceptionDate, 258 - 14);
    $app9B = addDaysToDate($conceptionDate, 287 - 14);

    $prematureDate = addDaysToDate($conceptionDate, 253 - 14);
    $anesth = addDaysToDate($conceptionDate, 257 - 14);
    $vagA = addDaysToDate($conceptionDate, 239 - 14);
    $vagB = addDaysToDate($conceptionDate, 266 - 14);

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


                <div class='items'>
                    <form class='proceed' action='#' method='POST'>
                        <div class='form'>

                        <input type='hidden' value=$conceptionDate
                        id='conceptionDate' >

                        <label for=''>
                        <p>Date des dernières règles: </p>
                        <input class='date mx-auto text-center' name='lastPeriodDate' type=`text` placeholder=$lastPeriodDate
                            onfocus='(this.type=`date`)' onblur=`(this.type='text')` style='width:150px;'>
                            </label>

                            <div class='or'>
                                Ou
                            </div>


                            <label for=''>
                            <p>Date des dernières règles: </p>
                            <input class='date mx-auto text-center' name='conceptionDate' type=`text` placeholder=$conceptionDate
                            onfocus='(this.type=`date`)' onblur=`(this.type='text')` style='width:150px; '>
                            </label>


                            </div>

                        <button class='btn btn-primary ml-0' style='background-color: #fa899c; border: none;
                                                color: white;' type='submit'>
                        Calculer
                     </button>
                    </form>

                    <div class='results'>
                        <div class='results__top' id='results'>
                            <h2 class='subtitle'>
                                MON CALENDRIER DE GROSSESSE
                            </h2>
                            <p class='text'>
                                Vous êtes enceinte de: <span v-if='conceptionDate != `JJ-MM-AAAA`'>$convertedDuration</span> <br>
                                Durée d'aménorrhées (absence de règles): <span v-if='conceptionDate != `JJ-MM-AAAA`'> $convertedAnDuration</span>

                                <br>
                                Vous êtes dans le : <span v-if='conceptionDate != `JJ-MM-AAAA`'> $month </span> <br>
                                Date de conception: <span v-if='conceptionDate != `JJ-MM-AAAA`'>$conceptionDate</span><br>
                                <br>

                            </p>
                        </div>

                        <div class='results__top' id='echo'>
                            <h2 class='subtitle'>
                                DATES D'ECHOGRAPHIE </h2>

                            <p class='text'>
                                Echographie précoce: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo0A</span>
                                et le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo0B </span>
                                <br>

                                1ère échographie recommandée: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo1A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo1B </span> <br>

                                2ème échographie recommandée: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo2A </span>
                                et le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo2B </span> <br>

                                3ème échographie recommandée:
                                entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo3A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo3B </span>
                            </p>
                        </div>

                        <div class='results__top' id='appointments'>
                            <h2 class='subtitle'>
                                DATE DES CONSULTATIONS PRENATALES
                            </h2>

                            <p class='text'>
                                4ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app4A</span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app4B </span> <br>

                                5ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app5A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'>$app5B </span> <br>

                                6ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app6A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app6B </span> <br>

                                7ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app7A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app7B </span> <br>

                                8ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'>$app8A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app8B </span> <br>

                                9ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app9A </span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app9B </span>
                            </p>
                        </div>

                        <div class='results__top' id='more'>
                            <h2 class='subtitle'>
                                PLUS
                            </h2>
                            <p class='text'>
                                A partir du <span v-if='conceptionDate != `JJ-MM-AAAA`'>$prematureDate </span>
                                votre bébé n'est plus prématuré. <br>
                                La consultation avec l'anesthésiste est à effectuer à partir du <span v-if='conceptionDate != `JJ-MM-AAAA`'> $anesth
                                </span>
                                <br>
                                Le prélèvement vaginal est à éffectuer entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'>$vagA</span> et le
                                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $vagB </span>
                            </p>
                        </div>

                        <div v-if='showButtons' class='buttons'>
                            <label>
                                <input type='radio' name='menu-option' value='results' onclick='displayResults()'>
                                Calendrier
                            </label>

                            <label>
                                <input type='radio' name='menu-option' value='echographie' onclick='displayEcho()'>
                                Echographie
                            </label>

                            <label>
                                <input type='radio' name='menu-option' value='consultations' onclick='displayAppointments()'>
                                Consultations
                            </label>

                            <label>
                                <input type='radio' name='menu-option' value='plus' onclick='displayMore()'>
                                Plus
                            </label>
                        </div>

                    </div>
                </div>
                <hr>


        <div class='item mt-5' id='calendar'>
            <h2>
                CALENDRIER SEMAINE PAR SEMAINE
            </h2>

            <p class='text'>
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

        <div class='item'>
            <h2>
                CALENDRIER DES ECHOGRAPHIES
            </h2>

            <p class='text'>
                Echographie précoce: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo0A</span>
                et le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo0B </span>
                <br>

                1ère échographie recommandée: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo1A </span> et le
                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo1B </span> <br>

                2ème échographie recommandée: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo2A </span>
                et le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo2B </span> <br>

                3ème échographie recommandée:
                entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo3A </span> et le
                <span v-if='conceptionDate != `JJ-MM-AAAA`'> $echo3B </span>
            </p>

            <p class='text'>
                Les échographies sont cruciales pour évaluer la croissance et la santé du fœtus. Elles permettent de
                vérifier la vitalité du fœtus, son âge gestationnel, la position de placenta, la quantité de liquide
                amniotique et les malformations. Les échographies peuvent être recommandées à différents moments de
                la grossesse en fonction des besoins individuels de chaque femme enceinte et de son fœtus. Elles
                sont généralement sans danger pour la mère et le fœtus.
            </p>
        </div>
        <hr>

        <div class='item'>
        <h2>
            CALENDRIER DES CONSULTATIONS PRENATALES
        </h2>

        <p class='text'>
            4ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app4A</span> et le
            <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app4B </span> <br>

            5ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app5A </span> et le
            <span v-if='conceptionDate != `JJ-MM-AAAA`'>$app5B </span> <br>

            6ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app6A </span> et le
            <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app6B </span> <br>

            7ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app7A </span> et le
            <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app7B </span> <br>

            8ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'>$app8A </span> et le
            <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app8B </span> <br>

            9ème mois de grossesse: entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app9A </span> et le
            <span v-if='conceptionDate != `JJ-MM-AAAA`'> $app9B </span>
        </p>

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

        <div class='item'>
            <h2>
                CALENDRIER CONGE MATERNITE
            </h2>

            <div>
                <p class='text'>
                    <label for=''>
                        Nombre d'enfant(s) déjà né(s) : <select v-model='kids' required id=''
                            style='height: 40px; margin-top: 10px;'>
                            <option value='0'>0</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>
                    </label> <br>

                    <label for=''>
                        Vous êtes enceinte de: <select v-model='kidsComing' required style='height: 40px; margin-top: 5px;'>
                            <option value='Un enfant'>Un enfant</option>
                            <option value='jumeaux'>Jumeaux</option>
                            <option value='triples'>Triplés ou plus</option>
                        </select>
                    </label>

                    <button class='btn btn-primary ' style='background-color: #fa899c; border: none;
                                    color: white; margin-left: 10px' @click='proceedVac()'>
                        Calculer
                    </button>
                </p>
            </div>

            <p class='text'>
                Début de votre congé maternité : <span> {{ dateVacA }} </span> <br>
                Fin de votre congé maternité : <span> {{ dateVacB }} </span> <br>
                Date de pris en charge l'assurance maladie:
                <span> {{ dateCare }} </span> <br>
            </p>

            <p class='text'>Pour bénéficier de tous vos droits, vous devez envoyer votre
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

        <div class='item'>
            <h2>
                CALCUL DATE D'OVULATION
            </h2>

            <div>
                <div class='ovulation'>
                    <label for=''>
                        Cycle : <select v-model='cycle' id='' style='height: 40px;'>
                            <option value='24'>24</option>
                            <option value='28'>28</option>
                            <option value='36'>36</option>
                        </select>
                    </label> <br>


                    <button class='btn btn-primary ' @click='proceedFert()' style='background-color: #fa899c; color: white;
                                border: none;'>
                        Calculer
                    </button>
                </div>
            </div>

            <p class='text mt-2'>
                Période d'ovulation: entre le <span> {{ fecondDateA }} </span> et le
                <span> {{ fecondDateB }}
                </span>
            </p>

            <p class='text mt-2'>
                Pour déterminer votre cycle d'ovulation, il suffit en définitive de connaître votre cycle
                menstruel.
                Celui-ci commence le premier jour de vos règles et s'achève le premier jour des règles
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

            <div class='item'>
                <h2>
                    AUTRES INFORMATIONS IMPORTANTES
                </h2>


                <p class='text'>
                    A partir du <span v-if='conceptionDate != `JJ-MM-AAAA`'>$prematureDate </span> votre bébé n'est plus prématuré. <br>
                    La consultation avec l'anesthésiste est à effectuer à partir du <span v-if='conceptionDate != `JJ-MM-AAAA`'> $anesth </span>
                    <br>
                    Le prélèvement vaginal est à éffectuer entre le <span v-if='conceptionDate != `JJ-MM-AAAA`'>$vagA</span> et le
                    <span v-if='conceptionDate != `JJ-MM-AAAA`'> $vagB </span>
                </p>

                <p class='text'>
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
            <a class='btn btn-primary' style='background-color: #fa899c;
                        border: none; color: white;' href='https://www.calendriers-grossesse.com/calcul-semaine-de-grossesse/'>
                Calcul semaine de grossesse
            </a>

            <a class='btn btn-primary' style='background-color: #fa899c;
                        border: none; color: white;' href='https://www.calendriers-grossesse.com/calcul-mois-de-grossesse/'>
                Calcul mois de grossesse
            </a>

            <a class='btn btn-primary' style='background-color: #fa899c;
                        border: none; color: white;' href='https://www.calendriers-grossesse.com/calcul-date-daccouchement/'>
                Calcul date d'accouchement
            </a>
        </div>
        </div>
</div>";

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
    wp_enqueue_script(
        'script',
        esc_url(plugin_dir_url(__FILE__) . 'public/js/script.js'),
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

//add_action('init', 'wpse1611987_init_session');
add_shortcode('pregnancyCalendar', 'displayHome');