<div class="container">
    <div class="row">
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                foreach ($list as $item) {
                    if (empty($item->deleted_at)) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="<?= base_url() ?>\img\<?= $item->user_image ?>" alt="" width="100px"></td>
                            <td><?= $item->username ?></td>
                            <td><?= $item->email ?></td>
                            <td><?= $item->name ?></td>
                            <td>
                                <a href="<?= base_url('admin/' . $item->userid) ?>" class="btn btn-primary btn-block">Detail</a>
                                <!-- <br>
                                <form action="/admin/delete/<?= $item->userid; ?>" method="post" id="delet">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                <?php } else {;
                    }
                }  ?>
            </tbody>
        </table>

    </div>
</div>
<script>
    $('#delet').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            success: function(response) {
                var respon = JSON.parse(response);
                Swal.fire({
                    title: 'Berhasil!',
                    text: respon.sukses,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
                window.location.href = 'admin/index'
            }
        });
    })
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>