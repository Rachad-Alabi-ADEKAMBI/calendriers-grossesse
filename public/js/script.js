let echo = document.getElementById('echo');
let results = document.getElementById('results');
let appointments = document.getElementById('appointments');
let more = document.getElementById('more');
let form = document.getElementById('myForm');

function displayResults(){
    echo.style.display = 'none';
    appointments.style.display = 'none';
    results.style.display = 'block';
    more.style.display = 'none';
}

function displayEcho(){
    echo.style.display = 'block';
    appointments.style.display = 'none';
    results.style.display = 'none';
    more.style.display = 'none';
}


function displayAppointments(){
    echo.style.display = 'none';
    appointments.style.display = 'block';
    results.style.display = 'none';
    more.style.display = 'none';
}

function displayMore(){
    echo.style.display = 'none';
    appointments.style.display = 'none';
    results.style.display = 'none';
    more.style.display = 'block';
}

function validate(){
        let lastPeriodDate = document.getElementById('lastPeriodDatee').value;
        let conceptionDate = document.getElementById('conceptionDatee').value;

        if (lastPeriodDate == '' && conceptionDate == '') {
          alert('Veuillez renseigner soit la date des dernières règles soit celle de la conception');
          event.preventDefault();
        } else {
          let conceptionDateee = null;
            if (conceptionDate == '') {
                const startDate = new Date(lastPeriodDate);
                startDate.setDate(startDate.getDate() + 14);
                 conceptionDateee = startDate;
              } else{
                const startDate = new Date(conceptionDate);
                startDate.setDate(startDate.getDate());
                  conceptionDateee = startDate;
              }

              let today = new Date();

              let durationInMs = today - conceptionDateee;
              let  durationInDays = Math.floor((durationInMs / 1000 / 60 / 60 / 24));
/*
              if(durationInMs < 0){
               alert('Merci de vérifier la date insérée');
               console.log(durationInMs);
               console.log(today);
               console.log(conceptionDateee);
               event.preventDefault();
              }
              */

               if(durationInDays > 300){
                alert('Merci de vérifier la date insérée');
                event.preventDefault();
              } else{
                form.submit();
              }
         }
}

