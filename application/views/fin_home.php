<?php $this->load->view('file/header') ?>

<body onload="alert_swal()">
    <?php $this->load->view('file/head-panel') ?>
    <div class="container my-5">
        <div class="row">
            <div class="text-start col">
                <h3>Your Finance Resume</h3>
            </div>
            <div class="text-end col">
                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="text-center mt-5">
            <!-- <div class="card"> -->
            <a href="#" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-tent-arrow-left-right"></i> Transaction</a>
            <a href="<?= base_url('Transaction') ?>" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-tent-arrow-left-right"></i> Transaction</a>
            <!-- </div> -->
        </div>
    </div>
    <?php $this->load->view('file/footer') ?>
</body>

</html>