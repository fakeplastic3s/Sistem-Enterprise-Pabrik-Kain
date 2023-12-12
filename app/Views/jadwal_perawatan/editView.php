<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('JadwalPerawatan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data Jadwal Perawatan</h4>
        <form action="/JadwalPerawatan/update/<?= $jadwalperawatan->id_perawatan; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="asetmesin" class="col-sm-2 col-form-label">Nama Mesin</label>
                <div class="col-sm-10">
                    <select name="asetmesin" class="select2_single form-control <?= ($validation->hasError('asetmesin')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('asetmesin'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($asetmesin as $row) : ?>
                            <option value="<?= $row['id_mesin']; ?>" <?php if ($row['id_mesin'] == $jadwalperawatan->id_mesin) echo 'selected'; ?>> <?= $row['id_mesin']; ?> - <?= $row['nama_mesin']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('asetmesin'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Perawatan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" autofocus value="<?= $jadwalperawatan->tanggal_perawatan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="select2_single form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>" value="<?= $jadwalperawatan->status; ?>">
                        <option value="">--Pilih--</option>
                        <option value="Diproses" <?php if ($jadwalperawatan->status == 'Diproses') echo 'selected'; ?>>Diproses </option>
                        <option value="Selesai" <?php if ($jadwalperawatan->status == 'Selesai') echo 'selected'; ?>>Selesai</option>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('supplier'); ?>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $jadwalperawatan->id_perawatan; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>