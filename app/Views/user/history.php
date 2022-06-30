<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<section class="section">
    <main style="margin-top: 58px">
        <div class="container">
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="card">
                            <h5 class="card-header">My Reservation</h2>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div id="historydata"></div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<?php 
try {
    if ($status == "gagal") {
} 
?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'You have reached maximum daily reservation (5 hour)!'
    })
</script>
<?php }
catch (\Throwable $th) {
    //throw $th;
}?>



<?= $this->Endsection("content") ?>