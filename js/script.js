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
