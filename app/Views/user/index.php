<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<section>
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Hello, <?= user()->username; ?> !</strong></h5>
                </div>
                <div class="card-body">
                    <h1>Biodata <?= user()->username; ?></h1>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <td>Nama</td>
                                    <td> <?= user()->fullname; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> <?= user()->alamat; ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat Tanggal Lahir</td>
                                    <td> <?= user()->tempat_lahir . '/' . user()->tanggal_lahir; ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td> <?= user()->jenis_kelamin; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> <?= user()->email; ?></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td> <?= user()->telepon; ?></td>
                                </tr>
                                <tr>
                                    <td>Terdaftar Sejak</td>
                                    <td> <?= user()->created_at; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 ">
                                    <img src="<?= base_url() ?>\img\<?= user()->user_image; ?>" alt="" width="100%">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6"><a href="#" class="btn btn-warning btn-block">Edit</a></div>
                                <div class="col-md-6"><a href="#" class="btn btn-danger btn-block">Delete</a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</section>
<?= $this->endSection('content'); ?>