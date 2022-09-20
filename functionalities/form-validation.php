<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

    let pass = document.getElementById("password");



    // instraction 
    let helpBtn, chkbtn;

    chkbtn = document.querySelectorAll(".btn-help");
    for (let i = 0; i < chkbtn.length; i++) {

        chkbtn[i].addEventListener('click', (e) => {
            chkbtn[i].nextElementSibling.classList.toggle('helpInsVisible');

        })
    }





    // password validation =================
    let passElement, confirm_passElement, passVal, conPassVal;

    passElement = document.querySelector("#password");
    confirm_passElement = document.querySelector('#confirm_pass');

    confirm_pass.setAttribute('minlength', 1111);

    confirm_passElement.addEventListener('input', (event) => {
        passVal = passElement.value;
        conPassVal = confirm_passElement.value;


        if (passVal == conPassVal) {
            confirm_passElement.classList.remove("is-invalid");
            confirm_passElement.classList.add("is-valid");
            confirm_pass.setAttribute('minlength', passVal.length);

        } else {
            confirm_passElement.classList.add("is-invalid");
            confirm_passElement.classList.remove("is-valid");
            confirm_pass.setAttribute('minlength', 1111);
        }
    });
    // end password validation =================


    // switch user ==================

    //user input field
    let patientOptional, councilorOptional;
    patientOptional = document.querySelectorAll("[name='address'],[name='city'],[name='zip_code']");
    councilorOptional = document.querySelector("[name='working_info']");
    
    let patientEx, role, currentRole;
    role = document.getElementById('role');
    patientEx = document.querySelectorAll('.switch-patient');
    currentRole = role.value;


    for (value of patientEx) {

        switch (currentRole) {
            case "doctor":

                value.style.display = "block";
                councilorOptional.setAttribute("required", "");
                for (item of patientOptional) {
                    item.setAttribute("required", "");
                }
                councilorOptional.labels[0].textContent = "Important";

                break;
            case "councilor":
                value.style.display = "block";
                for (item of patientOptional) {
                    item.setAttribute("required", "");
                }
                councilorOptional.removeAttribute("required");
                councilorOptional.labels[0].textContent = "Optional";
                break;
            default:
                value.style.display = "none";
                councilorOptional.setAttribute("required", "");
                for (item of patientOptional) {
                    item.removeAttribute("required");
                }
                break;
        }

    }

    // role event 
    role.addEventListener('change', (e) => {
        let selectRoleElement = e.target;
        let selectedRole = selectRoleElement.value;


        for (value of patientEx) {
            switch (selectedRole) {
                case "doctor":

                    value.style.display = "block";
                    councilorOptional.setAttribute("required", "");
                    councilorOptional.labels[0].textContent = "Important";
                    patientOptional.forEach((item) => {
                        item.setAttribute('required','');
                    });
                    break;
                case "councilor":
                    value.style.display = "block";
                    councilorOptional.removeAttribute("required");
                    councilorOptional.labels[0].textContent = "Optional";
                    patientOptional.forEach((item) => {
                        item.setAttribute('required','');
                    });

                    break;
                default:
                    value.style.display = "none";
                    councilorOptional.setAttribute("required", "");
                    patientOptional.forEach((item) => {
                        item.removeAttribute('required');
                    });

                    break;
            }
        }
    });
</script>