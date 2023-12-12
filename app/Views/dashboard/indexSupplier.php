<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<section class="dashboard">
    <center>
        <div id="notif">
            <?php foreach ($bahanmentah as $isi) : ?>
                <?php if (session()->getFlashdata('notifikasi' . $isi['id_bahan_mentah'])) : ?>
                    <!-- <div class=" small alert alert-danger my-2 text-center" role="alert">
                        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('notifikasi' . $isi['id_bahan_mentah']); ?>
                    </div> -->
                    <div class="flash-data-stok" data-flashdatastok="<?= session()->getflashdata('notifikasi' . $isi['id_bahan_mentah']); ?>">

                    </div>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
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

    </center>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-4 col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Supplier</h5>
                                    <div class="d-flex align-items-center m-2">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $supplier->id_supplier; ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Jumlah Supplier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col ">
                            <div class="card">
                                <div class="d-flex align-item-center">
                                    <div class="card-body m-0 p-2 g-0">
                                        <div class="card-title text-center m-0"><?= $date; ?> <br> <span><i class="bi bi-clock"></i></span> <span id="clock"></span>
                                            <?php if (session()->getFlashdata('pesan_belum_presensi')) : ?>
                                                <form action="/PresensiAdmin/adminSupplier" method="post">
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
                </div><!-- End bahan mentah Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Bahan Mentah</h5>
                                    <?php foreach ($bahanmentah as $isi) : ?>
                                        <div class="d-flex align-items-center m-2">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <small><i class="bi bi-box-seam <?php if ($isi['jumlah_stok'] <= '5') echo 'icon-warning' ?>"></i></small>
                                            </div>
                                            <div class="ps-3" <?php if ($isi['jumlah_stok'] <= '5') echo 'style="color: #F57700;font-weight: bold;"' ?>>
                                                <?= $isi['nama_bahan_mentah']; ?>
                                                (<?= number_format($isi['jumlah_stok'], 0, ",", "."); ?>)
                                                <br>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End bahan mentah Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Bahan Mentah Diajukan</h5>
                                    <?php
                                    if (empty($diajukan)) : ?>
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                Tidak ada Data Pengadaan Bahan Diajukan!
                                            </td>
                                        </tr>
                                    <?php endif;
                                    ?>

                                    <?php foreach ($diajukan as $isi) : ?>
                                        <div class="d-flex align-items-center m-2">
                                            <div class=" rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-box"></i>
                                            </div>
                                            <div class="ps-3">
                                                <b>Nama Bahan</b> <br>
                                                <span class="text-muted small pt-2 ps-1"><?= $isi['nama_barang']; ?> <br></span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center m-2">
                                            <div class=" rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-calendar-event"></i>
                                            </div>
                                            <div class="ps-3">
                                                <b>Tanggal Pengadaan</b> <br>
                                                <span class="text-muted small pt-2 ps-1"><?= format_tanggal($isi['tanggal_pengadaan']); ?> <br></span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center m-2">
                                            <div class=" rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-123"></i>
                                            </div>
                                            <div class="ps-3">
                                                <b>Jumlah</b> <br>
                                                <span class="text-muted small pt-2 ps-1"> <?= number_format($isi['jumlah'], 0, ",", "."); ?> <br></span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center m-2">
                                            <div class=" rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-question-circle"></i>
                                            </div>
                                            <div class="ps-3">
                                                <b>Status</b> <br>
                                                <span class="text-muted small pt-2 ps-1"> <?= $isi['status']; ?> <br></span>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php endforeach ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- End bahan mentah Card -->

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