<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('BahanTerpakai'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title; ?></h4>
        <form action="/BahanTerpakai/update/<?= $bahanterpakai->id_bahan_terpakai; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="bahanmentah" class="col-sm-2 col-form-label">Nama Bahan</label>
                <div class="col-sm-10">
                    <select name="bahanmentah" class="select2_single form-control <?= ($validation->hasError('bahanmentah')) ? 'is-invalid' : ''; ?>" value="<?= old('bahanmentah'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($bahanmentah as $row) : ?>
                            <option value="<?= $row['id_bahan_mentah']; ?>" <?php if ($row['id_bahan_mentah'] == $bahanterpakai->id_bahan_mentah) echo 'selected'; ?>><?= $row['id_bahan_mentah']; ?> - <?= $row['nama_bahan_mentah']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('bahanmentah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= $bahanterpakai->tanggal_pakai; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $bahanterpakai->jumlah; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $bahanterpakai->id_bahan_terpakai; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>