
function changeMonthHoras(e) {
    if (e.value != ""){
        location.href = `grafica-horas.php?mes=${e.value}`;
    }
}


function changeMonthHorasPor(e) {
    if (e.value != ""){
        location.href = `grafica-por-horas.php?mes=${e.value}`;
    }
}

function changeMonthEdades(e) {
    if (e.value != ""){
        location.href = `grafica-edades.php?mes=${e.value}`;
    }
}


function changeMonthEdadesPor(e) {
    if (e.value != ""){
        location.href = `grafica-por-edades.php?mes=${e.value}`;
    }
}

function changeMonthAreas(e) {
    if (e.value != ""){
        location.href = `grafica-dep.php?mes=${e.value}`;
    }
}


function changeMonthAreasPor(e) {
    if (e.value != ""){
        location.href = `grafica-por-dep.php?mes=${e.value}`;
    }
}