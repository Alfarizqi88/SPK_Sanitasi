 <!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/charts/morris-bundle/morris.css">
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/IBM_Sanitasi.png">
    
</head>
<body>
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            <a class="nav-link" href="<?php echo base_url('c_admin') ?>">Dashboard</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('c_admin/data_alternatif') ?>"><i class="fa fa-fw fa-address-book"></i>Data Masyarakat</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fab fa-fw fa-readme"></i>Kriteria <span class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('c_admin/data_kriteria') ?>">Data Kriteria</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('c_admin/data_subkriteria') ?>">Sub Kriteria</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-fw fa-calculator"></i>Perhitungan Metode <span class="badge badge-success">6</span></a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('c_admin/analisa_kriteria') ?>">Perhitungan AHP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('c_admin/data_hitung_mfep') ?>">Perhitungan MFEP</a>
                                </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('c_admin/data_survey_lapangan') ?>"><i class="fa fa-fw fa-user-circle"></i>Data Survei Longlist</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('c_admin/data_hasil_laporan') ?>"><i class="fa fa-fw fa-eye"></i>Hasil Laporan</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fa fa-fw fa-book"></i>Pedoman Sistem <span class="badge badge-success">6</span></a>
                            <div id="submenu-3" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('c_admin/upload_manual_book') ?>">Upload Manual Book</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('c_admin/read_manual_book') ?>">Read Manual Book</a>
                                </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>                            
            </nav>
        </div>
    </div>

    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    
    <!-- main js -->
    <script src="<?php echo base_url();?>assets/libs/js/main-js.js"></script>
    
    <!-- morris js -->
    <script src="<?php echo base_url();?>assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/charts/morris-bundle/morris.js"></script>
</body>