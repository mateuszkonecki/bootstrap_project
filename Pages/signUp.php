<?php 
    error_reporting(0);
    $alerts = [];

    if(isset($_SESSION['isLogin'])) {
        header('Location: index.php');
    }

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if(empty(trim($name))) {
            $alerts[] = `Nie`;
            $alertsName[] = `is-invalid`;
        }

        if(is_numeric($name)) {
            $alerts[] = `Nie`;
            $alertsNameNotString[] = `is-invalid`;
        }
        
        if(empty(trim($lastName))) {
            $alerts[] = `Nie`;
            $alertsLastName[] = `is-invalid`;
        }

        if(is_numeric($lastName)) {
            $alerts[] = `Nie`;
            $alertsLastNameNotString[] = `is-invalid`;
        }

        if(empty(trim($email))) {
            $alerts[] = `Nie`;
            $alertsEmail[] = `is-invalid`;
        }

        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $sql = "SELECT email FROM users";
        $result = mysqli_query($conn, $sql);
        $emails = mysqli_fetch_assoc($result);

        if($emails['email'] == $email) {
            $alerts[] = `Nie`;
            $alertsEmailUsed[] = `is-invalid`;
        }
        mysqli_close($conn);

        if(empty(trim($login))) {
            $alerts[] = `Nie`;
            $alertsLoginEmpty[] = `is-invalid`;
        }

        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $sql = "SELECT login FROM users";
        $result = mysqli_query($conn, $sql);
        $logins = mysqli_fetch_assoc($result);

        if($logins['login'] == $login) {
            $alerts[] = `Nie`;
            $alertsLoginUsed[] = `is-invalid`;
        }
        mysqli_close($conn);

        if(empty(trim($pass))) {
            $alerts[] = `Nie`;
            $alertsPass[] = `is-invalid`;
        }

        if($pass !== $pass2) {
            $alerts[] = `Nie`;
            $alertsPassAgain[] = `is-invalid`;
        }
        
        if (strlen($pass) <= 8) {
            $alerts[] = `Nie`;
            $alertsPassTooShort[] = `is-invalid`;
        }

        if(empty($alerts)) {
            $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
            if(!$conn) {
                header('Location: page_500.php');
            }
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users VALUES (NULL, '$name', '$lastName', '$email', '$login', '$hash')";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
        } else if(!empty($alertsName)) {
            $invalidName =  'is-invalid';
        } else if(!empty($alertsNameNotString)) {
            $invalidName =  'is-invalid';
        } else if(!empty($alertsLastNameNotString)) {
            $invalidLastName =  'is-invalid';
        } else if(!empty($alertsLastName)) {
            $invalidLastName =  'is-invalid';
        } else if(!empty($alertsEmail)) {
            $invalidEmail =  'is-invalid';
        } else if(!empty($alertsEmailUsed)) {
            $invalidEmailEmpty =  'is-invalid';
            $invalidEmailUsed =  'is-invalid';
        } else if(!empty($alertsLoginEmpty)) {
            $invalidLoginEmpty =  'is-invalid';
        } else if(!empty($alertsLoginUsed)) {
            $invalidLoginEmpty =  'is-invalid';
            $invalidLoginUsed =  'is-invalid';
        } else if(!empty($alertsPass)) {
            $invalidPass =  'is-invalid';
        } else if(!empty($alertsPassTooShort)) {
            $invalidPassTooShort =  'is-invalid';
        } else if(!empty($alertsPassAgain)) {
            $invalidPassAgain =  'is-invalid';
        }
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Zarejestruj się</title>
        <link rel="stylesheet" href="../Style/bootstrap.min.css">

        <style>
            body {
                background-color: #e2e2e2;
                overflow-x: hidden;
            }
            .myForm {
                width: 50%;
                margin: 0 auto;
                background-color: #FFFFFF;
                padding: 25px;
                border-radius: 5px
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
            .boxForRegister {
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

    <div class="container mt-md-4">
        <div class="row">
            <div class="myForm col-10 col-lg-6 mb-5 mt-5 boxForRegister">
            <h3 class="lead p-5 text-center banner"><span class="text-info">Zarejestruj</span> się</h3>
            <?php 
                if(isset($_POST['submit']) && empty($alerts)) {
                    echo "
                    <div class='alert alert-success mb-5' role='alert'>
                        Poprawnie zarejestrowano konto!
                        <button type='button' class='close' data-dismiss='alert'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    ";
                }
            ?>
                <form method="POST" autocomplete="off">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Imię:</label>
                                <input type="text" placeholder="Wpisz imię" name="name" class="form-control <?php echo $invalidName; ?>">
                                <?php 
                                    if(!empty($alertsNameNotString)) {
                                        echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nazwisko:</label>
                                <input type="text" placeholder="Wpisz nazwisko" name="lastName" class="form-control <?php echo $invalidLastName; ?>">
                                <?php 
                                    if(!empty($alertsLastNameNotString)) {
                                    echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                        <div class="form-group">
                                <label>E-mail:</label>
                                <input type="email" placeholder="Wpisz adres e-mail" name="email" class="form-control <?php echo $invalidEmail; ?>">
                                <?php 
                                    if(!empty($alertsEmailUsed)) {
                                        echo "<span class='text-danger infoError'>Podany adres e-mail jest już zapisany w bazie!</span>";
                                    } else if(!empty($alertsEmail)) {
                                        echo "<span class='text-danger infoError'>Niepoprawny email!</span>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="form-group">
                                <label>Login:</label>
                                <input type="text" placeholder="Wpisz login" name="login" class="form-control <?php echo $invalidLoginEmpty; ?>">
                                <?php 
                                    if(!empty($alertsLoginUsed)) {
                                    echo "<span class='text-danger infoError'>Podany login jest już zajęty!</span>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hasło:</label>
                        <input type="password" placeholder="Wpisz hasło" name="pass" class="form-control <?php echo $invalidPass; ?>">
                        <?php 
                            if(!empty($alertsPassTooShort)) {
                                echo "<span class='text-danger infoError'>Hasło musi mieć min. 9 znaków!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Powtórz hasło:</label>
                        <input type="password" placeholder="Powtórz hasło" name="pass2" class="form-control <?php echo $invalidPassAgain; ?>">
                        <?php 
                            if(!empty($alertsPassAgain)) {
                                echo "<span class='text-danger infoError'>Podane hasła nie są takie same!</span>";
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8 text-center text-lg-left mt-3">
                            <button type="submit" name="submit" class="btn btn-success px-3">Zarejestruj się</button>
                        </div>
                        <div class="col-12 col-lg-4 mt-3 mt-lg-2 text-center text-lg-left">
                            <span class="text-success myLabel">Masz już konto?</span><br>
                            <a href="signIn.php" class="text-danger myLabelText">Zaloguj się</a>
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
</script>
</html>