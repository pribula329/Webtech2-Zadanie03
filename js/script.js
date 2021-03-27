(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                console.log(form[0].value);

                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()


function kontrola(id){

    if (!document.getElementById(id).value.trim()) {
        document.getElementById('upozornenieY').innerHTML = "Prosim zadajte nazov nie medzeri";
        document.getElementById('upozornenieY').style.color = "#FF0000";
        return false;
    }
    document.getElementById('upozornenieY').style.color = "#FFFFFF";
    return  true;
}

function heslo() {

    var x = document.getElementById("validationHeslo");

    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

}
function stuHeslo() {

    var t = document.getElementById("stubaHeslo");

    if (t.type === "password") {
        t.type = "text";
    } else {
        t.type = "password";
    }

}


function registraciaHeslo() {

    var x = document.getElementById("validationHeslo");

    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var z = document.getElementById("validationHeslo2");

    if (z.type === "password") {
        z.type = "text";
    } else {
        z.type = "password";
    }

}

function zobrazit() {
    var x = document.getElementById('prihlasenia');

    x.style.display="block";
    document.getElementById('zobrazit').style.display="none";
    document.getElementById('skryt').style.display="block";

}
function skryt() {
    var x = document.getElementById('prihlasenia');

    x.style.display="none";
    document.getElementById('zobrazit').style.display="block";
    document.getElementById('skryt').style.display="none";

}
function graf(reg,google,stu) {

    var chart = new CanvasJS.Chart("graf", {
        animationEnabled: true,
        title: {
            text: ""
        },
        data: [{
            type: "pie",
            startAngle: 225,
            yValueFormatString: "##0\"\"",
            indexLabel: "{label} {y}",
            dataPoints: [
                {y: reg, label: "Registrácia"},
                {y:google, label: "Google"},
                {y: stu, label: "Stuba účet"}
            ]
        }]
    });
    chart.render();

}


