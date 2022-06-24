<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<section class="section">
    <main>
        <div class="container">
            <div class="main-content container-fluid">
                <div class="section-header">
                    <h1>Daftar User</h1>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <div id="lihatdata"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>


<?= $this->Endsection("content") ?>