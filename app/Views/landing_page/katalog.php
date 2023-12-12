<?= $this->extend('layout/templateLandingPage'); ?>

<?= $this->section('content'); ?>


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
            <?php foreach ($kain as $isi) : ?>


                <div class="col4">
                    <div class="food-card">
                        <div class="fc-image">
                            <img src="/img/stokbarangjadi/<?= $isi['gambar']; ?>" alt="" class="img-responsive">
                        </div>
                        <div class="fc-desc">
                            <h3>
                                <?= $isi['nama_barang']; ?>
                            </h3>
                            <!-- <p>Tersedia berbagai macam kain grey</p> -->
                        </div>
                        <div class="fc-price">
                            <div class="price-tag">
                                Start From
                            </div>
                            <div class="price-num">
                                Rp <?= substr($isi['harga'], -5, 2); ?> <sup>Ribu</sup>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>