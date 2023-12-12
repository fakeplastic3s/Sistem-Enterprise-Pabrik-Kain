<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<div id="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5 py-5 px-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4" id="login"> <mark> Change Account</mark></h1>
                                        <?php if (session()->getFlashdata('msg')) : ?>
                                            <div class="alert alert-danger"> <?= session()->getFlashdata('msg'); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <form class="user" action="/Ganti_Akun/auth" method="POST">
                                        <div class="form-group mb-4">
                                            <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email Address" name="email" value="<?= set_value('email'); ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password" required="true">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>