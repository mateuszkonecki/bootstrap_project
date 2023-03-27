<?php 
    session_start();
    error_reporting(0);
    $alerts[] = "";

    if(isset($_SESSION['isLogin'])) {
        header('Location: index.php');
    }

    if(isset($_POST['submit'])) {
        $login = $_POST['login'];
        $pass = $_POST['password'];

        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $sql = "SELECT login, password FROM users WHERE login = '$login'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        
        if($user['login'] == $login) {
            if(password_verify($pass, $user['password'])) {
                $_SESSION['isLogin'] = true;
                foreach($user as $item){
                    $_SESSION['login'] = $login;
                }
                header('Location: index.php');
            } else {
                if(empty(trim($pass)) || !password_verify($pass, $user['password'])) {
                    $alerts[] = `Nie`;
                    $alertsPass[] = `is-invalid`;
                }
                if(empty(trim($login))) {
                    $alerts[] = `Nie`;
                    $alertsLogin[] = `is-invalid`;
                }

                if(!empty($alertsLogin)) {
                    $invalidLogin =  'is-invalid';
                }
                if(!empty($alertsPass)) {
                    $invalidPass =  'is-invalid';
                }
            }
        } else {
            $invalidLogin = 'is-invalid';
            $alertsLogin[] = `is-invalid`;
        }
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Zaloguj się</title>
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
            <div class="myForm col-10 col-lg-6 my-5 boxForLog">
                <h3 class="lead p-5 text-center banner"><span class="text-info">Zaloguj</span> się</h3>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Login:</label>
                        <input type="text" placeholder="Wpisz login" name="login" class="form-control <?php echo $invalidLogin; ?>">
                        <?php 
                            if(!empty($alertsLogin)) {
                                echo "<span class='text-danger infoError'>Niepoprawny login!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Hasło:</label>
                        <input type="password" placeholder="Wpisz hasło" name="password" class="form-control <?php echo $invalidPass; ?>">
                        <?php 
                            if(!empty($alertsPass)) {
                                echo "<span class='text-danger infoError'>Niepoprawne hasło!</span>";
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8 text-center text-lg-left mt-3">
                            <button type="submit" name="submit" class="btn btn-success px-3">Zaloguj się</button>
                        </div>
                        <div class="col-12 col-lg-4 mt-3 mt-lg-2 text-center text-lg-left">
                            <span class="text-success myLabel">Nie masz konta?</span><br>
                            <a href="signUp.php" class="text-danger myLabelText">Zarejestruj się</a>
                        </div>
                    </div>
                </form>
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