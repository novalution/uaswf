<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<?php 
    function sensorName($name)
    {
        $realName = explode(" ", $name);
        $sensoredName = [];
        foreach ($realName as $part) {
            $sensoredPart = substr($part, 0, 1).str_repeat("*", strlen($part)-1);
            array_push($sensoredName, $sensoredPart);
        }
        return implode(" ", $sensoredName);

    }
?>

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
                                            <th>Nama Penyewa</th>
                                            <th>Nama Lab</th>
                                            <th>Tanggal Reservasi</th>
                                            <th>Jam Reservasi</th>
                                            <th>Biaya</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        foreach ($rsvp as $item) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $item->kode ?></td>
                                                <td><?= sensorName($item->nama) ?></td>
                                                <td><?= $item->nama_lab ?></td>
                                                <td><?= $item->tanggal ?></td>
                                                <td><?= $item->jam_mulai . ' - ' . $item->jam_selesai ?></td>
                                                <td><?= $item->biaya ?></td>
                                                <td>
                                                    <?php if ($item->status == 'unverif') { ?>
                                                        <p style="color:orange" class="fw-bold">Reservasi belum dikonfirmasi</p>
                                                    <?php } elseif ($item->status == 'verif') { ?>
                                                        <p style="color:green" class="fw-bold">Reservasi telah diterima</p>
                                                    <?php } else { ?>
                                                        <p style="color:red" class="fw-bold">Reservasi ditolak</p>
                                                </td>
                                            </tr>
                                    <?php
                                                    }
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