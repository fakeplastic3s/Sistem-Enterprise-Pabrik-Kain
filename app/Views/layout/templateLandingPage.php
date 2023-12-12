<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>/landingpage_css/style.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/img/favicon.png">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <title>PT Aji Wijayatex</title>
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><img src="/img/up-arrow.png" width="20" alt=""></button>
    <!-- Haeader -->
    <div class="header">
        <div class="nav-container">
            <div class="nav">
                <div class="nav-brand">
                    <h1> <a href="<?= base_url(); ?>"><img src="/img/ajiwijayatex.png" alt="" width="250px"></a></h1>
                </div>
                <div class="nav-menu">
                    <a href="<?= base_url(); ?>/LandingPage/index">Beranda</a>
                    <a href="<?= base_url(); ?>/LandingPage/katalog">Katalog</a>
                    <a href="<?= base_url(); ?>/LandingPage/about">Tentang Kami</a>
                </div>
                <div class="profile">
                    <a href="<?= base_url(); ?>/Login/index" class="
                    btn">Login sebagai Admin</a>
                    <a href=""></a>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- content -->
    <?= $this->renderSection('content'); ?>


    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col4">
                    <div class="footer-desc">
                        <h3>
                            PT Aji Wiyayatex
                        </h3>
                        <p>PT Aji Wijayatex merupakan pabrik kain berkualitas yang ada di Pekalongan</p>
                    </div>
                </div>
                <div class="col4">
                    <h3>
                        Need Help?
                    </h3>
                    <ul>
                        <!-- <li><a href="">Frenchise</a></li>
                        <li><a href="">Partnership</a></li> -->
                        <li><a href="">Contact</a></li>
                    </ul>
                </div>
                <div class="col4">
                    <h3>
                        Follow Us On
                    </h3>
                    <ul>
                        <li><a href="https://www.tiktok.com/@pt.ajiwijayatex_group" target="_blank"><img src="" alt="">TikTok</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

</body>
<script>
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</html>