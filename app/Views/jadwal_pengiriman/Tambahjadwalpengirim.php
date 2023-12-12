<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php

?>

<a href="<?= base_url('JadwalPengiriman'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Jadwal Pengiriman</h4>
        <form action="/JadwalPengiriman/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pengirim</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label"> Tanggal Pengiriman</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" oninvalid="this.setCustomValidity('Masukkan tanggal berupa angka!')" oninput="this.setCustomValidity('')" value="<?= old('tanggal'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="stokbarangjadi" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select name="stokbarangjadi" class="select2_single form-control <?= ($validation->hasError('stokbarangjadi')) ? 'is-invalid' : ''; ?>" value="<?= old('stokbarangjadi'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($stokbarangjadi as $row) : ?>
                            <option value="<?= $row['id_barang']; ?>" <?php if (old('stokbarangjadi') == $row['id_barang']) echo 'selected'; ?>><?= $row['id_barang']; ?> - <?= $row['nama_barang']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('stokbarangjadi'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="armada" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                <div class="col-sm-10">
                    <select name="armada" class="select2_single form-control <?= ($validation->hasError('armada')) ? 'is-invalid' : ''; ?>" value="<?= old('armada'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($armada as $row) : ?>
                            <option value="<?= $row['plat_nomor']; ?>" <?php if (old('armada') == $row['plat_nomor']) echo 'selected'; ?>><?= $row['plat_nomor']; ?> - <?= $row['jenis_kendaraan']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('armada'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat tujuan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" oninvalid="this.setCustomValidity('Masukkan alamat!')" oninput="this.setCustomValidity('')" value="<?= old('alamat'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" oninvalid="this.setCustomValidity('Masukkan jumlah berupa angka!')" oninput="this.setCustomValidity('')" value="<?= old('jumlah'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="select2_single form-control <?= ($validation->hasError('jadwal_pengiriman')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>">
                        <option value="">--Pilih--</option>
                        <option value="Diproses">Diproses </option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jadwal_pengiriman'); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>