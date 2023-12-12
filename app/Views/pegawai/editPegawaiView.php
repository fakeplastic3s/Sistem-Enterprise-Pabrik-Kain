<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data Pegawai</h4>
        <form action="/Pegawai/update/<?= $pegawai->id_pegawai; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $pegawai->nama_pegawai; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" oninvalid="this.setCustomValidity('Masukkan alamat stok berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $pegawai->alamat; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" oninvalid="this.setCustomValidity('Masukkan nama_barang beli Supplier berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $pegawai->jabatan; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jabatan'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="gaji" class="col-sm-2 col-form-label">Gaji Pokok</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('gaji')) ? 'is-invalid' : ''; ?>" id="gaji" name="gaji" value="<?= $pegawai->gaji_pokok; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('gaji'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $pegawai->id_pegawai; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>