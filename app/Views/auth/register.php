<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="<?= base_url('css/mdb.min.css') ?>" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>" />
    <link href="<?= base_url('/datatables/datatables.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('/datatables/datatables.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <h2 class="card-header"><?= lang('Auth.register') ?></h2>
        <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= route_to('register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="namadepan" class="col-form-label">Nama Depan</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="namadepan" class="form-control" name="namadepan" autofocus>
                    <div class="invalid-feedback" id="errornamadepan"></div>
                </div>

            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="namabelakang" class="col-form-label">Nama Belakang</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="namabelakang" class="form-control" name="namabelakang">
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="alamat" class="col-form-label">Alamat</label>
                </div>
                <div class="col-auto">
                    <textarea type="text" id="alamat" class="form-control" name="alamat"></textarea>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="tempat_lahir" class="form-control" name="tempat_lahir">
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="tanggal_lahir" class="form-control" name="tanggal_lahir">
                </div>
            </div>
            <div class="form-check form-check-inline mb-4 mx-3">
                Jenis Kelamin :
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="flexRadioDefault1" value="Laki-Laki" checked />
                <label class="form-check-label" for="flexRadioDefault1"> Laki-laki </label>
            </div>
            <div class="form-check form-check-inline mb-4 mx-3">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="flexRadioDefault2" value="Perempuan" />
                <label class="form-check-label" for="flexRadioDefault2"> Perempuan </label>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="telepon" class="col-form-label">Telepon</label>
                </div>
                <div class="col-auto">
                    <input type="int" id="telepon" class="form-control" name="telepon">
                    <div class="invalid-feedback" id="errortelepon"></div>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="email" class="col-form-label">Email</label>
                </div>
                <div class="col-auto">
                    <input type="email" id="email" class="form-control" name="email">
                    <div class="invalid-feedback" id="erroremail"></div>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="username" class="col-form-label">Username</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="username" class="form-control" name="username">
                    <div class="invalid-feedback" id="erroruname"></div>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="password" class="form-control" name="password">
                    <div class="invalid-feedback" id="errorpass"></div>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="kpass" class="col-form-label">Konfrimasi Password</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="kpass" class="form-control" name="kpass">
                    <div class="invalid-feedback" id="errorkpass"></div>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <label for="user_image" class="col-form-label">Foto</label>
                </div>
                <div class="col-auto">
                    <input type="file" class="form-control" id="user_image" name="user_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <div class="invalid-feedback" id="errorava"></div>
                </div>
            </div>
            <div class="align-items-center mb-4">
                <div class="col-auto">
                    <button id="submit" type="submit" class="btn btn-success my-3"><?= lang('Auth.register') ?></button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>