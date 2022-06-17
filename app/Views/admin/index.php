<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<section class="section">
    <main style="margin-top: 58px">
        <div class="container">
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="card">
                            <h5 class="card-header">User List</h2>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <?php if (session()->getFlashdata('pesan')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= session()->getFlashdata('pesan'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div id="viewdata"></div>
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

<?= $this->Endsection("content") ?>