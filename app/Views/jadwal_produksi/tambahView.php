<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('JadwalProduksi'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Data Jadwal Produksi</h4>
        <form action="/JadwalProduksi/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="stokbarangjadi" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select name="barang" class="select2_single form-control <?= ($validation->hasError('barang')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('barang'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($kebutuhan as $row) : ?>
                            <option value="<?= $row['id_kebutuhan_produksi']; ?>" <?php if (old('barang') == $row['id_kebutuhan_produksi']) echo 'selected' ?>><?= $row['id_kebutuhan_produksi']; ?> - <?= $row['nama_barang']; ?> - <?= $row['bahan']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('barang'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Produksi</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" autofocus value="<?= old('tanggal'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="jam" class="col-sm-2 col-form-label">Jam Produksi</label>
                <div class="col-sm-10">
                    <select name="jam" class="select2_single form-control <?= ($validation->hasError('jam')) ? 'is-invalid' : ''; ?>" id="jam" autofocus value="<?= old('jam'); ?>">
                        <option value="">----Pilih---</option>
                        <option value="07.00-15.00" <?php if (old('jam') == '07.00 - 15.00') echo 'selected' ?>>07.00-15.00</option>
                        <option value="15.00-23.00" <?php if (old('jam') == '15.00-23.00') echo 'selected' ?>>15.00-23.00</option>
                        <option value="23.00-07.00" <?php if (old('jam') == '23.00 - 07.00') echo 'selected' ?>>23.00-07.00</option>
                    </select>

                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jam'); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>