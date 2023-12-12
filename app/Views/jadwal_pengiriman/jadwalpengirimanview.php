<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section dashboard">
    <?php if (session()->getFlashdata('pesan_tambah')) : ?>
        <div class="alert alert-success my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('pesan_tambah'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_hapus')) : ?>
        <div class="alert alert-danger my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('pesan_hapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_edit')) : ?>
        <div class="alert alert-primary my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('pesan_edit'); ?>
        </div>
    <?php endif; ?>
    <div class="row ">
        <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
            <a href="<?= base_url('JadwalPengiriman/tambahJadwalPengiriman'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i></a>
            <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
            <a href="<?= base_url('JadwalPengiriman'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a>
        </div>
        <div class="col me-2 pb-3">

            <form class="d-flex" role="search" action="JadwalPengiriman" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="cari">
                <button class="btn btn-outline-success cari" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="card pt-4">
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pengirim</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jenis Kendaraan</th>
                            <th scope="col">Jumlah Pengiriman</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $no = 1 ?>
                        <?php foreach ($getJadwalPengiriman as $isi) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-right"><?= $isi['nama_pengirim']; ?></td>
                                <td class="text-center">
                                    <?php
                                    $tanggal = date('d M Y', strtotime($isi['tanggal_pengiriman']));
                                    echo $tanggal
                                    ?>
                                </td>
                                <td class="text-center"><?= $isi['alamat_tujuan']; ?></td>
                                <td class="text-center"><?= $isi['nama_barang']; ?></td>
                                <td class="text-center"><?= $isi['jenis_kendaraan']; ?></td>
                                <td class="text-center"><?= number_format($isi['jumlah_pengiriman'], 0, ",", "."); ?> yard
                                </td>
                                <td class="text-center" <?php if ($isi['status'] == 'Selesai') echo 'style="color: green;"'; ?>><?= $isi['status']; ?></td>
                                <td>
                                    <a href="<?= base_url('/JadwalPengiriman/edit/' . $isi['id_pengirim']); ?>" class="btn btn-success btn-sm"><i class="ri-clipboard-line"></i></a>
                                    <form action="/JadwalPengiriman/hapus/<?= $isi['id_pengirim']; ?>" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" onclick="javascript:return confirm('Apakah anda ingin menghapus data jadwal pengiriman?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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