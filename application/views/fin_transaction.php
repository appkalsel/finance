<?php $this->load->view('file/header') ?>

<body onload="alert_swal()">
    <?php $this->load->view('file/head-panel') ?>
    <div class="container my-5">
        <div class="row mb-3">
            <div class="text-start col-md-6">
                <h3><a href="<?= base_url('Home') ?>" class="text-warning"><i class="fa-solid fa-reply"></i></a> Your Finance Transaction Data</h3>
            </div>
            <div class="text-end col-md-6">
                <a href="#" class="btn btn-sm btn-outline-primary btn_add" data-bs-toggle="modal" data-bs-target="#modalForm"><i class="fa-solid fa-plus"></i> Tambah Data</a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFormtitle"></h5>
                                <button type="button" class="btn btn-sm btn-outline-danger hapus" data-href="<?= base_url('Transaction/delete_tr/') ?>" id="btn_hapus"><i class="fa-solid fa-trash"></i> Delete</button>
                            </div>
                            <input type="hidden" name="id" id="id" readonly>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="date" class="form-label">Date Time</label><br>
                                        <input type="datetime-local" class="form-control" name="date" id="date" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="title" class="form-label">Title</label><br>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title what you do" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="desc" class="form-label">Description</label><br>
                                        <input type="text" class="form-control" name="desc" id="desc" placeholder="Description What you do (optional)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="deb" class="form-label">Debit</label><br>
                                        <input type="number" min="0" class="form-control" name="deb" id="deb" placeholder="Money you've got" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="cre" class="form-label">Credit</label><br>
                                        <input type="number" min="0" class="form-control" name="cre" id="cre" placeholder="Money you spend" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->

        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Title & Description</th>
                        <th scope="col">Debit</th>
                        <th scope="col">Credit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tot_deb = 0;
                    $tot_cre = 0;
                    foreach ($data as $getTrans) {
                        $tot_deb += $getTrans->deb;
                        $tot_cre += $getTrans->cre;
                        $cre = number_format($getTrans->cre, 0, ".", ",");
                        $deb = number_format($getTrans->deb, 0, ".", ",");
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d F Y', strtotime($getTrans->date)) ?><br><small><i class="fa-regular fa-clock"></i> <?= date('H:i', strtotime($getTrans->date)) ?></small></td>
                            <td>
                                <div class="fw-bold"><?= $getTrans->title ?></div>
                                <?= $getTrans->desc ?>
                            </td>
                            <td class="text-end">
                                <span data-bs-toggle="tooltip" title="Klik untuk edit data">
                                    <a href="#" class="btn_edit" data-bs-toggle="modal" data-bs-target="#modalForm" data-id="<?= $getTrans->id ?>">
                                        <div><?= $deb ?></div>
                                    </a>
                                </span>
                            </td>
                            <td class="text-end">
                                <span data-bs-toggle="tooltip" title="Klik untuk edit data">
                                    <a href="#" class="btn_edit" data-bs-toggle="modal" data-bs-target="#modalForm" data-id="<?= $getTrans->id ?>">
                                        <div><?= $cre ?></div>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center">Total</th>
                        <th class="text-end"><?= number_format($tot_deb, 0, ".", ","); ?></th>
                        <th class="text-end"><?= number_format($tot_cre, 0, ".", ","); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php $this->load->view('file/footer') ?>
    <!-- <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: false,
                ordering: false,
            });
        });
    </script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $(".modal").on("hidden.bs.modal", function() { //reset form dalam
                $('.hapus').hide();
                $(this).find('form')[0].reset();
            });
            $('.btn_add').on('click', function() { //Banner Carousel
                $('.hapus').hide();
                $('#modalFormtitle').html('Tambah Data');
                $('.modal-content form').attr('action', '<?= base_url('Transaction/add_tr') ?>');
            });
            $('.btn_edit').on('click', function() {
                $('.hapus').show();
                $('#modalFormtitle').html('Edit Data');
                $('.modal-content form').attr('action', '<?= base_url('Transaction/edit_tr') ?>');

                const id = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('Transaction/get_tr') ?>",
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#btn_hapus').val(data.id);
                        $('#date').val(data.date);
                        $('#title').val(data.title);
                        $('#desc').val(data.desc);
                        $('#deb').val(data.deb);
                        $('#cre').val(data.cre);
                    },
                    error: function() {
                        console.error();
                    }
                });
            });
        });
    </script>
</body>

</html>