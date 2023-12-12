<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('hasilproduksi'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title; ?></h4>
        <form action="/HasilProduksi/add" method="POST">
            <?= csrf_field(); ?>

            <!-- selecet item namabarang form database -->
            <div class="row mb-3">
                <label for="id_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select class="form-select <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>" id="id_barang" name="id_barang" aria-label="Default select example">
                        <option value="">--Pilih Barang--</option>
                        <?php foreach ($data as $barang) : ?>
                            <option value="<?= $barang['id_barang']; ?>" <?php if (old('id_barang') == $barang['id_barang']) echo 'selected' ?>><?= $barang['id_barang']; ?> - <?= $barang['nama_barang']; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('id_barang'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal_produksi" class="col-sm-2 col-form-label">Tanggal Produksi</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_produksi')) ? 'is-invalid' : ''; ?>" id="tanggal_produksi" name="tanggal_produksi" oninvalid="this.setCustomValidity('Masukkan tanggal produksi berupa angka!')" oninput="this.setCustomValidity('')" value="<?= old('tanggal_produksi'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal_produksi'); ?>
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
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>