<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section dashboard">
    <?php if (session()->getFlashdata('pesan_tambah')) : ?>
        <div class="alert alert-success my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_tambah'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_hapus')) : ?>
        <div class="alert alert-danger my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_hapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_sudah_ada')) : ?>
        <div class="alert alert-danger my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_sudah_ada'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_edit')) : ?>
        <div class="alert alert-primary my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_edit'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <!-- Form -->
            <div class="card pt-4">
                <div class="card-body">
                    <!-- <h5 class="card-title">Table with stripped rows</h5> -->
                    <!-- Table with stripped rows -->
                    <div class="table-responsive-md">
                        <form action="Absensi/save">
                            <div class="col-sm-4">
                                <input type="date" id="tanggal" name="tanggal" class="form-control">
                                <script>
                                    // Mengambil elemen input tanggal berdasarkan ID
                                    var inputTanggal = document.getElementById("tanggal");

                                    // Mendapatkan tanggal saat ini
                                    var tanggalSekarang = new Date().toISOString().split("T")[0];

                                    // Mengatur nilai tanggal saat ini ke input field tanggal
                                    inputTanggal.value = tanggalSekarang;
                                </script>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Nama Pegawai</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="pegawai" class="select2_single form-control " value="<?= old('pegawai'); ?>" required>
                                                <option value="">--Pilih--</option>
                                                <?php foreach ($getPegawai as $isi) : ?>
                                                    <option value="<?= $isi['id_pegawai']; ?>" <?php if (old('pegawai') == $isi['id_pegawai']) echo 'selected'; ?>><?= $isi['id_pegawai']; ?> - <?= $isi['nama_pegawai']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="status" class="select2_single form-control " value="<?= old('status'); ?>" required>
                                                <option value="">--Pilih--</option>
                                                <option value="Hadir" <?php if (old('status') == 'Hadir') echo 'selected'; ?>>Hadir</option>
                                                <option value="Izin" <?php if (old('status') == 'Izin') echo 'selected'; ?>>Izin</option>
                                            </select>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary ">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
            <!-- End Form -->

            <!-- Presentase -->
            <div class="card pt-4">
                <div class="card-body">
                    <!-- <h5 class="card-title">Table with stripped rows</h5> -->
                    <!-- Table with stripped rows -->
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Hadir</th>

                                    <!-- <th scope="col">Sakit</th> -->
                                    <th scope="col" class="aksi">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($countAll as $all) : ?>
                                    <?php $all = $all['Jumlah']; ?>
                                <?php endforeach ?>

                                <?php foreach ($Hadir as $isi) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td class="text-right"><?= $isi['nama_pegawai']; ?></td>
                                        <td class="text-center">
                                            <div class="row mb-3">
                                                <div class="col-sm-10">

                                                    <?= $isi['Jumlah']; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <?php
                                                    $Hadir = $isi['Jumlah'];
                                                    if ($Hadir = null) {
                                                        echo "0";
                                                    }
                                                    echo number_format($isi['Jumlah'] / $all * 100, 0, ",", ".");


                                                    ?>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
            <!-- End Presentase -->
        </div>
        <!-- Tampil -->
        <div class="col-md-6">
            <div class="card pt-4">
                <div class="card-body">
                    <!-- <h5 class="card-title">Table with stripped rows</h5> -->
                    <!-- Table with stripped rows -->
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($Absensi as $isi) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td class="text-right"><?= $isi['nama_pegawai']; ?></td>
                                        <td class="text-right"><?= $isi['tanggal_hadir']; ?></td>
                                        <td class="text-right"><?= $isi['status']; ?></td>
                                        <?php $no++ ?>
                                    </tr>
                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
    <div class="card pt-4">
        <div class="card-body">
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->
            <div class="table-responsive-md">
                <table class="table table-striped datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Waktu Presensi</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($presensiAdmin as $isi) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-right"><?= $isi['username']; ?></td>
                                <td class="text-right"><?= $isi['user_email']; ?></td>
                                <td class="text-right"><?= $isi['tanggal_presensi']; ?></td>
                                <td class="text-right"><?= $isi['waktu_presensi']; ?></td>
                                <td class="text-right"><?= $isi['status']; ?></td>
                                <?php $no++ ?>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
    </div>
</section>
<?= $this->endSection(); ?>