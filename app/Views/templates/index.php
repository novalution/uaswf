<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Website Peminjaman Laboratorium PTIK</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="<?= base_url('css/mdb.min.css') ?>" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>" />
    <link href="<?= base_url('/datatables/datatables.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('/datatables/datatables.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--Main Navigation-->
    <?= $this->include('templates/navbar') ?>
    <!--Main Navigation-->

    <!--Main layout-->
    <!-- Main Content -->
    <?= $this->renderSection('content'); ?>
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript" src="<?= base_url('js/mdb.min.js') ?>"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="<?= base_url('js/admin.js') ?>"></script>


</body>
<script>
    function tampilData() {
        $.ajax({
            url: "<?= base_url('/admin/data') ?>",
            dataType: "json",
            success: function(response) {
                $('#viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        tampilData();
    });
</script>
<!-- <script type="text/javascript" src="<?= base_url('/node_modules/sweetalert2/dist/sweetalert2.min.js'); ?>"></script> -->

</html>
