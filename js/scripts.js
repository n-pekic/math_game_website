window.addEventListener("DOMContentLoaded", init);

let timeout;
const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')
const numsLetters = new RegExp(/^[A-Za-z0-9_-]*$/)

function init() {

    // GET parameter redirection alerts, 3.5 second timeout.
    const alertContainer = document.getElementById("alert-container");

    // GET parameter redirection alerts timeout
    if (alertContainer) {
        setTimeout(function () {
            alertContainer.style.display = "none";
        }, 3500);
    }

    // Login form
    const formLogin = document.getElementById('login-form');
    const resetLogin = document.getElementById('reset-login');
    const closeModalLogin = document.getElementById('close-modal-login')

    if (resetLogin) {
        resetLogin.addEventListener('click', function (e) {
            resetFields(formLogin);
        })
        closeModalLogin.addEventListener('click', function (e) {
            resetFields(formLogin);
        })
    }

    if (formLogin !== null) {
        formLogin.addEventListener('submit', function (e) {
            e.preventDefault()
            if (validateFormLogin()) formLogin.submit();
        })
    }

    // index page -- highscore table
    const highscoreTableGuest = document.getElementById('highscore-table-guest');
    if (highscoreTableGuest) {
        $(highscoreTableGuest).DataTable({
            ajax: {
                url: 'ajax/highscores.php',
                type: 'POST',
                dataSrc: "",
                data: {
                    user: 'guest'
                },
            },
            columns: [
                {data: 'username', title: 'username'},
                {data: 'points', title: 'points'},
                // {data: 'correct_answers', title: 'correct'},
                // {data: 'incorrect_answers', title: 'incorrect'},
                // {data: 'avg_time', title: 'avg_time'},
                // {data: 'fastest_answer', title: 'fastest_answer'},
                {data: 'game_type', title: 'type'},
                {data: 'game_level', title: 'level'},
                //{data: 'accuracy', title: 'accuracy'},
                {data: 'date_time', title: 'date'}
            ],
            paging: false,       // Disable pagination
            searching: false,    // Disable search bar
            info: false,       // Disable displaying "Showing x of y entries"
            //order: [1, 'desc'],
            ordering: false,
            scrollX: true,  // Enable horizontal scrolling
            sScrollXInner: '100%',
            columnDefs: [
                // Center align both header and body content of columns [...]
                { className: "dt-center", targets: [ 0, 1, 2, 3, 4 ] }
            ]
        });
    }

    $('#high-scores-modal').on('shown.bs.modal', function () {
        const table = $('#highscore-table-guest').DataTable();
        table.columns.adjust();
    });

    // admin tables -- user table
    let userTableAdmin = document.getElementById('user-table-admin');
    if (userTableAdmin) {
        $(userTableAdmin).DataTable({
            ajax: {
                url: 'ajax/users.php',
                type: 'POST',
                dataSrc: '',
                data: {
                    user: 'admin'
                },
            },
            columns: [
                {data: 'id_user', title: 'id'},
                {data: 'role', title: 'role'},
                {data: 'username', title: 'username'},
                {data: 'total points', title: 'total points'},
                {data: 'total games', title: 'games played'},
                {data: 'favorite type', title: 'favorite type'},
                {data: 'favorite level', title: 'favorite level'},
                {data: 'accuracy', title: 'avg accuracy'}
            ],
            scrollX: true,  // Enable horizontal scrolling
            pagingType: 'simple',
            columnDefs: [
                // Center align both header and body content of columns [...]
                { className: "dt-center", targets: [ 0, 1, 2, 3, 4, 5, 6, 7 ] }
            ]
        });
    }

    // admin tables -- highscore table
    let highscoreTableAdmin = document.getElementById('highscore-table-admin');
    if (highscoreTableAdmin) {
        $(highscoreTableAdmin).DataTable({
            ajax: {
                url: 'ajax/highscores.php',
                type: 'POST',
                dataSrc: '',
                data: {
                    user: 'admin'
                },
            },
            columns: [
                {data: 'username', title: 'username'},
                {data: 'points', title: 'points'},
                {data: 'game_type', title: 'game type'},
                {data: 'game_level', title: 'game level'},
                {data: 'correct_answers', title: 'correct'},
                {data: 'incorrect_answers', title: 'incorrect'},
                {data: 'accuracy', title: 'accuracy'},
                {data: 'avg_time', title: 'avg ans time'},
                {data: 'fastest_answer', title: 'fastest answer'},
                {data: 'date_time', title: 'date time'}
            ],
            order: [9, 'desc'],
            scrollX: true,  // Enable horizontal scrolling
            pagingType: 'simple',
            columnDefs: [
                // Center align both header and body content for columns [...]
                { className: "dt-center", targets: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ] }
            ]
        });
    }

    // user tables - highscore table
    let highscoreTableUser = document.getElementById
    ('highscore-table-user');
    if (highscoreTableUser) {
        $(highscoreTableUser).DataTable({
            ajax: {
                url: 'ajax/highscores.php',
                type: 'POST',
                dataSrc: '',
                data: {
                    user: 'user'
                },
            },
            columns: [
                {data: 'username', title: 'username'},
                {data: 'points', title: 'points'},
                {data: 'game_type', title: 'game type'},
                {data: 'game_level', title: 'game level'},
                {data: 'correct_answers', title: 'correct'},
                {data: 'incorrect_answers', title: 'incorrect'},
                {data: 'accuracy', title: 'accuracy'},
                {data: 'avg_time', title: 'avg ans time'},
                {data: 'fastest_answer', title: 'fastest answer'},
                {data: 'date_time', title: 'date time'}
            ],
            order: [9, 'desc'],
            scrollX: true,  // Enable horizontal scrolling
            pagingType: 'simple',
            columnDefs: [
                // Center align both header and body content for columns [...]
                { className: "dt-center", targets: [ 0, 1, 2, 3, 4, 5, 6, 7, 8,9 ] }
            ]
        });
    }



    //autofocus input name for login modal
    $('#login-modal').on('shown.bs.modal', function(){
        $(this).find('#username').focus();
    });

    // confirm logout
    document.getElementById('button-logout').addEventListener('click', function (e) {
        const confirmLogout = confirm("Are you sure you want to log out?");
        if (confirmLogout) {
            window.location.href = 'logout.php';
        } else {
            e.preventDefault();
        }
    });

}

let validateFormLogin = () => {

    let isValid = true;
    const usernameLogin = document.getElementById('username');
    const passwordLogin = document.getElementById('password');

    if (isEmpty(usernameLogin.value.trim())) {
        showErrorMessage(usernameLogin, "Username cannot be empty.");
        isValid = false;
    } else if (!isOnlyNumsLetters(usernameLogin.value.trim())) {
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

const resetFields = (form) => {
    let errorFields = form.querySelectorAll('small');
    let inputFields = form.querySelectorAll('input');

    if (errorFields) {
        errorFields.forEach((element) => {
            element.innerText = '';
            element.classList.remove('error');
        });
    }

    if(inputFields) {
        inputFields.forEach((input) => {
            input.value = '';
        })
    }
};

