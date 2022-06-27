<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<section class="section">
    <main>
        <div class="container">
            <div class="main-content container-fluid mt-5">
                <div class="card px-3 py-3">
                    <div class="section-header">
                        <h1>Daftar Reservasi</h1>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div data-component="datatable" class="table-responsive" data-search="true">
                                <table id="datatable" class="table table-bordered table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Reservasi</th>
                                            <th>Nama</th>
                                            <th>Nama Lab</th>
                                            <th>Tanggal Reservasi</th>
                                            <th>Waktu Mulai Reservasi</th>
                                            <th>Waktu Selesai Reservasi</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        foreach ($status as $item) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $item->kode ?></td>
                                                <td><?= $item->nama ?></td>
                                                <td><?= $item->nama_lab ?></td>
                                                <td><?= $item->tanggal ?></td>
                                                <td><?= $item->jam_mulai ?></td>
                                                <td><?= $item->jam_selesai ?></td>
                                                <td><?= $item->email ?></td>
                                                <td>
                                                    <?php if ($item->status == 'unverif') { ?>
                                                        <form action="<?= base_url() ?>/admin/acc/accept/<?= $item->id_reservasi; ?>" method="GET">
                                                            <button type="submit" class="btn btn-success btn-block">Terima Reservasi</button>
                                                        </form>
                                                        <form action="<?= base_url() ?>/admin/acc/reject/<?= $item->id_reservasi; ?>" method="GET">
                                                            <button type="submit" class="btn btn-danger btn-block">Tolak Reservasi</button>
                                                        </form>
                                                    <?php } elseif ($item->status == 'verif') { ?>
                                                        <p style="color:green" class="fw-bold">Reservasi telah diterima.</p>
                                                    <?php } else { ?>
                                                        <p style="color:red" class="fw-bold">Reservasi ditolak</p>
                                                </td>

                                            </tr>
                                    <?php }
                                                } {;
                                                } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<script>
    $(function() {
        $('#datatable').DataTable();
    });
</script>


<?= $this->Endsection("content") ?>