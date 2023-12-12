<?= $this->extend('layout/templateLandingPage'); ?>

<?= $this->section('content'); ?>
<!-- Hero -->
<div class="hero">
    <div class="container">
        <div class="row ai-center">
            <div class="col5">
                <div class="hero-desc">
                    <h1>Kain Berkualitas Tinggi <span>Untuk Kebutuhan Anda</span></h1>
                    <p>PT Aji Wijayatex merupakan pabrik kain berkualitas yang ada di Pekalongan</p>
                    <div class="spacer30"></div>
                    <a href="#menu" class="btn">Lihat Produk</a>
                </div>
            </div>
            <div class="col7">
                <img src="/img/kain4.jpg" alt="" class="img-responsive">

            </div>
        </div>
    </div>
</div>
<!-- end Hero -->
<!-- Product -->
<div class="food">
    <div class="container" id="menu">
        <div class="row">
            <div class="col12">
                <h1 class="text-center">
                    Our Product
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col4">
                <div class="food-card">
                    <div class="fc-image">
                        <img src="/img/grey.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="fc-desc">
                        <h3>
                            Kain Grey
                        </h3>
                        <!-- <p>Tersedia berbagai macam kain grey</p> -->
                    </div>
                    <div class="fc-price">
                        <div class="price-tag">
                            Start From
                        </div>
                        <div class="price-num">
                            Rp 25 <sup>Ribu</sup>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col4">
                <div class="food-card">
                    <div class="fc-image">
                        <img src="/img/linen.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="fc-desc">
                        <h3>
                            Kain Linen
                        </h3>
                        <!-- <p>Tersedia berbagai macam warna</p> -->
                    </div>
                    <div class="fc-price">
                        <div class="price-tag">
                            Start From
                        </div>
                        <div class="price-num">
                            Rp 50 <sup>Ribu</sup>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col4">
                <div class="food-card">
                    <div class="fc-image">
                        <img src="/img/jeans2.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="fc-desc">
                        <h3>
                            Jeans
                        </h3>
                        <!-- <p>Kain jeans dengan kualitas terbaik</p> -->
                    </div>
                    <div class="fc-price">
                        <div class="price-tag">
                            Start From
                        </div>
                        <div class="price-num">
                            Rp 80 <sup>Ribu</sup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col12 text-center">
                <a href="<?= base_url(); ?>/LandingPage/katalog" class="btn">View All</a>
            </div>
        </div>
    </div>
</div>
<!-- end Product -->

<?= $this->endSection(); ?>