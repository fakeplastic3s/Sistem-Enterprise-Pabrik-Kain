<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('salesmarketing'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data SalesMarketing</h4>
        <form action="/SalesMarketing/update/<?= $sales_marketing->id_sales; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Sales</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $sales_marketing->nama_sales; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Sales</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= $sales_marketing->alamat_sales; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="umur" class="col-sm-2 col-form-label">Umur sales</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('umur')) ? 'is-invalid' : ''; ?>" id="umur" name="umur" value="<?= $sales_marketing->umur_sales; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('umur'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="daerah" class="col-sm-2 col-form-label">Daerah Operasi </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('daerah')) ? 'is-invalid' : ''; ?>" id="daerah" name="daerah" value="<?= $sales_marketing->daerah_operasi; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('daerah'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $sales_marketing->id_sales; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>