<?php 
    session_start();

    // Zmiana danych osobowych

        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $author = $_SESSION['login'];
        $sql1 = "SELECT * FROM users WHERE login ='$author'";
        $result1 = mysqli_query($conn, $sql1);
    
        if(!$result1){
            echo "Błąd zapytania: " . mysqli_error($conn);
            exit(); 
        } else {
            $user = mysqli_fetch_assoc($result1);
            $name = $user['name'];
            $lastName = $user['lastName'];
            $email = $user['email'];
            $id = $user['id'];
        }
    
    if(isset($_POST['submitData'])){
    
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];

        if(empty(trim($name))) {
            $alerts[] = `Nie`;
            $alertsName[] = `is-invalid`;
        }

        if(empty(trim($lastName))) {
            $alerts[] = `Nie`;
            $alertsLastName[] = `is-invalid`;
        }

        if(empty($alerts)) {
            $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
            if(!$conn) {
                header('Location: page_500.php');
            }
            $sql2 = "UPDATE users SET name = '$name', lastName = '$lastName' WHERE login= '$author'";
            $result2 = mysqli_query($conn, $sql2);
            mysqli_close($conn);
        } else if(!empty($alertsName)) {
            $invalidName =  'is-invalid';
        } else if(!empty($alertsLastName)) {
            $invalidLastName =  'is-invalid';
        }
    }

    //Zmiana hasła

    if(isset($_POST['submitPass'])){

        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $author = $_SESSION['login'];
        $sql2 = "SELECT * FROM users WHERE login ='$author'";
        $result2 = mysqli_query($conn, $sql2);
    
        if(!$result2){
            echo "Błąd zapytania: " . mysqli_error($conn);
            exit(); 
        } else {
            $user = mysqli_fetch_assoc($result2);
            $password = $user['password'];
            $id = $user['id'];
        }

        $current = $_POST['currently'];
        $new = $_POST['new'];
        $newAgain = $_POST['newAgain'];

        if(empty(trim($new))) {
            $alerts[] = `Nie`;
            $alertsNew[] = `is-invalid`;
        }

        if(strlen($new) <= 8) {
            $alerts[] = `Nie`;
            $alertsNewTooShort[] = `is-invalid`;
        }

        if(empty(trim($newAgain))) {
            $alerts[] = `Nie`;
            $alertsNewAgain[] = `is-invalid`;
        }

        if($new != $newAgain) {
            $alerts[] = `Nie`;
            $alertsNewAgain[] = `is-invalid`;
        }

        if(password_verify($current, $password)) {
            if(empty($alerts)) {
                $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
                if(!$conn) {
                    header('Location: page_500.php');
                }
                $hash = password_hash($new, PASSWORD_DEFAULT);
                $sql3 = "UPDATE users SET password = '$hash' WHERE login = '$author'";
                $result3 = mysqli_query($conn, $sql3);
                mysqli_close($conn);
            } else if(!empty($alertsNew)) {
                $invalidNew = 'is-invalid';
            } else if(!empty($alertsNewSame)) {
                $invalidNew = 'is-invalid';
            } else if(!empty($alertsNewAgain)) {
                $invalidNewAgain = 'is-invalid';
            } else if(!empty($alertsNewTooShort)) {
                $invalidNewTooShort =  'is-invalid';
            }
        } else {
            $alerts[] = `Nie`;
            $alertsCurrunt[] = `is-invalid`;

            if(!empty($alertsCurrunt)) {
                $invalidCurrent = 'is-invalid';
            }
        }
    }

    //Usuwanie konta

    if(isset($_POST['submitDelete'])){
        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $author = $_SESSION['login'];
        $sql4 = "DELETE FROM users WHERE login = '$author'";
        $result4 = mysqli_query($conn, $sql4);
        mysqli_close($conn);
        header('Location: signIn.php');
    }
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twój profil</title>
        <link rel="stylesheet" href="../style/bootstrap.min.css">
        <link rel="stylesheet" href="../Style/font-awesome.min.css">
        <style>
            .headerData {
                font-size: 22px;
            }
            .field {
                width: 50%;
                margin: 0 auto;
                background-color: #F1EEEE;
                padding: 25px;
                border-radius: 5px
            }
            .advice {
                font-size: 16px;
            }
            .fc, .ig {
            margin-top: 5px;
            width: 5%;
            margin-left: 5px
            }
            .infoError {
                letter-spacing: 2px;
                font-size: 13px;
            }
            .imgLock {
                width: 5.5%;
                height: 5.5%;
                margin-left: 0.85rem;
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
                <a class="dropdown-toggle nav-link nav-item text-muted text-right" type="button" data-toggle="dropdown">
                Twoje konto
                </a>
                <div class="dropdown-menu">
                <?php 
                    if(isset($_SESSION['isLogin'])) {
                        echo "<a href='signOut.php' class='dropdown-item'>Wyloguj się</a>";
                    } else {
                        echo "<a href='signIn.php' class='dropdown-item'>Logowanie</a>";
                    }
                ?>
                <?php 
                    if(!isset($_SESSION['isLogin'])) {
                        echo "<a href='signUp.php' class='dropdown-item'>Rejestracja</a>";
                    }
                ?>
                </div>
            </div>
           </div>
        </div>
</nav> 

<div class="container">
            <div class="row">
            <div class="mt-5 col-12 col-lg-4">
				<div class="container">
                <div class="list-group" id="list">
					<a href="#item1" class="list-group-item">Moje dane</a>
					<a href="#item2" class="list-group-item">Zmień hasło</a>
                    <a href="#item2" class="list-group-item">Usuń konto</a>
				</div>
                </div>				
			</div>
            <div class="col-lg-6" id="item1">
                <div class="container mt-5 border rounded p-5">
                    <div class="mb-3 text-center text-md-left">
                        <span class="text-danger headerData">Moje dane</span>
                    </div>
                    <?php 
                        if(isset($_POST['submitData']) && empty($alerts)) {
                            echo "
                            <div class='alert alert-success' role='alert'>
                                Poprawnie zaktualizowano dane!
                                <button type='button' class='close' data-dismiss='alert'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            ";
                        }
                    ?>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Imię:</label>
                        <input type="text" value="<?php echo trim($name); ?>" name="name" class="form-control <?php echo $invalidName; ?>">
                        <?php 
                            if(!empty($alertsName)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Nazwisko:</label>
                        <input type="text" value="<?php echo trim($lastName); ?>" name="lastName" class="form-control <?php echo $invalidLastName; ?>">
                        <?php 
                            if(!empty($alertsLastName)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <span class="d-flex flex-md-rows">
                        <input type="email" value="<?php echo trim($email); ?>" name="email" class="form-control <?php echo $invalidEmail; ?>" disabled>
                        <?php 
                            if(!empty($alertsEmail)) {
                                echo "<span class='text-danger infoError'>Podany adres e-mail jest już zapisany w bazie!</span>";
                            }
                        ?>
                        </span>
                    </div>
                    <div class="row mt-4">
                    <div class="col-6 col-lg-6 text-left">
                        <button type="submit" name="submitData" class="btn btn-success px-3 mt-2">Zapisz zmiany</button>
                    </div>
                </div>
                </form>
                </div>
            </div>
            
            </div>
            <div class="row mb-5">
            <div class="col-md-4">
				<div class="container d-none">
                <div class="list-group" id="list">
					<a href="#item2" class="list-group-item">Moje dane</a>
					<a href="#item3" class="list-group-item">Zmień hasło</a>
				</div>
                </div>				
			</div>
            <div class="col-lg-6" id="item2">
                <div class="container mt-5 border rounded p-5">
                    <div class="mb-3 text-center text-md-left">
                        <span class="text-warning headerData">Zmień hasło</span>
                    </div>
                    <?php 
                        if(isset($_POST['submitPass']) && empty($alerts)) {
                            echo "
                            <div class='alert alert-success' role='alert'>
                                Poprawnie zmieniono hasło!
                                <button type='button' class='close' data-dismiss='alert'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            ";
                        }
                    ?>
                <form method="POST" autocomplete="off">
                <div class="form-group">
                        <label>Aktualne hasło:</label>
                        <input type="password" placeholder="Podaj obecne hasło" name="currently" class="form-control <?php echo $invalidCurrent; ?>">
                        <?php 
                            if(!empty($alertsCurrunt)) {
                                echo "<span class='text-danger infoError'>Podane hasło jest nieprawidłowe!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Nowe hasło:</label>
                        <input type="password" placeholder="Podaj nowe hasło" name="new" class="form-control <?php echo $invalidNew; ?>">
                        <?php 
                            if(!empty($alertsNewTooShort)) {
                                echo "<span class='text-danger infoError'>Hasło musi mieć min. 9 znaków!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Powtórz nowe hasło:</label>
                        <input type="password" placeholder="Powtórz nowe hasło" name="newAgain" class="form-control <?php echo $invalidNewAgain; ?>">
                        <?php 
                            if(!empty($alertsNewAgain)) {
                                echo "<span class='text-danger infoError'>Podane hasła nie są zgodne</span>";
                            }
                        ?>
                    </div>
                    <div class="row mt-4">
                    <div class="col-6 col-lg-6 text-left">
                        <button type="submit" name="submitPass" class="btn btn-success px-3 mt-2">Zmień hasło</button>
                    </div>
                </div>
                </form>
                </div>
            </div>

            <div class="col-12 col-lg-4">
				<div class="container d-none">
                <div class="list-group" id="list">
					<a href="#item1" class="list-group-item">Moje dane</a>
					<a href="#item2" class="list-group-item">Zmień hasło</a>
                    <a href="#item2" class="list-group-item">Usuń konto</a>
				</div>
                </div>				
			</div>
            <div class="col-lg-6" id="item3">
                <div class="container mt-5 border rounded p-5">
                    <div class="mb-3 text-left">
                        <span class="text-info headerData">Usuń konto</span>
                    </div>
                    <form method="post">
                        <button class="btn btn-danger mt-2" type="button" data-toggle="modal" data-target="#myModal">
                            Usuń konto
                        </button>
                        <div class="modal col-12 text-center text-md-left" tabindex="-1" role="dialog" id="myModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header p-4">
                                        <h4 class="modal-title lead"><b>Czy na pewno<span class="text-danger"> chcesz usunąć</span> konto?</b></h4>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <p class="lead">Ta operacja jest nieodwracalna!</p>
                                        <button type="submit" name="submitDelete" class="btn btn-info px-3 mt-1">Usuń konto</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<div class="text-center bg-dark text-white p-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 text-lg-left">
                <div id="paragraph-1" class="lead"></div>
            </div>
            <div class="col-12 col-lg-6 text-lg-right">
                <a href="https://www.facebook.com/mateusz.konecki.520/"><svg class="fc" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"/></svg></a>
                <a href="https://www.instagram.com/_matuseq/"><svg class="ig"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z"/></svg></a>
            </div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="../JS/jquery-3.6.0.slim.min.js"></script>
<script src="../JS/bootstrap.bundle.min.js"></script>
<script>
    const par1 = document.querySelector("#paragraph-1");
    function getCurrentYear() {
        const currentYear = new Date();
        const y = currentYear.getFullYear();
        const str = `
                <span class="text-warning">&copy; ${y}</span> Mateusz Konecki
            `;
        par1.innerHTML = str;
    }
    getCurrentYear();
</script>
</html>