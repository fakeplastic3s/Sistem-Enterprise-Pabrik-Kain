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
                    <a href="<?= base_url('PengadaanBahan/tambah'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i></a>
                    <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
                    <a href="<?= base_url('PengadaanBahan'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </div>
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->

            <div class="table-responsive-md">
                <table class="table table-striped datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Bahan</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Tanggal Pengadaan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getPengadaan as $isi) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no; ?></td>
                                <td class="text-right align-middle"><?= $isi['nama_barang']; ?></td>
                                <td class="text-right align-middle"><?= $isi['nama_supplier']; ?></td>
                                <td class="text-center align-middle">
                                    <?= format_tanggal($isi['tanggal_pengadaan']); ?>
                                </td>
                                <td class="text-center align-middle"><?= $isi['jumlah']; ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan']); ?></td>
                                <td class="text-center align-middle"><?= format_rupiah($isi['harga_satuan'] * $isi['jumlah']); ?></td>
                                <td class="text-center align-middle" <?= ($isi['status'] == 'Disetujui') ? 'style="color: green;"' : (($isi['status'] == 'Ditolak') ? 'style="color: red;"' : '') ?>><?= $isi['status']; ?></td>

                                <?php if ($isi['status'] == 'Disetujui' or $isi['status'] == 'Ditolak') { ?>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm m-2" disabled><i class="ri-clipboard-line"></i></button>
                                        <form action="/PengadaanBahan/hapus/<?= $isi['id_pengadaan']; ?>" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data pengadaan bahan?')" class="btn btn-danger btn-sm" disabled><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                <?php } ?>
                                <?php if ($isi['status'] == 'Diajukan') { ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('PengadaanBahan/edit/' . $isi['id_pengadaan']); ?>" class="btn btn-success btn-sm m-2"><i class="ri-clipboard-line"></i></a>
                                        <form action="/PengadaanBahan/hapus/<?= $isi['id_pengadaan']; ?>" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data pengadaan bahan?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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