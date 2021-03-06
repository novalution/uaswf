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
                    <h1>Biodata <?= $user->username; ?></h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <td class="fw-bold">Nama</td>
                                    <td> <?= $user->fullname; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Role</td>
                                    <td> <?= $user->name; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Alamat</td>
                                    <td> <?= $user->alamat; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tempat Tanggal Lahir</td>
                                    <td> <?= $user->tempat_lahir . '/' . $user->tanggal_lahir; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jenis Kelamin</td>
                                    <td> <?= $user->jenis_kelamin; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email</td>
                                    <td> <?= $user->email; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Telepon</td>
                                    <td> <?= $user->telepon; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Terdaftar Sejak</td>
                                    <td> <?= $user->created_at; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 ">
                                    <img src="<?= base_url() ?>\img\<?= $user->user_image; ?>" alt="" width="100%">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col"><a href="<?= base_url('admin/users/edit/' . $user->userid) ?>" class="btn btn-warning btn-block">Edit</a></div>
                                <?php if (user()->username != $user->username) { ?>
                                    <div class="col">

                                        <form action="<?= base_url() ?>/admin/users/delete/<?= $user->userid; ?>" method="delete" id="delet">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</section>
<script>
    $('#delet').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            success: function(response) {
                var respon = JSON.parse(response);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                            window.location.href = 'admin/users'
                        )
                    }
                })
            }
        });
    })
</script>
<?= $this->endSection('content'); ?>