<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('Penjualan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data Penjualan</h4>
        <form action="/Penjualan/update/<?= $penjualan->id_penjualan; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="stokbarangjadi" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select name="stokbarangjadi" class="select2_single form-control <?= ($validation->hasError('stokbarangjadi')) ? 'is-invalid' : ''; ?>" value="<?= old('stokbarangjadi'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($stokbarangjadi as $row) : ?>
                            <option value="<?= $row['id_barang']; ?>" <?php if ($row['id_barang'] == $penjualan->id_barang) echo 'selected'; ?>><?= $row['id_barang']; ?> - <?= $row['nama_barang']; ?></option>

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
                            <option value="<?= $row['id_sales']; ?>" <?php if ($row['id_sales'] == $penjualan->id_sales) echo 'selected'; ?>> <?= $row['id_sales']; ?> - <?= $row['nama_sales']; ?> - <?= $row['daerah_operasi']; ?></option>

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
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= $penjualan->tanggal_penjualan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $penjualan->jumlah_penjualan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $penjualan->id_penjualan; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>