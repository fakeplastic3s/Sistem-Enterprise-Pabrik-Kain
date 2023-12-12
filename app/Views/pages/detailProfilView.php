<?= $this->extend('layout/template') ?>


<?= $this->section('content') ?>
<section class="section dashboard">

    <div class="container ">
        <div class="row justify-content-center">
            <div class="card w-75">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="row">
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="card-body  ">
                            <img src="<?= base_url(); ?>/assets/img/profil.webp" alt="" width="90px">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>
                                        <h5 class=" card-title">Profil Akun</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">
                                        <i class="bi bi-person"></i> Username
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?= session()->get('user_name'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">
                                        <i class="bi bi-envelope"></i> E-mail
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?= session()->get('user_email'); ?>
                                    </td>
                                </tr>
                            </table>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>
<?= $this->endSection(); ?>