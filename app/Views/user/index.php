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
                                    <td class="fw-bold">Nama</td>
                                    <td> <?= user()->fullname; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Alamat</td>
                                    <td> <?= user()->alamat; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tempat Tanggal Lahir</td>
                                    <td> <?= user()->tempat_lahir . '/' . user()->tanggal_lahir; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jenis Kelamin</td>
                                    <td> <?= user()->jenis_kelamin; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email</td>
                                    <td> <?= user()->email; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Telepon</td>
                                    <td> <?= user()->telepon; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Terdaftar Sejak</td>
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
                                <div class="col"><a href="<?= base_url('user/edit/' . user()->id) ?>" class="btn btn-warning btn-block">Edit</a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="viewmodal" style="display: none;"></div>
    </main>
</section>
<script>
    function edit(id) {
        $.ajax({
            url: "<?= base_url('/user/edit') ?>/" + id,
            dataType: "json",
            success: function(response) {
                $('#viewmodal').html(response.data).show();
                $('#editmodal').modal('show');
            }
        });
    }
</script>
<?= $this->endSection('content'); ?>