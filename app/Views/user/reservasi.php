<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<?php 
$closed_labs = [];
foreach ($closedLabs as $lab) {
    array_push($closed_labs, $lab->lab_id);
}
?>

<section>
    <main style="margin-top: 58px">
        <div id="booking" class="section">
            <div class="section-center">
                <div class="container">
                    <div class="row">
                        <div class="booking-form">
                            <div class="form-header">
                                <h1>Make your reservation</h1>
                            </div>
                            <form action="<?= base_url('user/pesan') ?>" method="post" id="book">
                                <input class="form-control" value="<?= user()->id; ?>" type="text" name="id_user" id="id_user" hidden>
                                <div class="form-group"> <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Lengkap"> <span class="form-label">Nama Lengkap</span> </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-group"> <input class="form-control" type="date" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>" max="<?= date('Y-m-d', strtotime('+2 week')) ?>" id="tanggal" name="tanggal"> <span class="form-label">Tanggal Reservasi</span> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <div class="form-group"> <select class="form-control" required id="jam" name="jam">
                                                <option value="" selected hidden>Pilih Waktu</option>
                                                <?php
                                                foreach ($waktu as $item) { ?>
                                                    <option value="<?= $item->mulai ?>|<?= $item->berakhir ?>"><?= $item->text ?></option>
                                                    <option hidden></option>
                                                <?php }; ?>
                                            </select> <span class="select-arrow"></span> <span class="form-label">Waktu</span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="form-group"> <select class="form-control" required id="lab" name="lab">
                                                <option value="" selected hidden>Pilih Lab</option>
                                                <?php if (!in_array(0, $closed_labs)) {?>
                                                    <option>Software Engineering</option>
                                                <?php ;}?>
                                                <?php if (!in_array(1, $closed_labs)) {?>
                                                    <option>Multimedia</option>
                                                <?php ;}?>
                                                <?php if (!in_array(2, $closed_labs)) {?>
                                                    <option>Computer Network and Instrumentation</option>
                                                <?php ;}?>        
                                            </select> <span class="select-arrow"></span> <span class="form-label">Lab</span> </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <input class="form-control" type="email" name="email" id="email" placeholder="Enter your Email"> <span class="form-label">Email</span> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <input class="form-control" type="text" name="telepon" id="telepon" placeholder="Enter you Phone"> <span class="form-label">Phone</span> </div>
                                    </div>
                                    <?php if (in_groups('user_non_uns')) : ?>
                                        <div class="form-group"> <input class="form-control" type="text" value="50000" name="biaya" id="biaya" disabled> <span class="form-label">Biaya</span> </div>
                                    <?php else : ?>
                                        <div class="form-group"> <input class="form-control" type="text" value="0" name="biaya" id="biaya" disabled> <span class="form-label">Biaya</span> </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <p>Notes</p>
                                        <textarea class="form-control" type="text" id="notes" name="notes"> </textarea>
                                    </div>
                                </div>
                                <button type="button" id="bookBtn" value="BOOK" name="book" class="btn submit-btn accept" onclick="myFunc()">BOOK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<script>
    function myFunc(){
        Swal.fire({
                    title: 'Are you sure?',
                    text: "Check your reservation data.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Create a Reservation'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#book').submit();
                    }
                })
    };
</script>
<?= $this->endSection('content'); ?>