<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('KebutuhanPerawatan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Edit Data kebutuahan peratawatan</h4> -->
        <form action="/KebutuhanPerawatan/update/<?= $kebutuhanperawatan->id_kebutuhan_perawatan; ?>" method="POST" class="mt-4">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="asetmesin" class="col-sm-2 col-form-label">Nama Mesin</label>
                <div class="col-sm-10">
                    <select name="asetmesin" class="select2_single form-control <?= ($validation->hasError('asetmesin')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('asetmesin'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($asetmesin as $row) : ?>
                            <option value="<?= $row['id_mesin']; ?>" <?php if ($row['id_mesin'] == $kebutuhanperawatan->id_mesin) echo 'selected'; ?>> <?= $row['id_mesin']; ?> - <?= $row['nama_mesin']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('asetmesin'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="kebutuhan_perawatan" class="col-sm-2 col-form-label">Kebutuhan Perawatan </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('kebutuhan_perawatan')) ? 'is-invalid' : ''; ?>" id="kebutuhan_perawatan" name="kebutuhan_perawatan" value="<?= $kebutuhanperawatan->kebutuhan_perawatan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('kebutuhan_perawatan'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $kebutuhanperawatan->id_kebutuhan_perawatan; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>