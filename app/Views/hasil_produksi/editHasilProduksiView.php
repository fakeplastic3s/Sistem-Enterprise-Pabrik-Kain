<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('HasilProduksi'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title; ?></h4>
        <form action="/HasilProduksi/update/<?= $hasilproduksi->id_hasil_produksi; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="id_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select class="form-select <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>" id="id_barang" name="id_barang" aria-label="Default select example">
                        <?php foreach ($getNamaBarang as $barang) : ?>
                            <?php if ($barang['id_barang'] == $data['id_barang']) : ?>
                                <option value="<?= $barang['id_barang']; ?>" selected><?= $barang['nama_barang']; ?>
                                </option>
                            <?php else : ?>
                                <option value="<?= $barang['id_barang']; ?>"><?= $barang['nama_barang']; ?> </option>
                            <?php endif; ?>
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
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_produksi')) ? 'is-invalid' : ''; ?>" id="tanggal_produksi" name="tanggal_produksi" oninvalid="this.setCustomValidity('Masukkan tanggal_produksi stok berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $hasilproduksi->tanggal_produksi; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal_produksi'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" oninvalid="this.setCustomValidity('Masukkan jumlah beli Supplier berupa angka!')" oninput="this.setCustomValidity('')" value="<?= $hasilproduksi->jumlah_hasil_produksi; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $hasilproduksi->id_hasil_produksi; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>