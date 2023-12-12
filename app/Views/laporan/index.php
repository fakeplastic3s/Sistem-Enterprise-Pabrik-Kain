<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Pilih Periode</div>
                <div class="card-body">
                    <p class="card-text">
                    <form action="/Laporan/cetakPenjualanPeriode" action="POST" class="user" target="_blank">
                        <div class="form-group mb-3">
                            <label for="tglawal"> Tanggal Awal</label>
                            <input type="date" name="tglawal" id="tglawal" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tglakhir"> Tanggal Akhir</label>
                            <input type="date" name="tglakhir" id="tglakhir" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-block btn-success"><i class="fa fw fa-print"></i> Cetak Laporan</button>
                        </div>
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>


</div>

<?= $this->endSection(); ?>