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

function displayDelivery()
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
        }
    }

    $dueDate = addDaysToDate($conceptionDate, 273);

    echo "
    <div class='app' id='app'>
        <div class='content'>
            <div class='main'>
                <div class='main__text'>
                    <h1 class='title'>
                       CALCUL DE LA DATE D'ACCOUCHEMENT
                    </h1>
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
                            <p>Date des dernières règles: </p>
                            <input class='date mx-auto text-center'
                            name='conceptionDate' type='text'
                            onfocus='(this.type = `date`)'  style='width:150px; height: 30px; border-color: black'
                             placeholder='$conceptionDate' id='conceptionDatee'>
                            </label>

                        </div>

                        <button  type='submit' class='btn btn-primary' style='background-color: #fa899c;
                        border: none; color: white;'>
                            Calculer
                        </button>
                    </form>
                </div>
            </div>

            <div class='item' id='calendar'>
                <h2>
                   DATE D'ACCOUCHEMENT
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
            <hr> <br>

            <div class='bottom'>
                        <h2 class='subtitle'>
                            DATE D'ACCOUCHEMENT:
                        </h2>
                        <p class='text text-justify'>
                            Date d'accouchement prévue: <span> $dueDate</span> <br>

                        </p>
                        <br>
            </div>
                    <hr>


            <div class='links mx-auto text-center'>
                <a class='btn btn-primary'  style='background-color: #fa899c;
                border: none; color: white;'
                    href='https://www.calendriers-grossesse.com/'>
                    Calendrier grossesse
                </a>

                <a class='btn btn-primary'  style='background-color: #fa899c;
                border: none; color: white;'
                    href='https://www.calendriers-grossesse.com/calcul-semaine-de-grossesse/'>
                    Calcul semaine de grossesse
                </a>

                <a class='btn btn-primary'  style='background-color: #fa899c;
                border: none; color: white;'
                    href='https://www.calendriers-grossesse.com/calcul-mois-de-grossesse/'>
                    Calcul mois de grossesse
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