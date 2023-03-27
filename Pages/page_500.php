<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Internal Server Error</title>
        <link rel="stylesheet" href="../Style/bootstrap.min.css">
        <style>
            body {
                background-color: #e2e2e2;
            }
            .myForm {
                width: 50%;
                margin: 0 auto;
                background-color: #FFFFFF;
                padding: 25px;
                border-radius: 5px;
                align-items: center;
                margin: auto;
            }
            .myLabel {
                letter-spacing: 2px;
                font-size: 12px;
            }
            .myLabelText {
                letter-spacing: 2px;
                font-size: 14.5px;
            }
            .infoError {
                letter-spacing: 2px;
                font-size: 13px;
            }
            .banner {
                font-size: 35px;
            }
            .boxForLog {
                box-shadow: 5px 5px 10px;
            }
            .desc {
                font-size: 28px;
            }
            .fc {
            margin-top: 5px;
            width: 10%;
            margin-left: 5px
        }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark p-3">
    <div class="col-6 col-md-9">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarContent">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-link nav-item pr-3">Start</a>
                    <?php 
                        if(isset($_SESSION['isLogin'])) {
                            echo "<a href='community.php' class='nav-link nav-item pr-3'>Społeczność</a>";
                        } else {
                            echo "<a href='index.php#myBlog' class='nav-link nav-item pr-3'>Społeczność</a>";
                        }
                    ?>
                    <a href="photos.php" class="nav-link nav-item pr-3">Moje portfolio</a>
                    <a href="index.php#formTag" class="nav-link nav-item pr-3">Kontakt</a>
                </div>
            </div>
        </div>
        </div>
        <div class="col-6 col-md-2">
           <div class="container">
           <div class="dropdown">
                <a class="dropdown-toggle nav-link nav-item text-muted text-white mr-5" type="button" data-toggle="dropdown">
                Twoje konto
                </a>
                <div class="dropdown-menu">
                    <a href="signIn.php" class="dropdown-item">Logowanie</a>
                    <a href="signUp.php" class="dropdown-item">Rejestracja</a>
                </div>
            </div>
           </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="myForm col-10 col-lg-6 my-5 boxForLog text-center">
                <div class="container">
                <svg xmlns="http://www.w3.org/2000/svg" class="fc mb-3" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM99.5 144.8C77.15 176.1 64 214.5 64 256C64 362 149.1 448 256 448C297.5 448 335.9 434.9 367.2 412.5L99.5 144.8zM448 256C448 149.1 362 64 256 64C214.5 64 176.1 77.15 144.8 99.5L412.5 367.2C434.9 335.9 448 297.5 448 256V256z"/></svg>
                </div>
                <div class="container">
                    <span class="lead desc">Internal <span class="text-info">Server</span> Error</span><br>
                </div>
                <div class="container mt-3">
                    <span class="lead">Wystąpił wewnętrzny problem podczas połączenia z serwerem! Spróbuj ponownie później.
                    W tym czasie <span class="text-danger"><b>niemożliwe</b></span> jest korzystanie ze swojego konta i funkcji wysyłania zapytań.</span>
                </div>
                <div class="container mt-3">
                        <span class="lead">Przepraszamy za utrudnienia!</span>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script src="../JS/jquery-3.6.0.slim.min.js"></script>
    <script src="../JS/bootstrap.bundle.min.js"></script>
    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
</html>