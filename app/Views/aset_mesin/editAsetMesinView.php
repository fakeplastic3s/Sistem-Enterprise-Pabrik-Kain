<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('AsetMesin'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data Mesin</h4>
        <form action="/AsetMesin/update/<?= $asetmesin->id_mesin; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Mesin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $asetmesin->nama_mesin; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" id="merk" name="merk" oninvalid="this.setCustomValidity('Masukkan Merk Mesin!')" oninput="this.setCustomValidity('')" value="<?= $asetmesin->merk; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('merk'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tgl_pengadaan" class="col-sm-2 col-form-label">Tanggal Pengadaan </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('tgl_pengadaan')) ? 'is-invalid' : ''; ?>" id="tgl_Pengadaan" name="tgl_pengadaan" oninvalid="this.setCustomValidity('Masukkan tgl_pengadaan berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $asetmesin->tgl_pengadaan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tgl_pengadaan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" oninvalid="this.setCustomValidity('Masukkan jumlah mesin berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $asetmesin->jumlah; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $asetmesin->id_mesin; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>