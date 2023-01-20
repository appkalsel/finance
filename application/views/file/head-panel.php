<nav class="navbar navbar-expand-lg sticky-top navbar-dark shadow bg-dark" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="index.html"><img src="<?= base_url() ?>assets/img/Logo.png" alt="" /></a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars text-white fs-3"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <?php if ($this->session->userdata('login')) { ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('Home') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= base_url('Transaction') ?>">Transaction</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="blogs.html">Blogs</a></li>
                    <li class="nav-item mt-2 mt-lg-0"><a class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" href="<?= base_url('Auth/logout') ?>">Log Out</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="blogs.html">Blogs</a></li>
                    <li class="nav-item mt-2 mt-lg-0"><a class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" href="<?= base_url('Auth') ?>">Log In</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>