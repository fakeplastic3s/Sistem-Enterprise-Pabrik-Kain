<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php

?>

<a href="<?= base_url('JadwalPengiriman'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Jadwal Pengiriman</h4>
        <form action="/JadwalPengiriman/update/<?= $jadwalpengiriman->id_pengirim; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pengirim</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $jadwalpengiriman->nama_pengirim; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pengirim</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" autofocus value="<?= $jadwalpengiriman->tanggal_pengiriman; ?>">
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
                            <option value="<?= $row['id_barang']; ?>" <?php if ($row['id_barang'] == $jadwalpengiriman->id_barang) echo 'selected'; ?>><?= $row['id_barang']; ?> - <?= $row['nama_barang']; ?></option>

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
                            <option value="<?= $row['plat_nomor']; ?>" <?php if ($row['plat_nomor'] == $jadwalpengiriman->plat_nomor) echo 'selected'; ?>><?= $row['plat_nomor']; ?> - <?= $row['jenis_kendaraan']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('armada'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Tujuan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" autofocus value="<?= $jadwalpengiriman->alamat_tujuan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="numberSA" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" autofocus value="<?= $jadwalpengiriman->jumlah_pengiriman; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="select2_single form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" value="<?= $jadwalpengiriman->status; ?>">
                        <option value="">--Pilih--</option>
                        <option value="Diproses" <?php if ($jadwalpengiriman->status == 'Diproses') echo 'selected'; ?>>Diproses </option>
                        <option value="Selesai" <?php if ($jadwalpengiriman->status == 'Selesai') echo 'selected'; ?>>Selesai</option>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('status'); ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Edit Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>