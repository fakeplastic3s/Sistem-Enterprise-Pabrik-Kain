<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('stokbarangjadi'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data Stok Barang Jadi</h4>

        <form action="/StokBarangJadi/update/<?= $stokbarangjadi->id_barang; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" oninvalid="this.setCustomValidity('Masukkan nama barang  berupa huruf!')" oninput="this.setCustomValidity('')" value="<?= $stokbarangjadi->nama_barang; ?>" autofocus>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama_barang'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Stok </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" oninvalid="this.setCustomValidity('Masukkan jumlah berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $stokbarangjadi->jumlah; ?>" disabled>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga" class="col-sm-2 col-form-label">Harga </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" oninvalid="this.setCustomValidity('Masukkan harga berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $stokbarangjadi->harga; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('harga'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group">
                    <label for="gambar" class="col-sm-2 col-form-label"></label>
                    <img class="img-thumbnail" src="/img/stokbarangjadi/<?= $stokbarangjadi->gambar; ?>" width="150px">
                </div>
            </div>

            <div class="input-group mb-3">
                <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" autofocus value="<?= old('gambar'); ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('gambar'); ?>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $stokbarangjadi->id_barang; ?>">
            <input type="hidden" name="gambarLama" value="<?= $stokbarangjadi->gambar; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>