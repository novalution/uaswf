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
                            <h5 class="card-header">Add New Lab</h5>
                            <div class="card-body">
                                <form action="<?= base_url('admin/newLab/') ?>" method="post" enctype="multipart/form-data" id="form">
                                    <input type="hidden" name="_method" value="PUT">

                                    <?= csrf_field() ?>
                                    <div class="form-group mb-2">
                                        <label for="lab_name">Lab Name</label>
                                        <input type="text" class="form-control" name="lab_name" placeholder="Lab Name">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="capacity">Capacity</label>
                                        <input type="text" class="form-control" name="capacity" placeholder="Capacity">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" form="form" class="form-select form-control">
                                            <option value="open">Open</option>
                                            <option value="closed">Closed</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                                    </div>
                                    <div class="align-items-center mb-4">
                                        <label for="lab_image" class="col-form-label">Lab Image</label>
                                        <input type="file" class="form-control" id="lab_image" name="lab_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    </div>
                                    <br>
                                    <button type="submit" id="submit" class="btn btn-primary mb-4">Add Data</button>
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