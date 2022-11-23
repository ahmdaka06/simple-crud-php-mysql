<?php 
require_once '../init.php';
set_page('Login');
include '../apps/auth/register.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ahmad Andika X Dolanankode">
    <title><?= $config['base']['app']['name'] ?> · <?= get_page() ?? 'Page' ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset('css/style.css'); ?>" rel="stylesheet">
    <meta name="theme-color" content="#7952b3">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 500px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

</head>

<body>
    <main class="form-signin w-100 m-auto">
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
            <?= alert() ?>
            <div class="form-floating mt-2">
                <input type="text" class="form-control" name="name" placeholder="Full Name">
                <label for="username">Full Name</label>
            </div>
            <div class="form-floating mt-2">
                <input type="text" class="form-control" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <p>Sudah memiliki akun ?? <a href="<?= base_url('auth/login') ?>" class="mx-auto" style="text-decoration: none;">Login</a></p>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            <p class="mt-5 mb-3 text-muted text-center"><?= $config['base']['app']['name'] ?> &copy; <?= date('Y') ?></p>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js">
    </script>
</body>

</html>