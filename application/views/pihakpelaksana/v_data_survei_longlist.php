<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>Data Longlist</title> 
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- CONTENTTTTT -->
                <div class="card">
                    <h3 class="card-header">DATA SURVEI LONGLIST
                        <a href="<?php echo base_url('c_pihakpelaksana/tampil_tambah_data_lapangan') ?>"><button class="btn btn-primary btn-sm float-right mr-6" type="button"><i class="fas fa-plus" ></i> Tambah Data</button></a>
                    </h3>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIK Alternatif</th>
                                    <th scope="col">C1</th>
                                    <th scope="col">C2</th>
                                    <th scope="col">C3</th>
                                    <th scope="col">C4</th>
                                    <th scope="col">C5</th>
                                    <th scope="col">C6</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $number = 0;
                                    foreach($data_survey_lapangan as $data_survey_lapangan)
                                    {
                                        $number ++;
                                    
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $number?></th>
                                    <td><?php echo $data_survey_lapangan['kode_longlist'] ?></td>
                                    <td><?php echo $data_survey_lapangan['nik_longlist'] ?></td>
                                    <td><?php echo $data_survey_lapangan['nama_alternatif'] ?></td>
                                    <td><?php echo $data_survey_lapangan['nama_dusun'] ?></td>
                                    <td><?php echo $data_survey_lapangan['rt'] ?></td>
                                    <td><?php echo $data_longlist['rw'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url('c_admin/tampil_edit_data_longlist')?>?id_longlist=<?php echo $data_longlist['id_longlist']?>"><button class="btn btn-dark">update</button></a>
                                        <a href="<?php echo base_url('c_admin/hapus_data_longlist')?>?id_longlist=<?php echo $data_longlist['id_longlist']?>"><button class="btn btn-danger">delete</button></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="<?php echo base_url();?>assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="<?php echo base_url();?>assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="<?php echo base_url();?>assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="<?php echo base_url();?>assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="<?php echo base_url();?>assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="<?php echo base_url();?>assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="<?php echo base_url();?>assets/libs/js/dashboard-ecommerce.js"></script>
</body>
 
</html>