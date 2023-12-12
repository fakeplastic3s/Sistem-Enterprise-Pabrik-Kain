<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('stokbarangjadi'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Data Stok Barang Jadi</h4>
        <form action="/StokBarangJadi/add" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" oninvalid="this.setCustomValidity('Masukkan nama barang berupa huruf!')" oninput="this.setCustomValidity('')" value="<?= old('nama_barang'); ?>" autofocus>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama_barang'); ?>
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
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" oninvalid="this.setCustomValidity('Masukkan harga berupa angka!')" oninput="this.setCustomValidity('')" value="<?= old('harga'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('harga'); ?>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" autofocus value="<?= old('gambar'); ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('gambar'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>