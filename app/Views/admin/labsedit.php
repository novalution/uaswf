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
                            <h5 class="card-header">Edit Lab Details</h5>
                            <div class="card-body">
                                <form action="<?= base_url('admin/labUpdate/' . $lab->lab_id) ?>" method="post" enctype="multipart/form-data" id="form">
                                    <input type="hidden" name="_method" value="PUT">

                                    <?= csrf_field() ?>
                                    <div class="form-group mb-2">
                                        <label for="lab_name">Lab Name</label>
                                        <input type="text" class="form-control" name="lab_name" placeholder="Lab Name" value="<?= $lab->lab_name; ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="capacity">Capacity</label>
                                        <input type="text" class="form-control" name="capacity" placeholder="Capacity" value="<?= $lab->capacity; ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" form="form" class="form-select form-control">
                                            <option value="open" <?php if ($lab->status == "open") {echo "selected";}?>>Open</option>
                                            <option value="closed" <?php if ($lab->status == "closed") {echo "selected";}?>>Closed</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="status" placeholder="Status" value="<?= $lab->status; ?>"> -->
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" name="description" placeholder="Description"><?= $lab->description; ?></textarea>
                                    </div>
                                    <div class="align-items-center mb-4">
                                        <label for="lab_image" class="col-form-label">Lab Image</label>
                                        <input type="file" class="form-control" id="lab_image" name="lab_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    </div>
                                    <br>
                                    <input type="hidden" id="imglama" name="imglama" value="<?= $lab->lab_image; ?>" />
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