<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<section class="section">
    <main>
        <div class="container">
            <div class="main-content container-fluid">
                <div class="section-header">
                    <h1>Daftar Reservasi</h1>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama_Lab</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Waktu Mulai Reservasi</th>
                                    <th>Waktu Selesai Reservasi</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                foreach ($status as $item) {
                                    if ($item->status == 'unverif') { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $item->nama ?></td>
                                            <td><?= $item->nama_lab ?></td>
                                            <td><?= $item->tanggal ?></td>
                                            <td><?= $item->jam_mulai ?></td>
                                            <td><?= $item->jam_selesai ?></td>
                                            <td><?= $item->email ?></td>
                                            <td><?= $item->status ?></td>
                                            <td>
                                                <form action="<?= base_url() ?>/admin/acc/accept/<?= $item->id_reservasi; ?>" method="GET">
                                                    <button type="submit" class="btn btn-success btn-block">Terima Reservasi</button>
                                                </form>
                                                <form action="<?= base_url() ?>/admin/acc/reject/<?= $item->id_reservasi; ?>" method="delete" id="delet">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <?= csrf_field(); ?>
                                                    <button type="submit" class="btn btn-danger btn-block">Tolak Reservasi</button>
                                                </form>
                                            </td>

                                        </tr>
                                <?php } else {;
                                    }
                                }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>


<?= $this->Endsection("content") ?>