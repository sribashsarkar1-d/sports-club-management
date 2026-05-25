/* ============================================================
   PREMIUM LOGIN ERROR VALIDATION SYSTEM
   ============================================================ */

/* ============================================================
   ELEMENTS
   ============================================================ */

const loginForm = document.querySelector('form');

const emailInput =
document.getElementById('login-email');

const passwordInput =
document.getElementById('login-password');

const errorBox =
document.getElementById('auth-error-box');

const errorText =
document.getElementById('auth-error-text');

/* ============================================================
   EMAIL VALIDATION
   ============================================================ */

function isValidEmail(email){

    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

}

/* ============================================================
   SHOW ERROR
   ============================================================ */

function showAuthError(message, fields = [], title = "Login Failed"){

    if (!errorBox || !errorText) return;

    const errorTitleEl = errorBox.querySelector('.auth-error-title');
    if (errorTitleEl) {
        errorTitleEl.textContent = title;
    }

    errorText.textContent = message;

    errorBox.classList.remove('hide');

    void errorBox.offsetWidth;

    errorBox.classList.add('show');

    /* INPUT ERROR EFFECT */

    fields.forEach(field => {
        if (!field) return;

        field.classList.remove('error');

        void field.offsetWidth;

        field.classList.add('error');

        /* INPUT WRAPPER SHAKE */

        const wrapper =
        field.closest('.input-wrapper');

        if(wrapper){

            wrapper.classList.remove('error');

            void wrapper.offsetWidth;

            wrapper.classList.add('error');

        }

    });

    /* AUTO HIDE */

    clearTimeout(window.authErrorTimer);

    window.authErrorTimer = setTimeout(() => {

        errorBox.classList.remove('show');

        errorBox.classList.add('hide');

    }, 5000);

}

/* ============================================================
   REMOVE ERROR STATE
   ============================================================ */

function clearFieldError(field){

    field.classList.remove('error');

    const wrapper =
    field.closest('.input-wrapper');

    if(wrapper){

        wrapper.classList.remove('error');

    }

}

/* ============================================================
   LIVE INPUT FIX
   ============================================================ */

if (emailInput) {
    emailInput.addEventListener('input', () => {

        clearFieldError(emailInput);

    });
}

if (passwordInput) {
    passwordInput.addEventListener('input', () => {

        clearFieldError(passwordInput);

    });
}

/* ============================================================
   FORM VALIDATION
   ============================================================ */

if (loginForm) {
    loginForm.addEventListener('submit', function(e){

        /* EMPTY EMAIL */

        if (emailInput) {
            const email = emailInput.value.trim();

    if(email === ''){

        e.preventDefault();

        showAuthError(
            'Please enter your email address.',
            [emailInput]
        );

        return;

    }

    /* INVALID EMAIL */

    if(!isValidEmail(email)){

        e.preventDefault();

        showAuthError(
            'Please enter a valid email address.',
            [emailInput]
        );

        return;

        }

    } // end if emailInput

    /* EMPTY PASSWORD */

    if (passwordInput) {
        const password = passwordInput.value.trim();
        if(password === ''){

            e.preventDefault();

            showAuthError(
                'Please enter your password.',
                [passwordInput]
            );

            return;

        }
        }
    });
}

/* ============================================================
   BACKEND ERROR HANDLER
   ============================================================ */

/*
=====================================================
PHP BACKEND RESPONSE EXAMPLES
=====================================================

ADD THIS INSIDE login-action.php
*/

/*

INVALID PASSWORD:

header(
"Location: login.php?error=wrong_password"
);

USER NOT FOUND:

header(
"Location: login.php?error=user_not_found"
);

INVALID BOTH:

header(
"Location: login.php?error=invalid_credentials"
);

EMPTY:

header(
"Location: login.php?error=empty_fields"
);

exit;

*/

/* ============================================================
   URL ERROR DETECTION
   ============================================================ */

const params =
new URLSearchParams(window.location.search);

const loginError = params.get('error');

if (loginError && errorBox) {

    switch(loginError){

        case 'wrong_password':

            showAuthError(
                'Incorrect password. Please try again.',
                passwordInput ? [passwordInput] : []
            );

        break;

        case 'user_not_found':

            showAuthError(
                'No account found with this email.',
                [emailInput]
            );

        break;

        case 'invalid_credentials':

            showAuthError(
                'Email or password does not match.',
                passwordInput ? [emailInput, passwordInput] : [emailInput]
            );

        break;

        case 'empty_fields':

            showAuthError(
                'Please fill in all required fields.',
                passwordInput ? [emailInput, passwordInput] : [emailInput]
            );

        break;

        case 'pending':

            showAuthError(
                'Your registration is pending admin verification.',
                [emailInput],
                'Approval Required'
            );

        break;

        case 'rejected':

            showAuthError(
                'Your application has been rejected. Please contact support.',
                [emailInput],
                'Application Rejected'
            );

        break;

        case 'not_found':

            showAuthError(
                'No account found with this email address.',
                emailInput ? [emailInput] : []
            );

        break;

        case 'empty_email':

            showAuthError(
                'Please enter your registered email address.',
                emailInput ? [emailInput] : []
            );

        break;

        case 'csrf_failed':

            showAuthError(
                'Security token invalid. Please try again.',
                [],
                'Session Expired'
            );

        break;

        case 'invalid_email':

            showAuthError(
                'Please enter a valid email address.',
                emailInput ? [emailInput] : []
            );

        break;

        case 'server_error':

            showAuthError(
                'An unexpected server error occurred.',
                [],
                'System Error'
            );

        break;

    }

}