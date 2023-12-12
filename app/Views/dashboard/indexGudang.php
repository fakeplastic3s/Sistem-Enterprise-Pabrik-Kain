<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="dashboard">
    <?php if (session()->getFlashdata('pesan_belum_presensi')) : ?>
        <div class="flash-data1" data-flashdata1="<?= session()->getflashdata('pesan_belum_presensi'); ?>">

        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_presensi')) : ?>
        <div class="flash-data2" data-flashdata2="<?= session()->getflashdata('pesan_presensi'); ?>">

        </div>

    <?php endif; ?>

    <div class="row g-0">

        <div class="col-lg-12 ">
            <div class="card">
                <div class="d-flex align-item-center">
                    <div class="card-body m-0 p-2 g-0">
                        <div class="card-title text-center m-0"><?= $date; ?> <br> <span><i class="bi bi-clock"></i></span> <span id="clock"></span>
                            <?php if (session()->getFlashdata('pesan_belum_presensi')) : ?>
                                <form action="/PresensiAdmin/adminGudang" method="post">
                                    <input type="hidden" name="username" value="<?= session()->get('user_name'); ?>">
                                    <input type="hidden" name="email" value="<?= session()->get('user_email'); ?>">
                                    <input type="hidden" name="tanggal" value="<?= $today; ?>">
                                    <input type="hidden" name="status" value="Hadir">
                                    <div class=" text-center">
                                        <button class="btn btn-hadir w-25 align-center fw-bold btn-sm">Hadir</button>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-6 col-md-6">
                    <div class="card  info-card small sales-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">Data Bahan Mentah</h5>
                                    <?php foreach ($bahanmentah as $isi) : ?>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="card-icon icon-small rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div class="ps-3">

                                                <h6>
                                                    <div class="small"> <?= number_format($isi['jumlah_stok'], 0, ",", "."); ?> Yard</div>

                                                </h6>
                                                <span class="text-muted small pt-2 ps-1"> <?= $isi['nama_bahan_mentah']; ?></span>

                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="col">
                                    <h5 class="card-title">Stok Barang Jadi</h5>
                                    <?php foreach ($stokbarangjadi as $isi) : ?>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="card-icon icon-small rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div class="ps-3">

                                                <h6>
                                                    <div class="small"> <?= number_format($isi['jumlah'], 0, ",", "."); ?> Yard</div>

                                                </h6>
                                                <span class="text-muted small pt-2 ps-1"> <?= $isi['nama_barang']; ?></span>

                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End bahan mentah Card -->
                    <!-- end bahan menntah -->
                </div>

                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">Bahan Masuk</h5>
                                    <?php foreach ($laporanperBulan as $isi) : ?>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="card-icon icon-small rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-calendar-event"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>
                                                    <div class="small">
                                                        <?= format_bulan($isi['bulan']); ?>
                                                    </div>
                                                </h6>
                                                <span class="text-muted small pt-2 ps-1"><i class="bi bi-rulers"> </i> <?= $isi['total']; ?> yard</span>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="col">
                                    <h5 class="card-title">Bahan Terpakai</h5>
                                    <?php foreach ($terpakaiperBulan as $isi) : ?>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="card-icon icon-small rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-calendar-event"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>
                                                    <div class="small">
                                                        <?= format_bulan($isi['bulan']); ?>
                                                    </div>
                                                </h6>
                                                <span class="text-muted small pt-2 ps-1"><i class="bi bi-rulers"> </i> <?= $isi['total']; ?> yard</span>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>

                            </div>
                            <!-- end card bahan masuk -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Jam

    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        var timeString = hours.toString().padStart(2, '0') + ':' +
            minutes.toString().padStart(2, '0') + ':' +
            seconds.toString().padStart(2, '0');

        document.getElementById('clock').textContent = timeString;
    }

    // Memperbarui waktu setiap 1 detik
    setInterval(updateClock, 1);
    // end Jam
</script>

<?= $this->endSection(); ?>