<div class="container">
    <div class="row ">
        <table id="datatables" class="table table-bordered">
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

                foreach ($list as $item) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item->kode ?></td>
                        <td><?= $item->nama ?></td>
                        <td><?= $item->nama_lab ?></td>
                        <td><?= $item->tanggal ?></td>
                        <td><?= $item->jam_mulai . ' - ' . $item->jam_selesai ?></td>
                        <td><?= $item->biaya ?></td>
                        <td>
                            <?php if ($item->status == 'unverif') { ?>
                                <p style="color:orange" class="fw-bold">Reservasi belum dikonfrimasi</p>
                            <?php } elseif ($item->status == 'verif') { ?>
                                <p style="color:green" class="fw-bold">Reservasi telah diterima</p>
                            <?php } else { ?>
                                <p style="color:red" class="fw-bold">Reservasi ditolak</p>
                        </td>
                        <td>
                        </td>
                    </tr>
            <?php
                            }
                        } ?>
            </tbody>
        </table>

    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable();
    });
</script>