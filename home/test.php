<?php
/*
 * Plugin Name: pregnancyCalendar
 */

function wpse16119876_init_session()
{
    session_start();
    $_SESSION['abc'] = '15/01/22';
}

function displayApp()
{
    wpse16119876_init_session();
    $abc = isset($_SESSION['abc']) ? $_SESSION['abc'] : '';

    echo "
    <div class='app' id='app'>
        <div class='content'>
            <div class='main'>
                    <form class='proceed' action='#' method='POST'>
                        <div class='form'>
                            <label for=''>
                                <p>Date des dernières règles:</p>
                                <input type='date' class='date' v-model='lastPeriodDate' name='lastPeriodDate'>
                            </label>

                        </div>

                        <button @click='proceed()' type='submit' class='btn btn-primary' style='background: #f0c7c2;
                                    border: none; color: #393F82;'>
                            Calculer
                        </button>
                    </form>
            </div>
        </div>
    </div>

    <script src='https://unpkg.com/vue@3/dist/vue.global.js'></script>

    <script>
    const app = Vue.createApp({
        data() {
            return {
              lastPeriodDate: '$abc'
            }
          },
          methods: {
            proceed(){
                    alert('ok');
                    console.log(this.lastPeriodate);
            }
          }
    }).mount('#app');
    </script>
        ";
}

add_shortcode('pregnancyCalendar', 'displayApp');