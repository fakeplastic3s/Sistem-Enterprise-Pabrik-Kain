<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />


    <!-- Style CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css" />
    <link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">

</head>

<body>
    <div class="background d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-form">
                        <div class="row">
                            <div class="col left px-5 py-5">
                                <div class="header">
                                    <h2 class="login">Login</h2>
                                    <p>Senang melihat anda kembali!</p>
                                    <?php if (session()->getFlashdata('msg')) : ?>
                                        <div class="alert alert-danger"> <?= session()->getFlashdata('msg'); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form">
                                    <form class="user" action="/login/auth" method="POST">
                                        <div class="input-fields mb-3">
                                            <input type="email" name="email" id="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>" required />
                                            <i class="uil uil-envelope icon"></i>
                                        </div>
                                        <div class="input-fields mb-3">
                                            <input type="password" name="password" id="password" placeholder="Masukkan Password" required />
                                            <i class="uil uil-lock icon"></i>
                                            <!-- <i class="uil uil-eye-slash showHidePw"></i> -->
                                        </div>
                                        <!-- <div class="checkbox d-flex justify-content-between mb-4">
                                            <div class="checkbox-content d-flex align-items-center">
                                                <input type="checkbox" name="logCheck" id="logCheck" class="mx-1" />
                                                <label for="logCheck" class="text mx-1">Ingat Saya</label>
                                            </div>

                                            <a href="" class="text">Lupa Password?</a>
                                        </div> -->
                                        <div class="input-fields mb-3 button">
                                            <input type="submit" value="Login" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>