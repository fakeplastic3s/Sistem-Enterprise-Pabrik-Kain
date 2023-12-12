<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
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
<section class="dashboard">
    <center>
        <h2>Selamat Datang <?= session()->get('user_name'); ?></h2>
        <h1>Di Sistem Enterprise PT Aji Wijayatex</h1>
    </center>
    <br>
    <div class="row g-0">

        <div class="col-lg-12 ">
            <div class="card">
                <div class="d-flex align-item-center">
                    <div class="card-body m-0 p-2 g-0">
                        <div class="card-title text-center m-0"><?= $date; ?> <br> <span><i class="bi bi-clock"></i></span> <span id="clock"></span>
                            <?php if (session()->getFlashdata('pesan_belum_presensi')) : ?>
                                <form action="/PresensiAdmin/admin" method="post">
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