<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('kebutuhanPerawatan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Data Kebutuhan Perawatan</h4>
        <form action="/KebutuhanPerawatan/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="asetmesin" class="col-sm-2 col-form-label">Nama Mesin</label>
                <div class="col-sm-10">
                    <select name="asetmesin" class="select2_single form-control <?= ($validation->hasError('asetmesin')) ? 'is-invalid' : ''; ?>" value="<?= old('asetmesin'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($asetmesin as $row) : ?>
                            <option value="<?= $row['id_mesin']; ?>" <?php if (old('asetmesin') == $row['id_mesin']) echo 'selected' ?>><?= $row['id_mesin']; ?> - <?= $row['nama_mesin']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('asetmesin'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="kebutuhan_perawatan" class="col-sm-2 col-form-label">Kebutuhan Perawatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('kebutuhan_perawatan')) ? 'is-invalid' : ''; ?>" id="kebutuhan_perawatan" name="kebutuhan_perawatan" oninvalid="this.setCustomValidity('Masukkan Kebutuhan Perawatan!')" oninput="this.setCustomValidity('')" value="<?= old('kebutuhan_perawatan'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('kebutuhan_perawatan'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="status" value="Diajukan">
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>