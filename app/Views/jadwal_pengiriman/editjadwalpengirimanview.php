<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php

?>

<a href="<?= base_url('JadwalPengiriman'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit jadwal Pengiriman</h4>
        <form action="<?= base_url('JadwalPengiriman/update/' . $data['id_pengirim']); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pengirim</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_pengirim')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $data['nama_pengirim']; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama_pengiriman'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label"> Tanggal Pengiriman</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_pengiriman')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" oninvalid="this.setCustomValidity('Masukkan tanggal stok berupa angka!')" oninput="this.setCustomValidity('')" value="<?= (old('tanggal')) ? old('tanggal') : $data['tanggal_pengiriman']; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal_pengiriman'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="id_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select class="form-select <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>" id="id_barang" name="id_barang" aria-label="Default select example">
                        <?php foreach ($getNamaBarang as $barang) : ?>
                            <?php if ($barang['id_barang'] == $data['id_barang']) : ?>
                                <option value="<?= $barang['id_barang']; ?>" selected><?= $barang['nama_barang']; ?>
                                </option>
                            <?php else : ?>
                                <option value="<?= $barang['id_barang']; ?>"><?= $barang['nama_barang']; ?> </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('id_barang'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="id_barang" class="col-sm-2 col-form-label">Jenis kendaraan</label>
                <div class="col-sm-10">
                    <select class="form-select <?= ($validation->hasError('plat_nomor')) ? 'is-invalid' : ''; ?>" id="plat_nomor" name="plat_nomor" aria-label="Default select example">
                        <?php foreach ($getArmada as $barang) : ?>
                            <?php if ($barang['plat_nomor'] == $data['plat_nomor']) : ?>
                                <option value="<?= $barang['plat_nomor']; ?>" selected><?= $barang['jenis_kendaraan']; ?>
                                </option>
                            <?php else : ?>
                                <option value="<?= $barang['plat_nomor']; ?>"><?= $barang['jenis_kendaraan']; ?> </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('plat_nomor'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Alamat tujuan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('alamat_tujuan')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" oninvalid="this.setCustomValidity('Masukkan alamat berupa angka!')" oninput="this.setCustomValidity('')" value="<?= (old('alamat')) ? old('alamat') : $data['alamat_tujuan']; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat_tujuan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" oninvalid="this.setCustomValidity('Masukkan jumlah berupa angka!')" oninput="this.setCustomValidity('')" value="<?= (old('jumlah')) ? old('jumlah') : $data['jumlah_pengiriman']; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="id_barang" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status" aria-label="Default select example" required>

                        <option value="1" <?= ($data['status']) ? '1' : 'selected'; ?>>Dalam pengiriman
                        </option>
                        <option value="0" <?= ($data['status']) ? '0' : 'selected'; ?>>Selesai
                        </option>

                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('id'); ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Edit Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>