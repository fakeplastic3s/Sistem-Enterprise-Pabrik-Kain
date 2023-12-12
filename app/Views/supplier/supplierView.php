<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section dashboard">
    <?php if (session()->getFlashdata('pesan_tambah')) : ?>
        <div class="alert alert-success my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_tambah'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_hapus')) : ?>
        <div class="alert alert-danger my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_hapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_edit')) : ?>
        <div class="alert alert-primary my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_edit'); ?>
        </div>
    <?php endif; ?>


    <div class="card pt-4">
        <div class="card-body">
            <div class="row ">
                <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
                    <a href="<?= base_url('supplier/tambahsupplier'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i></a>
                    <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
                    <a href="<?= base_url('supplier'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </div>
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->

            <div class="table-responsive-md">
                <table class="table table-striped datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-center ">#</th>
                            <th scope="col" class="text-center ">Nama Supplier</th>
                            <th scope="col" class="text-center ">Alamat</th>
                            <th scope="col" class="text-center ">Nama Barang</th>
                            <th scope="col" class="text-center ">Harga Satuan</th>
                            <th scope="col" class="text-center aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getSupplier as $isi) : ?>
                            <tr>
                                <td class="align-middle"><?= $no; ?></td>
                                <td class="text-right  align-middle"><?= $isi['nama_supplier']; ?></td>
                                <td class="text-right align-middle"><?= $isi['alamat']; ?></td>
                                <td class="text-right align-middle"><?= $isi['nama_barang']; ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan']); ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('supplier/edit/' . $isi['id_supplier']); ?>" class="btn btn-success btn-sm"><i class="ri-clipboard-line"></i></a>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
    </div>
</section>
<?= $this->endSection(); ?>