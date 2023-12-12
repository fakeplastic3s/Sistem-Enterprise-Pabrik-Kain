<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section dashboard">
    <div class="row ">
        <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
            <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
        </div>

    </div>

    <div class="card pt-4">
        <div class="card-body">

            <!-- Table with stripped rows -->
            <div class="table-responsive-md">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Bahan Mentah</th>
                            <th scope="col">Jumlah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getBahanMentah as $isi) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-right"><?= $isi['nama_bahan_mentah']; ?></td>
                                <td class="text-center"><?= number_format($isi['jumlah_stok'], 0, ",", "."); ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->
            <h6 class="text-end"> Tanggal Terakhir Bahan Masuk : <?= format_tanggal($lastDate->tanggal_masuk); ?></h6>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>