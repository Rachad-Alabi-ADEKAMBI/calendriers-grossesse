const { createApp } = Vue;

createApp({
  data() {
    return {
      results: null,
      detail: '',
      errorMsg: '',
      successMessage: '',
      durationInMs: '',
      durationInDays: '',
      durationInWeeks: '',
      durationInMonths: '',
      dueDate: '',
      dueDateFormated: '',
      AndurationInDays: '',
      AndurationInDays: '',
      Anduration: '',

      dateVacA: '',
      dateVacB:'',
      dateCare: '',
      kids: '',
      kidsComing: '',
      resultsVac: null,
      prematureDate: '',
      anesthDate: '',
      dateVagA: '',
      dateVagB: '',
      cycle: '',
      resultsFert: null,
      fecondDateA: '',
      fecondDateB: '',
      showCalendar: false,
      calendar: [],
      showButton: false,
      currentWeek: '',
      lastPeriodDate: '',
      conceptionDate: '',
      userId: ''
    }
  },
  computed: {
    },
  mounted: function() {
    this.userId = document.getElementById('lastPeriodDate').value;

  },
  methods: {
    proceedVac(){
        //vacancies
        if (this.kids === '' && this.kidsComing === '') {
            alert('Merci de renseigner des informations pour le calcul')
        }else{
          this.resultsVac = 'ok';

          function addDays(date, days) {
            var result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
          }


          let days1 = 0;
          let days2 = 0;
          let days3 = 0


        if(this.kids < 2){
          days1 = 245;
             days2 = 111;
             days3=153;
      }

        if(this.kids >= 2){
          days1 = 231;
             days2 = 181;
             days3=153;
        }

        if(this.kidsComing == 'jumeaux'){
          days1 = 189;
             days2 = 425;
             days3=153;
        }


        if(this.kidsComing == 'triplés'){
          days1 = 93;
          days2 = 425;
          days3=153;
        }


        this.dateVacA = addDays(this.conceptionDate, days1);
        this.dateVacB = addDays(this.conceptionDate, days2);
        this.dateCare = addDays(this.conceptionDate, days3);
        }
      },
    proceedFert(){
        if(this.cycle == ''){
            alert('Veuillez insérer des informations pour le calcul')
        }else{
          this.resultsFert = 'ok';

            function addDays(date, days) {
                var result = new Date(date);
                result.setDate(result.getDate() + days);
                return result;
              }

            if(this.cycle == 24){
              this.fecondDateA =  addDays(this.lastPeriodDate,  12);
          } else if(this.cycle == 28){
            this.fecondDateA =  addDays(this.lastPeriodDate,  14);
          } else if(this.cycle == 36){
            this.fecondDateA =  addDays(this.lastPeriodDate,  18);
          }
            }

            this.fecondDateB =  addDays(this.fecondDateA, 2);
      },

      convertir(jours) {
        const joursParMois = 30.44;
        const joursParSemaine = 7;

        const mois = Math.floor(jours / joursParMois);
        const resteMois = jours % joursParMois;

        const semaines = Math.floor(resteMois / joursParSemaine);
        const resteSemaines = resteMois % joursParSemaine;

        const joursRestants = Math.floor(resteSemaines);


        const moisPluriel = mois > 1 ? "mois" : "mois";
        const semainesPluriel = semaines > 1 ? "semaines" : "semaine";
        const joursPluriel = joursRestants > 1 ? "jours" : "jour";

        return `${mois} ${moisPluriel}, ${semaines} ${semainesPluriel} et ${joursRestants} ${joursPluriel}`;
      },
      convertInWeeks(jours) {
        const joursParSemaine = 7;

        const semaines = Math.floor(jours / joursParSemaine);
        const resteSemaines = jours % joursParSemaine;

        const joursRestants = Math.floor(resteSemaines);

        const semainesPluriel = semaines > 1 ? "semaines" : "semaine";
        const joursPluriel = joursRestants > 1 ? "jours" : "jour";

        return ` ${semaines} ${semainesPluriel} et ${joursRestants} ${joursPluriel}`;
      },

       formatDate(date) {
        const options = {
          weekday: 'short',
          year: 'numeric',
          month: 'short',
          day: 'numeric'
        };
        const locale = 'fr-FR';
      //  const formattedDate = date.toLocaleString(locale, options);
     //   return formattedDate;
     return date;
      },
    format(num){
    let res = new Intl.NumberFormat('fr-FR', { maximumSignificantDigits: 1 }).format(num);
    return res;
},
    getImgUrl(pic) {
    return "public/img/" + pic;
}

  },

  }).mount('#app')