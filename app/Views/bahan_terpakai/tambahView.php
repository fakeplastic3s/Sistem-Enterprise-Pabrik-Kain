<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('BahanTerpakai'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning my-2 text-center" role="alert">
        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('warning'); ?>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-body">

        <h4 class="card-title"><?= $title; ?></h4>
        <form action="/BahanTerpakai/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="bahanmentah" class="col-sm-2 col-form-label">Nama Bahan</label>
                <div class="col-sm-10">
                    <select name="bahanmentah" class="select2_single form-control <?= ($validation->hasError('bahanmentah')) ? 'is-invalid' : ''; ?>" value="<?= old('bahanmentah'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($bahanmentah as $row) : ?>
                            <option value="<?= $row['id_bahan_mentah']; ?>" <?php if (old('bahanmentah') == $row['id_bahan_mentah']) echo 'selected'; ?>><?= $row['id_bahan_mentah']; ?> - <?= $row['nama_bahan_mentah']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('bahanmentah'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pakai</label>
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