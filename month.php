<!DOCTYPE html>
<html lang='en'>

<head>

    <script src='https://kit.fontawesome.com/b14771b76e.js' crossorigin='anonymous'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link href='public/scss/main.css' rel='stylesheet'>


    <title>Calendrier de grossesse - Mois</title>

</head>

<?php include 'menu.php'; ?>

<body>
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
                        <h2 class='subtitle'>
                            Mon calendrier de grossesse <span><a href='#calendar'><i
                                        class='fas fa-question'></i></a></span>
                        </h2>
                        <p class='text text-justify'>
                            Vous êtes enceinte de: <span> {{  convertInMonths(durationInDays)  }} </span> <br>
                            bravo, vous avez fait: <span> {{ format((durationInDays *100)/280 ) }} % du
                                chemin</span>
                            <br>

                        </p>
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
                    Calendrier des echographies
                </h2>

                <p class='text text-justify' v-if='results != null'>
                    <strong>Echographie précoce:</strong> entre le <span>{{ formatDate(dateEco0A) }} </span> et
                    le
                    <span> {{ formatDate(dateEco0B) }}
                    </span>
                    <br>

                    <strong>1ère échographie recommandée:</strong>
                    entre le <span>{{ formatDate(dateEco1A) }}</span> et le
                    <span>{{ formatDate(dateEco1B)}}</span> <br>

                    <strong>2ème échographie recommandée:</strong>
                    entre le <span>{{ formatDate(dateEco2A ) }}</span> et le
                    <span>{{ formatDate(dateEco2B) }}</span> <br>

                    <strong>3ème échographie:</strong>
                    entre le <span>{{ formatDate(dateEco3A) }}</span> et le
                    <span>{{ formatDate(dateEco3B) }}</span>
                </p>

                <p class='text text-justify'>
                    <strong>L'échographie</strong> doit être réalisée entre 8 S.A. et 9S.A. <br>
                    <strong>La première échographie</strong> doit être réalisée entre 11 S.A. et 13 S.A.+6. <br>
                    <strong>La deuxième échographie</strong> est réalisée entre 22S.A. et 24S.A. <br>
                    <strong>La troisième échographie</strong> est réalisée entre 32S.A. et 34S.A.. <br>
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
                    Calendrier des consultations prénatales
                </h2>

                <p class='text text-justify' v-if='results != null'>
                    <strong> 4ème mois de grossesse:</strong> entre le <span>{{ formatDate(dateCons4A) }}</span>
                    et le
                    <span>{{ formatDate(dateCons4B) }} </span> <br>

                    <strong>5ème mois de grossesse:</strong> entre le <span>{{ formatDate(dateCons5A) }}</span>
                    et le
                    <span>{{ formatDate(dateCons5B) }} </span> <br>

                    <strong>6ème mois de grossesse:</strong> entre le <span>{{ formatDate(dateCons6A) }}</span>
                    et le
                    <span>{{ formatDate(dateCons6B) }} </span> <br>

                    <strong>7ème mois de grossesse:</strong> entre le <span>{{ formatDate(dateCons7A) }}</span>
                    et le
                    <span>{{ formatDate(dateCons7B) }} </span> <br>

                    <strong> 8ème mois de grossesse:</strong> entre le <span>{{ formatDate(dateCons8A) }}</span>
                    et le
                    <span>{{ formatDate(dateCons8B) }} </span> <br>

                    <strong> 9ème mois de grossesse:</strong> entre le <span>{{ formatDate(dateCons9A) }}</span>
                    et le
                    <span>{{ formatDate(dateCons9B) }} </span>
                </p>

                <p class='text text-justify'>
                    Le calcul des dates pendant la grossesse permet de déterminer la date d'accouchement et de suivre le
                    développement du bébé. Les consultations prénatales sont essentielles pour surveiller la santé de la
                    mère et du bébé, détecter d'éventuels problèmes et fournir des informations et un soutien émotionnel
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
    <script type='javascript' src='./public/js/script.js'></script>

</body>

</html>