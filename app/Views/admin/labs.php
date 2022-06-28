<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<section class="section">
    <main style="margin-top: 58px">
        <div class="container">
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="card">
                            <h5 class="card-header">Lab List</h2>
                            <div class="card-body">
                                <div class="container">
                                    <div data-component="datatable" class="table-responsive" data-search="true">
                                        <table id="datatable" class="table table-bordered table-striped align-middle" style="text-align:center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Image</th>
                                                    <th>Lab Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;

                                                foreach ($labs as $item) {?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><img src="<?= base_url() ?>\img\<?= $item->lab_image ?>" alt="" width="250px"></td>
                                                            <td><?= $item->lab_name ?></td>
                                                            <td class="fw-bold" style="color:<?php if ($item->status == "open") {
                                                                echo "green";
                                                            } else {
                                                                echo "red";}?>
                                                           "><?= ucfirst($item->status) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('admin/labs/' . $item->lab_id) ?>" class="btn btn-primary btn-block">Detail</a>
                                                            </td>
                                                        </tr>
                                                <?php };?>
                                            </tbody>
                                        </table>
                                    </div>
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
    $(function () {
        $('#datatable').DataTable();
    });
</script>

<?= $this->Endsection("content") ?>