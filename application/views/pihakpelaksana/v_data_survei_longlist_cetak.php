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
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <title>Cetak Data Survei Longlist</title>
    <?php error_reporting(0) ?>
</head>

<body>
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- CONTENTTTTT -->
                <div class="card">
                    <h3 class="card-header">DATA SURVEI LONGLIST</h3>
                    <?php

                    if(!$data_kriteria){
                        echo "<br><h3 class='card-body'>Data Kosong</h3>";
                    }
                    else{
                    ?>

                    <div class="card-body">
                                                 
                        <table class="table table-hover" id="mytable">
                            <thead>
                                <tr>
                                    <th rowspan='2' style="vertical-align:middle">#</th>
                                    <th rowspan='2' style="vertical-align:middle">NIK Alternatif</th>
                                    <th colspan='<?php echo $total_kriteria;?>' class="text-center">Kriteria</th>
                                </tr>
                                <tr>
                                  <?php
                                  foreach($kriteria as $k)
                                    echo "<th>$k[nama_kriteria]</th>\n";
                                  ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=0;
                                $list_nik=0;
                                // if($data_kriteria!=null){
                                    foreach($data_kriteria as $nik=>$krit){
                                        echo "<tr>
                                          <td>".(++$i).".</td>
                                          <td>$nik</td>";
      
                                        foreach($kriteria as $k){
                                          $id_kriteria = $k['id_kriteria'];
                                          echo "<td align='center'>$krit[$id_kriteria]</td>";
                                        //   $list_nik++;
                                            switch ($list_nik) {
                                                case 0:
                                                    $list_nik = 0;
                                                    break;
                                                default:
                                                    $list_nik++;
                                                    break;
                                            }
                                        }
                                // }
                                
                            ?>
                            <?php
                                }
                            ?>
                                
                            </tbody>
                        </table>
                        <script type="text/javascript"> 
                            $(document).ready(function() {
                                $('#mytable').DataTable( {
                                    dom: 'Bfrtip',
                                    buttons: [
                                        {
                                            extend: 'excelHtml5',
                                            title: 'Data Survei Longlist'
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            title: 'Data Survei Longlist'
                                        }
                                    ]
                                } );
                            } );
                        </script>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card" hidden>
                    <h3 class="card-header">ANALISA DATA SURVEI LONGLIST</h3>
                    <?php

                    if(!$data_kriteria){
                        echo "<br><h3 class='card-body'>Data Kosong</h3>";
                    }
                    else{
                    ?>
                    <div class="card-body">
                                                 
                        <table class="table table-hover" id="mytable_nilai">
                            <thead>
                                <tr>
                                    <th rowspan='2' style="vertical-align:middle">#</th>
                                    <th rowspan='2' style="vertical-align:middle">NIK Alternatif</th>
                                    <th colspan='<?php echo $total_kriteria;?>' class="text-center">Kriteria</th>
                                </tr>
                                <tr>
                                  <?php
                                  foreach($kriteria as $k)
                                    echo "<th>$k[nama_kriteria]</th>\n";
                                  ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=0;
                                foreach($data_kriteria_nilai as $nik=>$krit){
                                  echo "<tr>
                                    <td>".(++$i).".</td>
                                    <td>$nik</td>";

                                  foreach($kriteria as $k){
                                    $id_kriteria = $k['id_kriteria'];
                                    echo "<td align='center'>$krit[$id_kriteria]</td>";
                                  }
                            ?>
                            <?php
                                }
                            ?>
                                
                            </tbody>
                        </table>
                        <script type="text/javascript"> 
                            $(document).ready(function() { 
                                $("#mytable_nilai").dataTable(); 
                            }); 
                        </script> 
                    </div>
                    <?php
                    }
                    ?>
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
    <!-- main js -->
    <script src="<?php echo base_url();?>assets/libs/js/main-js.js"></script>

    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
</body>
 
</html>