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
    <div class="row ">
        <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
            <a href="<?= base_url('KebutuhanPerawatan/tambah'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i></a>
            <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
            <a href="<?= base_url('KebutuhanPerawatan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
        </div>
        <div class="col me-2 pb-3">

            <form class="d-flex" role="search" action="KebutuhanPerawatan" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="cari">
                <button class="btn btn-outline-success cari" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="card pt-4">
        <div class="card-body">
            <!-- Table with stripped rows -->
            <div class="table-responsive-md">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama mesin</th>
                            <th scope="col">Kebutuhan Perawatan</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getKebutuhanPerawatan as $isi) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-right"><?= $isi['nama_mesin']; ?></td>
                                <td class="text-right"><?= $isi['kebutuhan_perawatan']; ?></td>
                                <td class="text-center" <?= ($isi['status'] == 'Disetujui') ? 'style="color: green;"' : (($isi['status'] == 'Ditolak') ? 'style="color: red;"' : '') ?>><?= $isi['status']; ?></td>
                                <?php if ($isi['status'] == 'Diajukan') { ?>
                                    <td>
                                        <a href="<?= base_url('/KebutuhanPerawatan/edit/' . $isi['id_kebutuhan_perawatan']); ?>" class="btn btn-success btn-sm"><i class="ri-clipboard-line"></i></a>
                                        <form action="/KebutuhanPerawatan/hapus/<?= $isi['id_kebutuhan_perawatan']; ?>" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data kebutuhan perawatan?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                <?php } ?>
                                <?php if ($isi['status'] == 'Ditolak' or $isi['status'] == 'Disetujui') { ?>
                                    <td>
                                        <button class="btn btn-success btn-sm" disabled><i class="ri-clipboard-line"></i></button>
                                        <form action="/KebutuhanPerawatan/hapus/<?= $isi['id_kebutuhan_perawatan']; ?>" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data kebutuhan perawatan?')" class="btn btn-danger btn-sm" disabled><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                <?php } ?>

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