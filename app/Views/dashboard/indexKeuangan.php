<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="dashboard">
    <?php if (session()->getFlashdata('pesan_belum_presensi')) : ?>
        <!-- <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <i class="bi bi-exclamation-triangle me-1 "></i>
            <?= session()->getFlashdata('pesan_belum_presensi'); ?>
        </div> -->
        <div class="flash-data1" data-flashdata1="<?= session()->getflashdata('pesan_belum_presensi'); ?>">

        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_presensi')) : ?>
        <!-- <div class="alert alert-success my-2 text-center" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?= session()->getFlashdata('pesan_presensi'); ?>
        </div> -->
        <div class="flash-data2" data-flashdata2="<?= session()->getflashdata('pesan_presensi'); ?>">

        </div>
    <?php endif; ?>
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Pengadaan Bahan </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-stopwatch "></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $diajukan->jumlah; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Total Pengadan Bahan Diajukan</span>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check2-circle icon-sucess"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $disetujui->jumlah; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Total Pengadan Bahan Disetujui</span>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-x-circle icon-danger"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $ditolak->jumlah; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Total Pengadan Bahan Ditolak</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!-- End hasil Produksi Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Kebutuhan Perawatan </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-stopwatch "></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $diajukanPerawatan->status; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Total Kebutuhan Perawatan Diajukan</span>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check2-circle icon-sucess"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $disetujuiPerawatan->status; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Total Kebutuhan Perawatan Disetujui</span>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-x-circle icon-danger"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $ditolakPerawatan->status; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Total Kebutuhan Perawatan Ditolak</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div><!-- End hasil Produksi Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="d-flex align-item-center">
                                    <div class="card-body m-0 p-2 g-0">
                                        <div class="card-title text-center m-0"><?= $date; ?> <br> <span><i class="bi bi-clock"></i></span> <span id="clock"></span>
                                            <?php if (session()->getFlashdata('pesan_belum_presensi')) : ?>
                                                <form action="/PresensiAdmin/adminKeuangan" method="post">
                                                    <input type="hidden" name="username" value="<?= session()->get('user_name'); ?>">
                                                    <input type="hidden" name="email" value="<?= session()->get('user_email'); ?>">
                                                    <input type="hidden" name="tanggal" value="<?= $today; ?>">
                                                    <input type="hidden" name="status" value="Hadir">
                                                    <div class=" text-center">
                                                        <button class="btn btn-hadir w-75 align-center fw-bold btn-sm">Hadir</button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End hasil Produksi Card -->




            </div>
        </div><!-- End Left side columns -->


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