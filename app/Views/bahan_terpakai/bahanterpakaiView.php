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
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->
            <div class="row ">
                <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
                    <a href="<?= base_url('BahanTerpakai/tambah'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i></a>
                    <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
                    <a href="<?= base_url('BahanTerpakai'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </div>
            <div class="table-responsive-md">
                <table class="table table-striped datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-center ">#</th>
                            <th scope="col" class="text-center ">Nama Bahan Terpakai</th>
                            <th scope="col" class="text-center ">Tanggal Pakai</th>
                            <th scope="col" class="text-center ">Jumlah</th>
                            <th scope="col" class="text-center aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getBahanTerpakai as $isi) : ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-right"><?= $isi['nama_bahan_mentah']; ?></td>
                                <td class="text-center">
                                    <?php
                                    $tanggal = date('d M Y', strtotime($isi['tanggal_pakai']));
                                    echo $tanggal
                                    ?>
                                </td>
                                <td class="text-center"><?= number_format($isi['jumlah'], 0, ",", "."); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('BahanTerpakai/edit/' . $isi['id_bahan_terpakai']); ?>" class="btn btn-success btn-sm"><i class="ri-clipboard-line"></i></a>
                                    <form action="/BahanTerpakai/hapus/<?= $isi['id_bahan_terpakai']; ?>" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data bahan terpakai?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
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