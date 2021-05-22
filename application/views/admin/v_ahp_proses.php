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
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <title>Data Kriteria</title>
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
                    <h3 class="card-header">AHP PROSES
                        <a href="<?php echo base_url('c_admin/tampil_tambah_kriteria') ?>"><button class="btn btn-primary btn-sm float-right mr-6" type="button"><i class="fas fa-plus" ></i> Tambah Data</button></a>
                        <!-- <a href="<?php echo base_url('c_admin/tampil_pembobotan') ?>"><button class="btn btn-primary btn-sm float-right"  type="button">Pembobotan</button></a> -->
                    </h3>
                    <div class="card-body">
                    <?php
                        if ($this->session->flashdata('success')){?>
                        <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $this->session->flashdata('success')?>
                        </div>
                    <?php
                        }
                    ?>      

                    <!-- DATA AWAL AHP -->
                    <?php

                    ?>
                                                 
                      
                               
                            
                            <table class="table table-hover" id="mytable">
                            <thead>
                                <tr>
                                   
                                    <th scope="col">Kriteria</th>
                                    <?php
                                    $number = 0;
                                    $i = 0;
                                    $n = 6;
                                    $j=0;
                                    $nama_kriteria = [];
                                    $kode_kriteria = [];

                                    foreach($data_kriteria as $data_kriteria)
                                    {
                                        $number ++;
                                        
                                    
                                ?>
                                
                                    <?php $kode_kriteria[$i] = $data_kriteria['kode_kriteria'] ?>
                                    <?php $nama_kriteria[$i] = $data_kriteria['nama_kriteria'] ?> 
                                    <th><?php echo $data_kriteria['nama_kriteria']?></th> 

                                    
                                <?php
                                $i++;
                                    }
                                ?>
                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                                               
                                 
                                      
                                        
                                        <?php
                                        $n =6;
                                        $x = 0;
                                        $y=0;
                                        ?>
                                            <tr>
                                            <td>sdasda</td>
                                            <?
                                             for ($x=0; $x<=($n-1); $x++) 
                                             { 
                                            for ($y=0; $y <= ($n-1); $y++) { 
                                                
                                                ?>  
                                                    <td> <?php  $awal[$x][$y]?> </td>  
                                                <?
                                            }
                                            ?>

                                            </tr>    
                                        <?
                                        }
                                        ?>
                               
                                   
                           
                            </tbody>
                        </table>










                        <script type="text/javascript"> 
                            $(document).ready(function() { 
                                $("#mytable").dataTable(); 
                            }); 
                        </script> 
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

    <!-- data table -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
</body>
 
</html>