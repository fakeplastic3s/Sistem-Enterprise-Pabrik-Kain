<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Akun</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />


    <!-- Style CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css" />
    <link href="<?= base_url(); ?>/assets/img/aw1.png" rel="icon">

</head>

<body>
    <div class="background-register d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-form">
                        <div class="row">
                            <div class="col left px-5 py-5">
                                <div class="header">
                                    <h2 class="r">Register</h2>
                                    <p>Silahkan daftar akun anda!</p>
                                    <?php if (isset($validation)) : ?>
                                        <div> <?= $validation->ListErrors(); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form">
                                    <form class="user" action="/register/save" method="POST">
                                        <div class="input-fields mb-3">
                                            <input type="text" name="name" id="username" placeholder="Nama Pengguna" value="<?= set_value('name'); ?>" required />
                                            <i class="uil uil-user icon"></i>
                                        </div>
                                        <div class="input-fields mb-3">
                                            <input type="email" name="email" id="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>" required />
                                            <i class="uil uil-envelope icon"></i>
                                        </div>
                                        <div class="row g-0 d-flex justify-content-between">

                                            <div class="input-fields mb-3 me-3 col-md-5">
                                                <input type="password" id="exampleInputPassword" placeholder="Password" name="password" required />
                                                <i class="uil uil-lock icon"></i>
                                                <!-- <i class="uil uil-eye-slash showHidePw"></i> -->
                                            </div>
                                            <div class="input-fields mb-3 col-md-6">
                                                <input type="password" id="exampleRepeatPassword" placeholder="Repeat Password" name="confpassword" required />
                                                <i class="uil uil-lock-alt icon"></i>
                                                <!-- <i class="uil uil-eye-slash showHidePw"></i> -->
                                            </div>
                                        </div>
                                        <div class="input-fields mb-3 button">
                                            <input type="submit" value="Register" />
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="<?= base_url('Login'); ?>">Sudah punya akun? Login!</a>
                                    </div>
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