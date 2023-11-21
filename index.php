<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans&family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <script src="/js/scripts.js"></script>
    <title>Speed Math Challenge</title>
</head>

<body>

<section id="section-one" class="d-flex align-items-center justify-content-center">
    <div>
        <img src="Speed_math_challenge_logo_crop.png" alt="speed_math_logo" width="125">
        <h2> Speed Math Challenge</h2>
    </div>
</section>

<section id="section-two" class="d-flex align-items-center justify-content-center">
    <div class="button-container">
        <!-- Button to trigger sign-up-modal -->
            <button id="button-sign-up" type="button" class="button-modal btn my-2 w-100" data-bs-toggle="modal" data-bs-target="#sign-up-modal">
                Sign up
            </button>

        <!-- Button to trigger login-modal -->
            <button id="button-login" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#login-modal">
                Log in
            </button>

        <!-- Button to trigger the info-modal -->
            <button id="button-info" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#info-modal">
                How to Play
            </button>

        <!-- Button to trigger high-scores-modal -->
            <button id="button-high-scores" type="button" class="button-modal btn my-2 w-100"  data-bs-toggle="modal" data-bs-target="#high-scores-modal">
                High-scores
            </button>
    </div>
</section>

<section id="section-three"> </section>

<!-- Sign up modal -->
<div class="modal fade" id="sign-up-modal" tabindex="-1" aria-labelledby="sign-up-modal-label" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sign-up-modal-label">Sign up</h5>
                <button id="close-modal-signup" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" method="POST" id="signup-form">
                    <div class="mb-3">
                        <label for="username-signup" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username-signup" name="username-signup" placeholder="Enter a username">
                        <small></small>
                    </div>

<!--                    <div class="mb-3">-->
<!--                        <label for="email-signup" class="form-label">Email</label>-->
<!--                        <input type="email" class="form-control" id="email-signup" name="email-signup" placeholder="Enter valid email address">-->
<!--                        <small></small>-->
<!--                    </div>-->

                    <div class="mb-3">
                        <label for="password-signup" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-signup" name="password-signup" placeholder="Enter a  password">
                        <small></small>
                    </div>

                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="action" value="signup">
                    <button type="submit" name="sb-signup" value="sb" class="button-modal btn mx-2">Submit</button>
                    <button type="reset" id="reset-signup" class="button-modal btn mx-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Log in modal -->
<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-modal-label" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login-modal-label"">Log in</h5>
                <button id="close-modal-login" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" method="POST" id="login-form">

<!--                    <div class="mb-3">-->
<!--                        <label for="email-login" class="form-label">Email</label>-->
<!--                        <input type="email" class="form-control" id="email-login" name="email-login" placeholder="Enter your email">-->
<!--                        <small></small>-->
<!--                    </div>-->

                    <div class="mb-3">
                        <label for="username-login" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username-login" name="username-login" placeholder="Enter your username">
                        <small></small>
                    </div>

                    <div class="mb-3">
                        <label for="password-login" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-login" name="password-login" placeholder="Enter your password">
                        <small></small>
                    </div>

                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="action" value="login">
                        <button type="submit" name="sb-login" value="sb" class="button-modal btn mx-2">Submit</button>
                        <button type="reset" id="reset-login" class="button-modal btn mx-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Info modal -->
<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="info-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">How to Play</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>How to play the game goes here</p>
            </div>
        </div>
    </div>
</div>

<!-- High-scores modal -->
<div class="modal fade" id="high-scores-modal" tabindex="-1" aria-labelledby="high-scores-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">High scores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Simple high score table goes here. limit options/scope of
                    information to make people signup and get more info.
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>

