<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('KebutuhanProduksi'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title; ?></h4>
        <form action="/KebutuhanProduksi/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="bahan" class="col-sm-2 col-form-label">Bahan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('bahan')) ? 'is-invalid' : ''; ?>" id="bahan" name="bahan" oninvalid="this.setCustomValidity('Masukkan nama barang stok berupa angka!')" oninput="this.setCustomValidity('')" value="<?= old('bahan'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('bahan'); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>