<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <div class="card">
                <h2 class="card-header"><?= lang('Auth.register') ?></h2>
                <div class="card-body">

                    <form action="<?= base_url('admin/update/' . user()->id) ?>" method="post" enctype="multipart/form-data" id="form">
                        <input type="hidden" name="_method" value="PUT">

                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Nama Belakang" value="<?= user()->fullname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?= user()->alamat; ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= user()->tempat_lahir; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= user()->tanggal_lahir; ?>">
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
                        <div class="form-group">
                            <label for="telepon">No Telepon</label>
                            <input type="text" class="form-control" name="telepon" placeholder="No Telepon" value="<?= user()->telepon; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= user()->email; ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>
                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= user()->username ?>">
                        </div>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>
                        <div class="align-items-center mb-4">
                            <label for="user_image" class="col-form-label">Foto</label>
                            <input type="file" class="form-control" id="user_image" name="user_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                        <br>
                        <input type="hidden" id="passlama" name="passlama" value="<?= user()->password; ?>" />
                        <input type="hidden" id="avalama" name="avalama" value="<?= user()->user_image; ?>" />
                        <button type="submit" id="submit" class="btn btn-primary mb-4">Update Data</button>
                    </form>


                    <hr>

                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>