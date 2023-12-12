<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('Penjualan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning my-2 text-center" role="alert">
        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('warning'); ?>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Data Penjualan</h4>
        <form action="/Penjualan/add" method="POST">
            <?= csrf_field(); ?>

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
                <label for="salesmarketing" class="col-sm-2 col-form-label">Nama Sales</label>
                <div class="col-sm-10">
                    <select name="salesmarketing" class="select2_single form-control <?= ($validation->hasError('salesmarketing')) ? 'is-invalid' : ''; ?>" value="<?= old('salesmarketing'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($salesmarketing as $row) : ?>
                            <option value="<?= $row['id_sales']; ?>" <?php if (old('salesmarketing') == $row['id_sales']) echo 'selected'; ?>><?= $row['id_sales']; ?> - <?= $row['nama_sales']; ?> - <?= $row['daerah_operasi']; ?> </option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('salesmarketing'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" oninvalid="this.setCustomValidity('Masukkan nama barang stok berupa angka!')" oninput="this.setCustomValidity('')" value="<?= old('jumlah'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>