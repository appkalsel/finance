<script src="<?= base_url() ?>vendors/popper/popper.min.js"></script>
<script src="<?= base_url() ?>vendors/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url() ?>vendors/anchorjs/anchor.min.js"></script>
<script src="<?= base_url() ?>vendors/is/is.min.js"></script>
<script src="<?= base_url() ?>vendors/lodash/lodash.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="<?= base_url() ?>vendors/prism/prism.js"></script>
<script src="<?= base_url() ?>vendors/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/theme.js"></script>

<script src="<?= base_url() ?>assets/js/jquery-3.6.3.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/fontawesome.min.js" integrity="sha512-nKvEIGRKw2OQCR34yLfnWnvrOBxidLG9aK+vzsBxCZ/9ZxgcS4FrYcN+auWUTkCitTVZAt82InDKJ7x+QtKu6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!-- ALERT -->
<script>
    function alert_swal() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            timer: 4000,
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        if ("<?= $this->session->flashdata('alert') ?>" == "error") {
            Toast.fire({
                icon: 'error',
                title: 'Gagal! Ada Kesalahan!',
            })
        } else if ("<?= $this->session->flashdata('alert') ?>" == "add") {
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Tambah Data!',
            })
        } else if ("<?= $this->session->flashdata('alert') ?>" == "edit") {
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Mengubah Data!',
            })
        } else if ("<?= $this->session->flashdata('alert') ?>" == "hapus") {
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Hapus Data!',
            })
        } else if ("<?= $this->session->flashdata('alert') ?>" == "login") {
            Toast.fire({
                icon: 'success',
                title: 'Selamat Datang!',
            })
        }
    }

    $(".hapus").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            // text: "Tindakan ini tidak bisa diurungkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yeah!'
        }).then((result) => {
            if (result.isConfirmed) {
                val = $('.hapus').val();
                // alert($(this).data("href") + val);
                window.location = $(this).data("href") + val;
            }
        })
    });
</script>