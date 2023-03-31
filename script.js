let echo = document.getElementById('echo');
let results = document.getElementById('results');
let appointments = document.getElementById('appointments');
let more = document.getElementById('more');

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


