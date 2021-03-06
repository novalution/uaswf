<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"></div>

<section class="section">
    <main style="margin-top: 58px">
        <div class="container">
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="card">
                            <h5 class="card-header">Edit User Profile</h5>
                            <div class="card-body">
                            <form action="<?= base_url('user/update/' . user()->id) ?>" method="post" enctype="multipart/form-data" id="form">
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field() ?>
                                <div class="form-group mb-2">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Nama Belakang" value="<?= user()->fullname; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="alamat">Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"><?= user()->alamat; ?></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= user()->tempat_lahir; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= user()->tanggal_lahir; ?>">
                                </div>
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" form="form" class="form-select form-control">
                                            <option value="Laki-laki" <?php if ($user->jenis_kelamin == "Laki-laki") {echo "selected";}?>>Laki-laki</option>
                                            <option value="Perempuan" <?php if ($user->jenis_kelamin == "Perempuan") {echo "selected";}?>>Perempuan</option>
                                        </select>
                                <div class="form-group mb-2">
                                    <label for="telepon">No Telepon</label>
                                    <input type="text" class="form-control" name="telepon" placeholder="No Telepon" value="<?= user()->telepon; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= user()->email; ?>">
                                    <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="username"><?= lang('Auth.username') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= user()->username ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="password"><?= lang('Auth.password') ?></label>
                                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                    <small id="passwordHelp" class="form-text text-muted">Minimum 8 characters.</small>
                                </div>
                                <div class="align-items-center mb-4">
                                    <label for="user_image" class="col-form-label">Foto</label>
                                    <input type="file" class="form-control" id="user_image" name="user_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    <small id="imageHelp" class="form-text text-muted">Maximum size 500KB.</small>
                                </div>
                                <br>
                                <input type="hidden" id="passlama" name="passlama" value="<?= user()->password_hash; ?>" />
                                <input type="hidden" id="avalama" name="avalama" value="<?= user()->user_image; ?>" />
                                <button type="submit" id="submit" class="btn btn-primary mb-4">Update Data</button>
                            </form>

                            <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<?= $this->endSection('content'); ?>