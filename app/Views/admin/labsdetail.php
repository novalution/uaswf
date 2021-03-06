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
                    <h1>Lab Detail</h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <td class="fw-bold">Lab Name</td>
                                    <td> <?= $lab->lab_name; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Capacity</td>
                                    <td> <?= $lab->capacity; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status</td>
                                    <td style="color:<?php if ($lab->status == "open") {
                                                            echo "green";
                                                        } else {
                                                            echo "red";
                                                        } ?>
                                                           "> <?= ucfirst($lab->status); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Description</td>
                                    <td> <?= $lab->description ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 ">
                                    <img src="<?= base_url() ?>\img\<?= $lab->lab_image; ?>" alt="" width="250px">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col"><a href="<?= base_url('admin/labs/edit/' . $lab->lab_id) ?>" class="btn btn-warning btn-block">Edit</a></div>
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
    $('#delete').submit(function(e) {
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
                            window.location.href = 'admin/labs'
                        )
                    }
                })
            }
        });
    })
</script>
<?= $this->endSection('content'); ?>