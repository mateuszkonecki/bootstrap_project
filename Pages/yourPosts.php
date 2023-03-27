<?php 
    session_start();
    if(!isset($_SESSION['isLogin'])) {
        header('Location: signIn.php');
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/font-awesome.min.css">
    <style>
        .subtitleCard {
            font-size: 15px;
            letter-spacing: 2px;
            margin-bottom: 20px
        }
        .add {
            margin-top: 8.5px;
        }
        .fc {
            margin-top: 5px;
            width: 10%;
            margin-left: 5px
        }
    </style>
    <title>Twoje posty</title>
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
                            echo "<a href='index.php#myBlog' class='nav-link nav-item pr-3 active'>Społeczność</a>";
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
    <h2 class='text-center display-4 mt-5 mb-5'>Twoje posty</h2>
    <?php 
        $author = $_SESSION['login'];
        $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
        $sql = "SELECT * FROM posts WHERE author = '$author' ORDER BY published_date DESC, isEdited ASC, time DESC";
        $result = mysqli_query($conn, $sql);

        if(!$conn) {
            header('Location: page_500.php');
        }

        while($row = mysqli_fetch_array($result)) {
                $titleCard = $row['title'];
                $dateCard = $row['published_date'];
                $datePlusOne = $row['dataPlusTwo']; 
                $contentCard = $row['content'];
                $edited = $row['isEdited'];
                $id = $row['id'];

                $data = explode('-', $dateCard);
                $data2 = $dateCard;
                $dzien = date('N', strtotime($data2));
                $dni_tygodnia = array('poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota', 'niedziela');
 
                switch($data[1]) {
                    case '01':
                        $miesiac = 'stycznia';
                        break;
                    case '02':
                        $miesiac = 'lutego';
                        break;
                    case '03':
                        $miesiac = 'marca';
                        break;
                    case '04':
                        $miesiac = 'kwietnia';
                        break;
                    case '05':
                        $miesiac = 'maja';
                        break;
                    case '06':
                        $miesiac = 'czerwca';
                        break;
                    case '07':
                        $miesiac = 'lipca';
                        break;
                    case '08':
                        $miesiac = 'sierpnia';
                        break;
                    case '09':
                        $miesiac = 'września';
                        break;
                    case '10':
                        $miesiac = 'października';
                        break;
                    case '11':
                        $miesiac = 'listopada';
                        break;
                    case '12':
                        $miesiac='grudnia';
                        break;
                }
                $dateReady =  $dni_tygodnia[$dzien-1] . ', ' . $data[2] . ' ' . $miesiac . ' ' . $data[0];
    
                if(date('Y-m-d') >= $datePlusOne) {
                    if($edited == "no") {
                        echo "
                        <div class='container'>
                            <div class='row'>
                                <div class='col-12 col-lg-12'>
                                    <div class='card mt-4'>
                                        <div class='card-body'>
                                            <div class='row'>
                                                <div class='container col-12 col-md-9'>
                                                    <h4 class='card-title mb-3'>$titleCard <span class='badge badge-danger'>Starszy</span></h4>
                                                    <h5 class='card-subtitle text-muted subtitleCard'>$dateReady</h5>
                                                    <p>$contentCard</p>
                                                </div>
                                                <div class='col-12 col-md-3 d-flex flex-rows flex-md-column text-center text-md-right mt-2 my-md-auto'>
                                                    <a href='edit.php?id=$id'><svg class='fc mb-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z'/></svg></a>
                                                    <a href='delete.php?id=$id'><svg class='fc mt-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z'/></svg></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                if(date('Y-m-d') < $datePlusOne) {
                    if($edited == "no") {
                        echo "
                        <div class='container'>
                            <div class='row'>
                                <div class='col-12 col-lg-12'>
                                    <div class='card mt-3'>
                                        <div class='card-body'>
                                            <div class='row'>
                                                <div class='container col-12 col-md-9'>
                                                    <h4 class='card-title mb-3'>$titleCard <span class='badge badge-success'>Nowy</span></h4>
                                                    <h5 class='card-subtitle text-muted subtitleCard'>$dateReady</h5>
                                                    <p>$contentCard</p>
                                                </div>
                                                <div class='col-12 col-md-3 d-flex flex-rows flex-md-column text-center text-md-right mt-2 my-md-auto'>
                                                    <a href='edit.php?id=$id'><svg class='fc mb-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z'/></svg></a>
                                                    <a href='delete.php?id=$id'><svg class='fc mt-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z'/></svg></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                if(date('Y-m-d') <= $datePlusOne) {
                    if($edited == "yes") {
                        echo "
                        <div class='container'>
                            <div class='row'>
                                <div class='col-12 col-lg-12'>
                                    <div class='card mt-4'>
                                        <div class='card-body'>
                                            <div class='row'>
                                                <div class='container col-12 col-md-9'>
                                                    <h4 class='card-title mb-3'>$titleCard <span class='badge badge-warning'>Edytowany</span></h4>
                                                    <h5 class='card-subtitle text-muted subtitleCard'>$dateReady</h5>
                                                    <p>$contentCard</p>
                                                </div>
                                                <div class='col-12 col-md-3 d-flex flex-rows flex-md-column text-center text-md-right mt-2 my-md-auto'>
                                                    <a href='edit.php?id=$id'><svg class='fc mb-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z'/></svg></a>
                                                    <a href='delete.php?id=$id'><svg class='fc mt-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z'/></svg></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
            }

            if(mysqli_num_rows($result) > 0) {
                echo "<div class='container text-center mb-5'>
                    <a href='community.php'><i class='fa fa-plus border rounded py-2 px-3 bg-dark text-light add mt-4'></i></a>
                  </div>";
            } else if(mysqli_num_rows($result) == 0) {
                echo "";
            }

            if(mysqli_num_rows($result) == 0) {
                echo "
            <div class='container'>
            <div class='row my-4'>
            <div class='col-12'>
            <div class='container text-center'>
                <span class='text-danger lead'>Nie opublikowałeś jeszcze żadnych postów!</span><br>
                <a href='community.php'><i class='fa fa-plus border rounded py-2 px-3 bg-dark text-light add'></i></a>
            </div>
            </div>
            </div>
            </div>
        ";
            }
    ?>
</div>

</body>
<script src="../JS/jquery-3.6.0.slim.min.js"></script>
<script src="../JS/bootstrap.bundle.min.js"></script>
</html>