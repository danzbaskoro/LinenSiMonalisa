"use strict";
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

var LoginProcess = function () {
    var form;
    var submitButton;
    var validator;
    var handleForm = function (e) {
        validator = FormValidation.formValidation(
            form, {
                fields: {
                    'username': {
                        validators: {
                            notEmpty: {
                                message: 'Username Wajib Diisi'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Password Wajib Diisi'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    login(submitButton);
                } else {
                    toastr.error("Terdapat Data yang tidak valid. Cek Kembali");
                }
            });
        });
    }

    return {
        init: function () {
            form = document.querySelector('#login_form');
            submitButton = document.querySelector('#login_submit');

            handleForm();
        }
    };
}();

async function login(button) {
    const email = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    // const recaptcha = grecaptcha.getResponse();


    try {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        const response = await axios.post('/proses-login',{
            username: email,
            password: password
        });

        button.removeAttribute("data-kt-indicator");
        button.disabled = false;
        Swal.fire({
            text: "Login Berhasil!",
            icon: "success",
            buttonsStyling: !1,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const b = Swal.getHtmlContainer().querySelector('b');
                setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                }, 100);
            }
        }).then(function () {
            window.location.href = response.data.redirect;
        })
    } catch (error) {
        button.removeAttribute("data-kt-indicator");
        button.disabled = false;

        Swal.fire({
            text: "Maaf, login gagal. Silahkan coba lagi nanti.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, Makasih!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    }
}

async function logout() {
    try {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        const response = await axios.post('/logout');

        window.location.href = response.data.redirect;
    } catch (error) {
        Swal.fire({
            text: "Maaf, logout gagal. Silahkan coba lagi nanti.",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, Makasih!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    }
}

KTUtil.onDOMContentLoaded(function () {
    LoginProcess.init();
});
