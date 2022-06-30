<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab PTIK</title>
    <link rel="icon" href="https://i0.wp.com/uns.ac.id/id/wp-content/uploads/logo-uns-biru.png?fit=528%2C526&ssl=1" type="image/jpg" sizes="16x16">
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="jquery/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
</head>

<body>
    <nav class="navbar navbar-expand-md sticky-top">
        <a class="navbar-brand" href="index.html"><img src="https://ptik.fkip.uns.ac.id/wp-content/uploads/2021/02/Composed-Logo.png" alt="" height="50" class="d-inline-block align-middle mr-2"></a>
        <button class="navbar-toggler navbar-light ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon" style="color: aqua;">

            </span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#fasilitas">Fasilitas</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="<?php if (user() != null) {
                        echo base_url('/user/reserlist');
                    } ?>">Jadwal Peminjaman</a>
                </li>
                <?php if (!logged_in()) { ?>
                    <li>
                        <a class="btn btn-primary d-flex" href="<?php echo base_url('login'); ?>">Sign In</a>
                    </li>
                    &emsp;
                    <li>
                        <a class="btn btn-danger d-flex" href="<?php echo base_url('register'); ?>">Sign Up</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url('/user/index'); ?>">User Menu</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="5000">
                <img src="img/lab-a.jpg" class="d-block w-100 h-10 img-fluid" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="img/lab-b.webp" class="d-block w-100 h-10 img-fluid" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="img/lab-m.webp" class="d-block w-100 h-10 img-fluid" alt="...">
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>


    <center>
        <div class="section-xl text-center">
            <div class="container text-center" role="main">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col_reservasi text-center">
                        <div class="jumbotron text-center" style="background-color: aliceblue;">
                            <h1>Reservasi</h1>
                            <p class="lead ">
                                Cepat dan tidak perlu mengantri.
                            </p>
                            <?php if (logged_in()) { ?>
                                <a href="<?php echo base_url('/user/reservation'); ?>" class=" btn btn-lg btn-primary button_reservasi " role=" button">Reservasi Sekarang</a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('login'); ?>" class=" btn btn-lg btn-primary button_reservasi " role=" button">Reservasi Sekarang</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <div class="section-xl">
        <div class="container" style="margin-bottom: 0rem;">
            <div>

            </div>
        </div>
    </div>

    <div id="fasilitas" class="p-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-55" style="margin-bottom: 4rem;">
                    <h1 style="margin-bottom: 1rem;margin-top: 3rem;">Fasilitas Lab Kami</h1>
                    <p>
                        Kami memberikan fasilitas pelayanan peminjaman laboratorium PTIK untuk member civitas kampus baik UNS maupun non UNS. Reservasi/peminjaman oleh member UNS diberikan gratis sedangkan untuk member non-uns terdapat biaya sewa. Kami memliki 3 buah laboratorium sebagai berikut. 
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-center">
                <img src="img/lab-m.webp" alt="" class=" img-fluid" width="140" height="140">
                <h2>Software Engineering</h2>
                <p class="text-justify">
                    Software Engineering menyediakan komputer yang memadai biasa digunakan untuk perkuliahan pemrogramman.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <img src="img/lab-b.webp" alt="" class=" img-fluid" width="140" height="140">
                <h2>Multimedia Studio</h2>
                <p class="text-justify">
                    Multimedia Studio menyediakan peralatan multimedia yang memadai seperti komputer dengan spesifikasi mumpuni, peralatan fotografi dan peralatan broadcasting. Berbagai kegiatan yang dapat dilakukan di multimedia studio ini yaitu seperti fotografi, pembuatan animasi, broadcasting, hingga pembuatan video streaming.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <img src="img/lab-m.webp" alt="" class=" img-fluid" width="140" height="140">
                <h2>Computer Network and Instrumentation</h2>
                <p class="text-justify">
                    Computer Network and Instrumentation menyediakan fasilitas komputer yang memadai dan berbagai peralatan jaringan seperti router, switch, dan sebagainya biasa digunakan untuk perkuliahan jaringan komputer.
                </p>
            </div>
        </div>
    </div>
    </div>
    <footer class="page-footer">
        <div class="footer-top footer-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-8 col-sm-12 col-footer">
                        <img src="https://ptik.fkip.uns.ac.id/wp-content/uploads/2021/02/Composed-Logo.png" class="img-fluid" alt="">
                        <p style="margin-top: 20px; margin-bottom: 40px;">"Kami tidak pernah meragaukan tamu meskipun permintaan yang aneh-aneh"</p>
                        <div class="flex-center">
                            <a href="https://github.com/novalution/uaswf" class="fa fa-github"></a>
                            <a href="#" class="fa fa-instagram"></a>
                            <a href="#" class="fa fa-twitter"></a>
                            <a href="#" class="fa fa-youtube"></a>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12">
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12 col-footer">
                        <h3>HUBUNGI KAMI</h3>
                        <p><i class="fa fa-phone" style="padding: 0;margin-bottom: 0;"></i> (0271)648939</p>
                        <p><i class="fa fa-whatsapp" style="padding: 0;margin-bottom: 0;"></i> Whatsapp : 087-444-999-000</p>
                        <p><i class="fa fa-envelope-o" style="padding: 0;margin-bottom: 0;"></i> Email : ptik@fkip.uns.ac.id</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-footer">
                        <h3>LOKASI</h3>
                        <h5>Pendidikan Teknik Informatika dan Komputer
                            Kampus V JPTK FKIP UNS Pabelan</h5>
                        <p>
                            Jl. Jend. Ahmad Yani 200A Pabelan, Kartasura, Sukoharjo 57100
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center">© 2022 Copyright: ptik.fkip.uns.ac.id</div>
    </footer>
    <script src="js/main.js"> </script>
</body>

</html>
