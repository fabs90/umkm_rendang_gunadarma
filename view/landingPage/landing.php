<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

$menu = new Menu();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM JAYA</title>

    <!-- swiper link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- cdn icon link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- custom css file  -->
    <link rel="stylesheet" href="../../public/landingPage/umkmRendang.css">

</head>

<body>

    <!-- header section start here  -->
    <header class="header">
        <div class="logoContent">
            <a href="#" class="logo"><img src="../../assets/logo-UKB.png" alt=""></a>
            <h1 class="logoName">Aneka jajanan daerah </h1>
        </div>

        <nav class="navbar" id="navbar">
            <a href="#home">home</a>
            <a href="#product">product</a>
            <a href="https://kjkmu.000webhostapp.com/menu.html">Menu</a>
            <a href="#review">review</a>
            <a href="#contact">contact</a>
        </nav>

        <div class="icon">
            <i class="fas fa-search" id="search"></i>
            <i class="fas fa-bars" id="menu-bar"></a></i>
            <i class="fa fa-bank" id="bank"></i>
        </div>

        <div class="search">
            <input type="search" id="search-input" placeholder="search...">
        </div>
    </header>

    <!-- header section end here  -->

    <!-- home section start here  -->
    <div class="discount-box">
        <a href="https://wa.me/6285280378914"><img src="../../assets/promoedit.jpg" class="icon-discount"></a>
    </div>
    <section class="home" id="home">

        <div class="content">
            <br>
            <br>
            <br>
            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_bevi1628.json" background="transparent"
                speed="0.5" class="img-fluid w-100 px-lg-5" style="width: 400px; height: 150px; " loop autoplay>
            </lottie-player>

            <h3>Salam Hangat<span></span></h3>
            <h3>Pecinta Rendang<span></span></h3>
            <h3>Sapi Umar<span></span></h3>

            <p> Rendang memiliki filosofi tersendiri bagi masyarakat Minang Sumatra Barat, yaitu musyawarah dan mufakat,
                yang berangkat dari empat bahan pokok yang melambangkan keutuhan masyarakat Minang. Sesuai dengan
                namanya, jajanan yang satu ini memang berasal dari kota Solo di Jawa Tengah. Namun, berbeda dengan sosis
                biasanya, karena secara teknis, sosis Solo bukanlah benar-benar sosis.</p>
            <a href="https://kjkmu.000webhostapp.com/filosofi.html" class="btn">Baca Filosofi</a>
        </div>
        <img src="../../assets/Brown & White Modern Food Promotion Poster (1).png" class="jametkudasai"
            style="margin:auto; margin-right:20px; width:35%;">
    </section>




    <!-- home section end here  -->

    <!-- product section start here  -->
    <br>

    <section class="product" id="product">
        <div class="heading">
            <h2>Produk Eksklusif Kami</h2>
        </div>
        <div class="swiper product-row">
            <div class="swiper-wrapper">
                <?php
$result = $menu->index();
foreach ($result as $hasil):
?>

                <div class="swiper-slide box">
                    <div class="img">
                        <img src="<?="../../images/" . $hasil['gambar'];?>" alt="">
                    </div>
                    <div class="product-content">
                        <h3><?=$hasil['nama']?></h3>
                        <p>siap santap
                            Dipacking dgn berat 250 gr dgn isi 4 potong dengan cita rasa Minang yang khas. </p>
                        <?php if ($hasil['harga_diskon'] > 0) {?>
                        <div class="price"><?=number_format($hasil['harga_diskon'], 0)?>
                            <span><?=number_format($hasil['harga'], 0)?></span>
                        </div>
                        <?php } else {?>
                        <div class="price"><?=number_format($hasil['harga'], 0)?> </div>

                        <?php }?>
                    </div>
                </div>

                <?php
