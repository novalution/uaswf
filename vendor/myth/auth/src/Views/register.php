<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <div class="card">
                <h2 class="card-header"><?= lang('Auth.register') ?></h2>
                <div class="card-body">

                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <form action="<?= route_to('register') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" value="<?= old('fullname') ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?= old('alamat') ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= old('tempat_lahir') ?>">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= old('tanggal_lahir') ?>">
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
                            <input type="text" class="form-control" name="telepon" placeholder="No Telepon" value="<?= old('telepon') ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>
                        <div class="form-group">
                            <label for="role">Instansi:</label>
                            <select name="role" id="role">
                                <option value="user_uns">UNS</option>
                                <option value="user_non_uns">non UNS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                            <small id="passwordHelp" class="form-text text-muted">Minimum 8 characters.</small>
                        </div>

                        <div class="form-group">
                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                        <div class="align-items-center mb-4">
                            <label for="user_image" class="col-form-label">Foto</label>
                            <input type="file" class="form-control" id="user_image" name="user_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <small id="imageHelp" class="form-text text-muted">Maximum size 500KB.</small>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                    </form>


                    <hr>

                    <p><?= lang('Auth.alreadyRegistered') ?> <a href="<?= route_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
