
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Peta Tematik Rembang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>/sb-admin/dist/css/styles.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>lib/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>/sb-admin/dist/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        html {
            font: 12px;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Tematik Rembang</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <!-- Navbar-->
        
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu::</div>
                        <a class="nav-link" href="<?php echo base_url(); ?>site/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Peta
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>site/peta_kab_by_kec">Tematik Per Kec</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>site/non_tematik">Non Tematik</a>
                            </nav>
                        </div>
                        <?php
                        if ($this->session->userdata('Nama')) {
                        ?>

                            <a class="nav-link" href="<?php echo base_url(); ?>site/variabel">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Variabel
                            </a>
                            <a class="nav-link" href="<?php echo base_url(); ?>site/input_data">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Input Data
                            </a>
                        <?php

                        }
                        ?>

                        <?php
                        if (!$this->session->userdata('Nama')) {
                        ?>

                            <a class="nav-link" href="<?php echo base_url(); ?>site/login">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Login
                            </a>
                        <?php

                        }

                        ?>

                        <?php
                        if ($this->session->userdata('Nama')) {
                        ?>

                            <a class="nav-link" href="<?php echo base_url(); ?>site/logout">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Logout
                            </a>
                        <?php

                        }

                        ?>

                    </div>


                </div>
                <div class="sb-sidenav-footer">
                    </div>

            </nav>

        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h2 class="mt-4"><?php echo $judulMenu; ?></h2>
                    <?php $this->load->view(
                        $menu,
                        [
                            "daftarVariabel" => $daftarVariabel,
                            "daftarKecamatan" => $daftarKecamatan
                        ]
                    ); ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; BPS Kab Rembang 2021</div>
                        <div>

                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

</body>

</html>