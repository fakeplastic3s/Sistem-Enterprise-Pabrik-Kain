<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=q, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- local css -->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>/assets/img/salad.png" rel="icon">

</head>
<style>
    /* tambah font eksternal */
    @font-face {
        font-family: sf;
        src: url('<?= base_url(); ?>/font/SF.ttf');
    }

    html,
    body {
        font-family: sf;
    }
</style>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card o-hidden border-0 shadow-lg my-5 py-5 px-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> <mark> Login</mark></h1>
                                        <?php if (session()->getFlashdata('msg')) : ?>
                                            <div class="alert alert-danger"> <?= session()->getFlashdata('msg'); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <form class="user" action="/login/auth" method="POST">
                                        <div class="form-group mb-4">
                                            <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email Address" name="email" value="<?= set_value('email'); ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password" required="true">
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary w-100">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> -->
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('Register'); ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>