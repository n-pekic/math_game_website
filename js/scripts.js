window.addEventListener("DOMContentLoaded", init);


// GET parameter redirection alerts, 5 second timeout. for php
// const alertContainer = document.getElementById("alert-container");

let timeout;
const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')
const numsLetters = new RegExp(/^[A-Za-z0-9_-]*$/)

function init() {

    /*
    // signup form
    // const formSignup = document.getElementById('signup-form');
    // const resetSignup = document.getElementById('reset-signup');
    // const closeModalSignup = document.getElementById('close-modal-signup')
     */

    // login form
    const formLogin = document.getElementById('login-form');
    const resetLogin = document.getElementById('reset-login');
    const closeModalLogin = document.getElementById('close-modal-login')

    /*
    //reset error fields in signup/login form when reset or exit buttons are clicked
    resetSignup.addEventListener('click', function (e) {
        resetErrorFields(formSignup);
    })
    closeModalSignup.addEventListener('click', function (e) {
        resetErrorFields(formSignup);
    })
     */

    if(resetLogin) {
        resetLogin.addEventListener('click', function (e) {
            resetErrorFields(formLogin);
        })
        closeModalLogin.addEventListener('click', function (e) {
            resetErrorFields(formLogin);
        })
    }

    /*
    if(formSignup !== null) {
        formSignup.addEventListener('submit', function (e) {
            e.preventDefault()
            if(validateFormSignup()) this.submit();
        })
    }
     */

    if(formLogin !== null) {
        formLogin.addEventListener('submit', function (e) {
            e.preventDefault()
            if (validateFormLogin()) this.submit();
        })
    }

    let userTable = document.getElementById('user-table');
    let highscoreTable = document.getElementById('highscore-table');

    if(userTable) {
        $(userTable).DataTable({
            ajax: {
                url: 'ajax/users.php',
                type: 'POST',
                dataSrc: "",
            },
            columns: [
                {data: 'id_user', title: 'ID'},
                {data: 'username', title: 'user name'},
            ]
        });
    }

    if(highscoreTable){
        $(highscoreTable).DataTable({
            ajax: {
                url: 'ajax/highscores.php',
                type: 'POST',
                dataSrc: "",
            },
            columns: [
                {data: 'id_highscore', title: 'ID'},
                {data: 'id_user', title: 'ID user'},
                {data: 'correct_answers', title: 'correct'},
                {data: 'incorrect_answers', title: 'incorrect'},
                {data: 'avg_time', title: 'avg_time'},
                {data: 'game_type', title: 'game type'},
                {data: 'game_level', title: 'game level'},
                {data: 'date_time', title: 'date time'}
            ]
        });

    }

    /*
    id_highscore
id_user
correct_answers
incorrect_answers
avg_time
game_type
game_level
date_time
     */


}

/*
let validateFormSignup = () => {

    let isValid = true;
    const usernameSignup = document.getElementById('username-signup');
    const passwordSignup = document.getElementById('password-signup');

    if(isEmpty(usernameSignup.value.trim())) {
        showErrorMessage(usernameSignup, "Username cannot be empty.")
        isValid = false;
    } else if (usernameSignup.value.trim().length > 12) {
        showErrorMessage(usernameSignup, "Max length 12 characters.");
        isValid = false;
    } else if (!isOnlyNumsLetters(usernameSignup.value.trim())) {
        showErrorMessage(usernameSignup, "Only A-Z, a-z, 0-9, -, and _ allowed.");
        isValid = false;
    } else {
        hideErrorMessage(usernameSignup);
    }

    if(isEmpty(passwordSignup.value.trim()) || passwordSignup.value.trim().length < 8) {
        showErrorMessage(passwordSignup, "Password empty or less than 8 characters.");
        isValid = false;
    } else {
        hideErrorMessage(passwordSignup);
    }

    return isValid;
}
 */

let validateFormLogin = () => {

    let isValid = true;
    const usernameLogin = document.getElementById('username');
    const passwordLogin = document.getElementById('password');

    if(isEmpty(usernameLogin.value.trim())) {
        showErrorMessage(usernameLogin, "Username cannot be empty.");
        isValid = false;
    } else if(!isOnlyNumsLetters(usernameLogin.value.trim())) {
        showErrorMessage(usernameLogin, "Only A-Z, a-z, 0-9, -, and _ allowed.");
        isValid = false;
    } else if(usernameLogin.value.trim().length > 12){
        showErrorMessage(usernameLogin, "Check username, max length is 12 characters.")
        isValid = false;
    } else {
        hideErrorMessage(usernameLogin);
    }

    if(isEmpty(passwordLogin.value.trim())) {
        showErrorMessage(passwordLogin, "Enter your password.")
        isValid = false;
    } else {
        hideErrorMessage(passwordLogin);
    }

    return isValid;

}

const isEmpty = value => value === '';

const isOnlyNumsLetters = (value) => {
    return numsLetters.test(value);
}

const showErrorMessage = (field, message) => {
    const error = field.nextElementSibling;
    error.classList.add('error');
    error.innerText = message;
};

const hideErrorMessage = (field) => {
    const error = field.nextElementSibling;
    error.classList.remove('error');
    error.innerText = '';
}

const resetErrorFields = (form) => {
    let errorFields = form.querySelectorAll('small');
    if (errorFields) {
        errorFields.forEach((element) => {
            element.innerText = '';
            element.classList.remove('error');
        });
    }
};