endforeach;
?>

            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="contact" id="contact">

        <h1 class="heading"> <span>kontak</span> Kami </h1>

        <div class="row">

            <form action="">
                <h3>Untuk info promo dan pemesanan, klik <a href="https://wa.me/6285280378914"><i
                            class="fa fa-whatsapp " style="font-size:50px;color:green"></i></a></h3>
                <br>
                <br>

                <h3>(0812-1234-5678)</h3>

                <br>
            </form>

        </div>

    </section>

    <!-- product section end here  -->

    <!-- blogs section start here  -->

    <div class="swiper-pagination"></div>
    <section class="blogs" id="blogs">
        <div class="aha">
            <h2>Produk Kami</h2>
        </div>
        <div class=" swiper blogs-row">
            <div class="swiper-wrapper">
                <div class=" swiper-slide box">
                    <div class="img">
                        <img src="../../assets/umkm5.jpeg" style="border-radius: 20px;">
                    </div>
                    <div class="content">
                        <h3>Sosis Solo</h3>
                        <p>siap santap.
                            Dipacking per-3 potong dgn harga 15.000.
                            Kulit sosis solo yg lembut dan ayam sensasi yg lembut.</p>
                        <p></p>
                        <a href="https://wa.me/628128494313" class="btn">Silahkan Pesan</a>
                    </div>
                </div>
                <div class=" swiper-slide box">
                    <div class="img">
                        <img src="../../assets/umkm3.jpeg" style="border-radius: 20px;">
                    </div>
                    <div class="content">
                        <h3>Sosis solo </h3>
                        <p>siap santap.
                            Dipacking per-3 potong dgn harga 15.000.
                            Kulit sosis solo yg lembut dan ayam sensasi yg lembut.</p>
                        <p>
                        </p>
                        <a href="https://wa.me/628128494313" class="btn">Silahkan Pesan</a>
                    </div>
                </div>
                <div class=" swiper-slide box">
                    <div class="img">
                        <img src="../../assets/umkm2.jpeg" style="border-radius: 20px;">
                    </div>
                    <div class="content">
                        <h3>Rendang</h3>
                        <p>siap santap dan frozen.
                            Dipacking dgn berat 250 gr dgn isi 4 potong dgn bumbu khas asli rendang minang.
                            Tahan 7 hari</p>
                        <a href="https://wa.me/628128494313" class="btn">Silahkan Pesan</a>

                    </div>
    </section>

    <!-- blogs section ends here  -->

    <!-- newsletter section start here  -->

    <section class="contact" id="contact">

        <h1 class="heading"> <span>Maps</span> Kami </h1>

        <div class="row">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2408356244987!2d106.87099087372236!3d-6.362868962242618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec8c2d341441%3A0x2f68eaf902929bbd!2sPerumahan%20Lembah%20Nirmala%202!5e0!3m2!1sid!2sid!4v1688953145628!5m2!1sid!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>


        </div>

    </section>
    <!-- newsletter section ends here  -->

    <!-- review section start here  -->
    <section class="review" id="review">
        <div class="heading">
            <h2>Testimoni</h2>
        </div>


        <div class=" swiper review-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>saya sangat suka dengan rendangnya karena memiliki ciri khas padang sekali dan aromanya
                            mengugah selera.</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="../../assets/fabian.jpg" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Fabian</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>Makanan ini sangat enak, dan cocok untuk lidah dari berbagai penjuru yang ada di
                            Indonesia.dan saya juga suka pada sosis solo yang khas</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="../../assets/afrel.jpeg" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Afrel</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>Rendang dan Sosis solo buatan umkm ini sangat enak menurut saya. Saya akan stok setiap
                            bulannya dan membeli di umkm ini</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="../../assets/raldy.jpeg" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Raldy</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="client-review">
                        <p>saya sangat suka dengan rendangnya karena memiliki ciri khas padang sekali dan aromanya
                            mengugah selera.</p>
                    </div>
                    <div class="client-info">
                        <div class="img">
                            <img src="../../assets/dede.png" alt="">
                        </div>
                        <div class="clientDetailed">
                            <h3>Dhede Anggi</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </section>
    <!-- review section ends here  -->

    <!-- footer section start here  -->

    <footer class="footer" id="contact">
        <div class="box-container">
            <div class="box"></div>
            <div class="box">
                <h3>Quick link</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i>Home</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>produk</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>blog</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>review</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>kontak</a>

            </div>
            <div class="box">
                <h3>Extra link</h3>
                <a href="login.php"> <i class="fas fa-arrow-right"></i>Admin</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>order</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>privasi</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>metode pembayaran</a>
                <a href="#"> <i class="fas fa-arrow-right"></i>servis Kami</a>
            </div>
            <div class="box">
                <h3>Contact Info</h3>
                <a href="#"> <i class="fas fa-phone"></i>0812-8494-313</a>
                <a href="#"> <i class="fas fa-envelope"></i>Omudinarlia@gmail.com</a>
                <a href="#"> <i class="fa fa-credit-card-alt"> bank bca</i></a>
                <p>SCAN QODE NOMOR WA</p>
                <br>
                <img src="qodeqr.png" style="width: 120px;">

            </div>

        </div>
        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>
        <div class="credit">
            created by <span>Raldy and Fabian designer </span> |all rights reserved !
        </div>
    </footer>










    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file  -->
    <script src="../../public/landingPage/umkmRendang.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</body>

</html>