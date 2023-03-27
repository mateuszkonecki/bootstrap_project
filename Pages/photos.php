<?php 
    session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/font-awesome.min.css">
    <style>
        .myImg {
            transition-duration: 2.5s;
            margin: 0 auto;
            display: block;
        }
        .myImg:hover {
            transform: scale(1.1);
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            z-index: 0;
        }
        .fc, .ig{
            margin-top: 5px;
            width: 5%;
            margin-left: 5px
        }
    </style>
    <title>Portfolio</title>
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
                    <a href="photos.php" class="nav-link nav-item pr-3 active">Moje portfolio</a>
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

<div id="nature">
    <div class="container text-center my-5">
        <span class="text-uppercase text-success lead display-4">#Natura</span>
    </div>
    <div class="container">
        <div class="row mb-1 mb-md-2">
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Nature/first.jpg" alt="Natura" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Nature/third.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Nature/twice.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-1 mb-md-2">
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Nature/fourth.jpg" alt="Natura" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Nature/seventh.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Nature/sixth.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row mb-1 mb-md-2 mb-2">
            <div class="col-12">
                <div class="card">
                    <img src="../Photos/Nature/fifth.jpg" alt="Natura" class="img-fluid myImg rounded">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="details">
    <div class="container text-center my-5">
        <span class="text-uppercase text-info lead display-4">#Detale</span>
    </div>
    <div class="container">
        <div class="row mb-1 mb-md-2">
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Details/detail1.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Details/detail7.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Details/detail3.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-1 mb-md-2">
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Details/detail4.jpg" alt="Natura" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Details/detail8.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="card">
                    <img src="../Photos/Details/detail6.jpg" alt="Detale" class="img-fluid myImg rounded">
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row mb-1 mb-md-2 mb-2">
            <div class="col-12">
                <div class="card">
                    <img src="../Photos/Details/detail5.jpg" alt="Natura" class="img-fluid myImg rounded">
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