<?php 
    session_start();

    $title = '';
    $description = '';
    $id = '';
    
    if(isset($_GET['id'])){
        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        if(!$conn) {
            header('Location: page_500.php');
        }
        $id = $_GET['id'];
        $sql1 = "SELECT * FROM posts WHERE id='$id'";
        $result1 = mysqli_query($conn, $sql1);
    
        if(!$result1){
            echo "Błąd zapytania: " . mysqli_error($conn);
            exit(); 
        } else {
            $posts = mysqli_fetch_assoc($result1);
            $title = trim($posts['title']);
            $content = trim($posts['content']);
            $date = date('Y-m-d');
            $time = date("H:i:s");
            $datePlusTwo = date('Y-m-d', strtotime($date . ' +2 day'));
            $id = $posts['id'];
        }
    }
    
    if(isset($_POST['submit'])){
    
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if(empty(trim($content))) {
            $alerts[] = `Nie`;
            $alertsContent[] = `is-invalid`;
        }

        if(empty(trim($title))) {
            $alerts[] = `Nie`;
            $alertsTitle[] = `is-invalid`;
        }

        if(empty($alerts)) {
            $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
            if(!$conn) {
                header('Location: page_500.php');
            }
            $sql2 = "UPDATE posts SET title = '$title', content = '$content', isEdited = 'yes', published_data = '$date', dataPlusTwo = '$datePlusTwo', time = '$time' WHERE id= '$id'";
            $result2 = mysqli_query($conn, $sql2);
            header('Location: yourPosts.php');
            mysqli_close($conn);
        } else if(!empty($alertsTitle)) {
            $invalidTitle =  'is-invalid';
        } else if(!empty($alertsContent)) {
            $invalidContent =  'is-invalid';
        }
    }
?>

<!DOCTYPE html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Edytuj post</title>
        <link rel="stylesheet" href="../style/bootstrap.min.css">
        <link rel="stylesheet" href="../Style/font-awesome.min.css">
        <style>
            .infoError {
            letter-spacing: 2px;
            font-size: 13px;
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
                            echo "<a href='community.php' class='nav-link nav-item pr-3 active'>Społeczność</a>";
                        } else {
                            echo "<a href='index.php#myBlog' class='nav-link nav-item pr-3'>Społeczność</a>";
                        }
                    ?>
                    <a href="index.php#portfolio" class="nav-link nav-item pr-3">Moje portfolio</a>
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

    <div class="container my-5 text-center">
        <div class="col-12">
            <h2 class="display-4">Witaj, <?php
                if(isset($_SESSION['isLogin'])) {
                    echo $_SESSION['login'];
                }
             ?></h2>
             <span class="lead text-center">
                 Tutaj możesz pytać i <span class="text-warning">dzielić się</span> swoimi odczuciami.
             </span>
        </div>
    </div>

    <div class="container">
        <div class="row">
        <div class="col-md-3">
			<div class="list-group whatDo" id="list">
				<a href="yourPosts.php" class="list-group-item">Zobacz swoje posty</a>
			</div>				
		</div>
        <div class="col-12 col-md-7 mt-5 mt-md-0" id="addPost">
            <form method="POST" autocomplete="off">
            <div class="form-group">
                        <input type="text" name="title" value="<?php echo $title;?>" placeholder="Wpisz tytuł posta" class="form-control <?php echo $invalidTitle; ?>">
                        <?php 
                            if(!empty($alertsTitle)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            } else {
                                echo "";
                            }
                        ?>
                    </div>
                <div class="form-group text-left">
                    <textarea type="text" id="message" placeholder="Co u Ciebie słychać?" name="content" cols="30" rows="5" class="form-control <?php echo $invalidContent; ?>">
                        <?php echo trim($content);?>
                    </textarea>
                        <?php 
                            if(!empty($alertsContent)) {
                                echo "<span class='text-danger infoError'>Podano nieprawidłową wartość!</span>";
                            } else {
                                echo "";
                            }
                        ?>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-6 text-left">
                        <button type="submit" name="submit" class="btn btn-success px-3">Zapisz zmiany</button>
                    </div>
                    <div class="col-6 col-lg-6 text-right">
                        <a href="yourPosts.php" class="btn btn-danger px-3">Anuluj</a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>

    </body>
    <script src="../JS/jquery-3.6.0.slim.min.js"></script>
    <script src="../JS/bootstrap.bundle.min.js"></script>
</html>