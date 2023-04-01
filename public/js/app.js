const { createApp } = Vue;

createApp({
  data() {
    return {
      durationInMs: '',
      durationInDays: '',
      durationInWeeks: '',
      durationInMonths: '',
      dueDate: '',
      dueDateFormated: '',
      dateOfAnnounement: '',
      dateVacA: '',
      dateVacB:'',
      dateCare: '',
      kids: '',
      kidsComing: '',
      resultsVac: null,
      cycle: '',
      resultsFert: null,
      fecondDateA: '',
      fecondDateB: '',
      showButtons: true,
      conceptionDate: '',
      lastPeriodDate: ''

    }
  },
  mounted() {
    this.sayHi();
  },
  computed: {

  },
  methods: {
    sayHi(){
      this.conceptionDate = document.getElementById('conceptionDate').value;

      function addDaysToDate(date, daysToAdd) {
        // Split the date into day, month, and year components
        const dateComponents = date.split('-');
        const day = parseInt(dateComponents[0]);
        const month = parseInt(dateComponents[1]) - 1;
        const year = parseInt(dateComponents[2]);

        // Create a new Date object with the specified date components
        const originalDate = new Date(year, month, day);

        // Add the specified number of days to the original date
        const newDate = new Date(originalDate.getTime() + (daysToAdd * 24 * 60 * 60 * 1000));

        // Format the new date as "DD-MM-YYYY"
        const newDay = ("0" + newDate.getDate()).slice(-2);
        const newMonth = ("0" + (newDate.getMonth() + 1)).slice(-2);
        const newYear = newDate.getFullYear();
        const formattedDate = `${newDay}-${newMonth}-${newYear}`;

        return formattedDate;
      }

    this.lastPeriodDate = addDaysToDate(this.conceptionDate, -14);

    },
    proceedVac(){
        //vacancies
        if (this.kids === '' || this.kidsComing === '') {
            alert('Merci de renseigner des informations pour le calcul')
        }else{
          this.resultsVac = 'ok';

          function addDaysToDate(date, daysToAdd) {
            // Split the date into day, month, and year components
            const dateComponents = date.split('-');
            const day = parseInt(dateComponents[0]);
            const month = parseInt(dateComponents[1]) - 1;
            const year = parseInt(dateComponents[2]);

            // Create a new Date object with the specified date components
            const originalDate = new Date(year, month, day);

            // Add the specified number of days to the original date
            const newDate = new Date(originalDate.getTime() + (daysToAdd * 24 * 60 * 60 * 1000));

            // Format the new date as "DD-MM-YYYY"
            const newDay = ("0" + newDate.getDate()).slice(-2);
            const newMonth = ("0" + (newDate.getMonth() + 1)).slice(-2);
            const newYear = newDate.getFullYear();
            const formattedDate = `${newDay}-${newMonth}-${newYear}`;

            return formattedDate;
          }

        if(this.kids < 2){
          this.dateVacA = addDaysToDate(this.conceptionDate, 231);
        this.dateVacB = addDaysToDate(this.conceptionDate, 342);
        this.dateCare = addDaysToDate(this.conceptionDate, 153);
      }

        if(this.kids >= 2){
          this.dateVacA = addDaysToDate(this.conceptionDate, 217);
          this.dateVacB = addDaysToDate(this.conceptionDate, 398);
          this.dateCare = addDaysToDate(this.conceptionDate, 153);
        }

        if(this.kidsComing == 'jumeaux'){
          this.dateVacA = addDaysToDate(this.conceptionDate, 189);
        this.dateVacB = addDaysToDate(this.conceptionDate, 426);
        this.dateCare = addDaysToDate(this.conceptionDate, 153);
        }


        if(this.kidsComing == 'Triples'){
          this.dateVacA = addDaysToDate(this.conceptionDate, 105);
        this.dateVacB = addDaysToDate(this.conceptionDate, 426);
        this.dateCare = addDaysToDate(this.conceptionDate, 153);
        }
        }
      },
      proceedFert(){
        if(this.cycle == ''){
            alert('Veuillez insérer des informations pour le calcul')
        }else{
          this.resultsFert = 'ok';

          function addDaysToDate(date, daysToAdd) {
            // Split the date into day, month, and year components
            const dateComponents = date.split('-');
            const day = parseInt(dateComponents[0]);
            const month = parseInt(dateComponents[1]) - 1;
            const year = parseInt(dateComponents[2]);

            // Create a new Date object with the specified date components
            const originalDate = new Date(year, month, day);

            // Add the specified number of days to the original date
            const newDate = new Date(originalDate.getTime() + (daysToAdd * 24 * 60 * 60 * 1000));

            // Format the new date as "DD-MM-YYYY"
            const newDay = ("0" + newDate.getDate()).slice(-2);
            const newMonth = ("0" + (newDate.getMonth() + 1)).slice(-2);
            const newYear = newDate.getFullYear();
            const formattedDate = `${newDay}-${newMonth}-${newYear}`;

            return formattedDate;
          }

            if(this.cycle == 24){
              this.fecondDateA =  addDaysToDate(this.conceptionDate,  12);
          } else if(this.cycle == 28){
            this.fecondDateA =  addDaysToDate(this.conceptionDate,  14);
          } else if(this.cycle == 36){
            this.fecondDateA =  addDaysToDate(this.conceptionDate,  18);
          }
            }

            this.fecondDateB =  addDaysToDate(this.conceptionDate, 2);
      },
  },

  }).mount('#app')