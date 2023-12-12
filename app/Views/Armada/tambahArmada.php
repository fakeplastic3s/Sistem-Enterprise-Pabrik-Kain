<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php

?>

<a href="<?= base_url('Armada/'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Armada</h4>
        <form action="/Armada/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="plat_nomor" class="col-sm-2 col-form-label">Plat Nomor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('plat_nomor')) ? 'is-invalid' : ''; ?>" id="plat_nomor" name="plat_nomor" autofocus value="<?= old('plat_nomor'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('plat_nomor'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenis_kendaraan" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('jenis_kendaraan')) ? 'is-invalid' : ''; ?>" id="jenis_kendaraan" name="jenis_kendaraan" autofocus value="<?= old('jenis_kendaraan'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jenis_kendaraan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="umur_kendaraan" class="col-sm-2 col-form-label">Umur Kendaraan</label>
                <div class="col-sm-10">
                    <select class="form-select <?= ($validation->hasError('umur_kendaraan')) ? 'is-invalid' : ''; ?>" id="umur_kendaraan" name="umur_kendaraan" aria-label="Default select example">
                        <option value="">--Pilih Umur Kendaraan--</option>
                        <?php
                        for ($i = 1; $i <= 50; $i++) {
                            echo "<option value='$i' >$i Tahun</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('umur_kendaraan'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>