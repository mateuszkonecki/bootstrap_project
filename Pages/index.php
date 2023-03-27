<?php 
    session_start();
    $alerts = [];

    if(isset($_POST['submitRequest'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        if(empty(trim($name))) {
            $alerts[] = `Nie`;
            $alertsName[] = `is-invalid`;
        }

        if(empty(trim($email))) {
            $alerts[] = `Nie`;
            $alertsEmail[] = `is-invalid`;
        }

        if(empty(trim($title))) {
            $alerts[] = `Nie`;
            $alertsTitle[] = `is-invalid`;
        }

        if(empty(trim($content))) {
            $alerts[] = `Nie`;
            $alertsContent[] = `is-invalid`;
        }
        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        if(empty($alerts)) {
            $sql = "INSERT INTO questions VALUES (NULL, '$name', '$email', '$title', '$content')";
            $result = mysqli_query($conn, $sql);
            header('Location: index.php#formTag');
        } else if(!empty($alertsName)) {
            $invalidName =  'is-invalid';
        } else if(!empty($alertsEmail)) {
            $invalidEmail =  'is-invalid';
        } else if(!empty($alertsTitle)) {
            $invalidTitle =  'is-invalid';
        } else if(!empty($alertsContent)) {
            $invalidContent =  'is-invalid';
        }
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/font-awesome.min.css">
    <style>
        .myForm {
            width: 50%;
            margin: 0 auto;
            background-color: #F1EEEE;
            padding: 25px;
            border-radius: 5px;
        }
        .formLabel {
            letter-spacing: 2px;
            font-size: 14px;
            margin-bottom: 20px
        }
        .formLabel .header{
            letter-spacing: 5px;
            font-size: 20px
        }
        .infoError {
            letter-spacing: 2px;
            font-size: 13px;
        }
        #formTag {
            background-color: #F1EEEE;
            clear: both;
        }
        .designed {
            font-size: 16px
        }
        .fc, .ig{
            margin-top: 5px;
            width: 5%;
            margin-left: 5px
        }
        .subtitleCard {
            font-size: 15px;
            letter-spacing: 2px;
            margin-bottom: 15px
        }
        .cardStyle {
            width: 50%;
            float: left;
        }
        .blog {
            background-image: url(../Photos/blog.jpg);
            background-repeat: no-repeat;
            background-position: cover;
        }
        </style>
    <title>Strona główna</title>
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
                    <a href="index.php" class="nav-link nav-item pr-3 active">Start</a>
                    <?php 
                        if(isset($_SESSION['isLogin'])) {
                            echo "<a href='community.php' class='nav-link nav-item pr-3'>Społeczność</a>";
                        } else {
                            echo "<a href='index.php#myBlog' class='nav-link nav-item pr-3'>Społeczność</a>";
                        }
                    ?>
                    <a href="#portfolio" class="nav-link nav-item pr-3">Moje portfolio</a>
                    <a href="#formTag" class="nav-link nav-item pr-3">Kontakt</a>
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
                    if(isset($_SESSION['isLogin'])) {
                        echo "<a href='profil.php' class='dropdown-item'>Twój profil</a>";
                    } else {
                        echo "<a href='signUp.php' class='dropdown-item'>Rejestracja</a>";
                    }
                ?>
                </div>
            </div>
           </div>
        </div>
</nav>

<div class="mb-5">
        <div class="conatiner m-5">
            <div class="text-center">
                <h4 class="display-4 mb-5">O mnie</h4>
            </div>
        </div>
        <div class="container mb-4">
            <blockquote class="blockquote lead text-center">
                <i>"Sukces polega na przechodzeniu od porażki do porażki bez utraty entuzjazmu"</i>
                <div class="blockquote-footer lead mt-2 mt-md-1">Winston Churchill</div>
            </blockquote>
        </div>
        <hr class="col-10 col-md-7">
        <div class="container mt-4">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5">
                    <div class="container rounded p-3">
                        <img src="../Photos/na_profil.jpeg" alt="Moje zdjecie" class="img img-fluid rounded">
                    </div>
                </div>
                <div class="col-12 col-lg-7 mt-4 mt-md-0">
                    <div class="container">
                        <div class="lead my-3 my-md-5"><span class="text-warning"><b>></b></span> Uczeń Technikum Programistycznego</div>
                        <div class="lead my-3 my-md-5"><span class="text-warning"><b>></b></span> Wiąże moją przyszłość z programowaniem mobilnym</div>
                        <div class="lead my-3 my-md-5"><span class="text-warning"><b>></b></span> Chętnie uprawiam sport, szczególnie siatkówkę</div>
                        <div class="lead my-3 my-md-5"><span class="text-warning"><b>></b></span> W wolnym czasie lubię tworzyć strony internetowe</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="myBlog">
    <div class="jumbotron jumbotron-fluid text-white blog text-center my-5">
        <div class="container text-left text-md-center">
            <h2 class="display-4 mb-4 mb-lg-3">Stań się <span class="text-warning">częścią</span> społeczności</h2>
            <span class="lead mb-2">Chcesz podzielić się Twoimi przemyśleniami? Zapytać o ważną dla Ciebie rzecz?</span>
        </div>
        <div class="container text-left text-md-center mt-3 mt-md-0 mt-lg-0">
            <p class="lead"><span class="text-warning text-uppercase">Dołącz</span> i po prostu rozmawiaj!</p>
        </div>
        <div class="container text-left text-md-center mt-3 mt-md-0 mt-lg-0">
            <?php 
                if(isset($_SESSION['isLogin'])) {
                    echo "<a href='community.php' class='btn btn-outline-info text-white'>Przejdź do Społeczności</a>";
                } else {
                    echo "<a href='community.php' class='btn btn-outline-info text-white'>Dołącz do społeczności</a>";
                }
            ?>
        </div>
    </div>
</div>

<div id="portfolio">
    <div class="container">
        <h2 class="text-center display-4">Galeria zdjęć</h2>
        <div class="row my-5">
            <div class="col-12 col-md-6">
                <div class="card">
                    <img src="../Photos/zachod.jpeg" alt="Detale" class="img-fluid">
                    <div class="card-body">
                        <h4 class="card-title">Zachód słońca</h4>
                        <h5 class="card-subtitle text-success subtitleCard">Natura</h5>
                        <p>Pięknie uchwycony, <br>wiosenny zachód słońca nad jeziorem.</p>
                        <a href="photos.php" class="btn btn-danger card-link">Zobacz więcej zdjęć z <b class="text-warning">Natura</b></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <div class="card">
                    <img src="../Photos/detal.jpg" alt="Detale" class="img-fluid">
                    <div class="card-body">
                        <h4 class="card-title">Wiosenny deszcz</h4>
                        <h5 class="card-subtitle text-info subtitleCard">Detale</h5>
                        <p>Krystalicznie czyste krople <br> deszczu utrzymujące się na liściu.</p>
                        <a href="photos.php#details" class="btn btn-danger card-link">Zobacz więcej zdjęć z <b class="text-warning">Detale</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="formTag">
    <div class="container mb-0">
        <div class="row align-items-center">
            <div class="myForm col-10 col-lg-6 my-3">
                <div class="formLabel">
                    <span class="text-uppercase text-success">Masz pytanie?</span>
                    <h2 class="text-uppercase text-danger header">Skontaktuj się ze mną</h2>
                </div>
                <?php 
                        if(isset($_POST['submitRequest']) && empty($alerts)) {
                            echo `
                            <div class='alert alert-success' role='alert'>
                                <b>Dziękuję za wysłanie wiadomości!</b> <br> Postaram się odpowiedzieć najszybciej, jak będzie to możliwe.
                                <button type='button' class='close' data-dismiss='alert'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            `;
                        }
                    ?>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Imię:</label>
                        <input type="text" name="name" class="form-control <?php echo $invalidName; ?>">
                        <?php 
                            if(!empty($alertsName)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Adres e-mail:</label>
                        <input type="email" name="email" class="form-control <?php echo $invalidEmail; ?>">
                        <?php 
                            if(!empty($alertsEmail)) {
                                echo "<span class='text-danger infoError'>Nieprawidłowy format adresu!</span>";
                            } else {
                                echo "";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Tytuł wiadomości:</label>
                        <input type="text" name="title" class="form-control <?php echo $invalidTitle; ?>">
                        <?php 
                            if(!empty($alertsTitle)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            } else {
                                echo "";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-control-label">Treść:</label>
                        <textarea type="text" id="message" name="content" cols="30" rows="5" class="form-control <?php echo $invalidContent; ?>"></textarea>
                        <?php 
                            if(!empty($alertsContent)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            } else {
                                echo "";
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8 text-center text-lg-left mt-2">
                            <button type="submit" name="submitRequest" class="btn btn-success px-3">Wyślij zapytanie</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex">
                <div class="container border rounded p-3 ml-5">
                    <img src="../Photos/ask.jpg" class="img img-fluid rounded d-none d-lg-block">
                </div>
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