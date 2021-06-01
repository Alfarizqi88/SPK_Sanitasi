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
    <title>Data Perhitungan MFEP</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- CONTENTTTTT -->
                <div class="card" hidden>
                    <h3 class="card-header">ANALISA DATA SURVEI LONGLIST</h3>
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
                                foreach($data_alternatif_nik as $nik=>$krit){
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
                                $("#mytable").dataTable(); 
                            }); 
                        </script> 
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card" hidden>
                    <h3 class="card-header">NORMALISASI DATA SURVEI LONGLIST</h3>
                    <?php
                    if(!$kriteria_bobot){
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
                                $bobot = array();
                                $count = 0;
                                foreach($kriteria_bobot as $kriteria_bobot)      
                                {
                                    $bobot[$count] = $kriteria_bobot['nilai_bobot'];
                                    $count++;
                                }
                                $total =[];
                                $hitung = 0;

                                foreach($data_alternatif_nik as $nik=>$krit){
                                  echo "<tr>
                                    <td>".(++$i).".</td>
                                    <td>$nik</td>";
                                    $nama=$data_alternatif_nama_alter[$nik];
                                    $nama_dusun=$data_alternatif_nama_dusun[$nik];
                                    $rt_rw=$data_alternatif_nama_rt_rw[$nik];

                                  foreach($kriteria as $k){
                                    $id_kriteria = $k['id_kriteria'];
                                    $normalisasi = $krit[$id_kriteria]*$bobot[($id_kriteria-1)];
                                    $hitung = $hitung + $normalisasi;
                                    echo "<td align='center'>$normalisasi </td>";
                                    
                                  }                                  
                            ?>
                            <?php
                                $arr[] = ["nik" => $nik , "nama"=> $nama,"nama_dusun"=>$nama_dusun,"rt/rw"=>$rt_rw,"total" => $hitung];
                                $hitung = 0;
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
                <div class="card">
                    <h3 class="card-header">HASIL LAPORAN DATA SURVEI LONGLIST</h3>
                    <?php

                    if(!$kriteria_bobot){
                        echo "<br><h3 class='card-body'>Data Kosong</h3>";
                    }
                    else{
                    ?>
                    <div class="card-body">
                     

                    <?php

                        function make_comparer() {
                            // Normalize criteria up front so that the comparer finds everything tidy
                            $criteria = func_get_args();
                            foreach ($criteria as $index => $criterion) {
                                $criteria[$index] = is_array($criterion)
                                    ? array_pad($criterion, 3, null)
                                    : array($criterion, SORT_ASC, null);
                            }
                        
                            return function($first, $second) use (&$criteria) {
                                foreach ($criteria as $criterion) {
                                    // How will we compare this round?
                                    list($column, $sortOrder, $projection) = $criterion;
                                    $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;
                        
                                    // If a projection was defined project the values now
                                    if ($projection) {
                                        $lhs = call_user_func($projection, $first[$column]);
                                        $rhs = call_user_func($projection, $second[$column]);
                                    }
                                    else {
                                        $lhs = $first[$column];
                                        $rhs = $second[$column];
                                    }
                        
                                    // Do the actual comparison; do not return if equal
                                    if ($lhs < $rhs) {
                                        return -1 * $sortOrder;
                                    }
                                    else if ($lhs > $rhs) {
                                        return 1 * $sortOrder;
                                    }
                                }
                        
                                return 0; // tiebreakers exhausted, so $first == $second
                            };
                        }
                        usort($arr, make_comparer(['total', SORT_DESC]));
                    ?>
                                                 
                        <table class="table table-hover" id="mytable_rangking">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK Alternatif</th>
                                    <th>Nama </th>
                                    <th>Nama Dusun </th>
                                    <th>RT/RW </th>
                                    <th>Total</th>
                                    <th>Rangking</th>
                                </tr>
                               
                            </thead>
                            <tbody>
                            <?php
                                $i=0;
                                

                                foreach($arr as $arr){
                                    $i++;
                                  ?>
                                  <tr>
                                  <td><?php echo $i?></td>
                                    <td><?php echo $arr['nik'] ?></td>
                                    <td><?php echo $arr['nama'] ?></td>
                                    <td>Dusun <?php echo $arr['nama_dusun'] ?></td>
                                    <td><?php echo $arr['rt/rw'] ?></td>
                                    <td><?php echo $arr['total'] ?></td>             
                                    <!-- rangking -->
                                    <td><?php echo $i?></td>
                          
                            <?php
                                }
                            ?>
                                
                            </tbody>
                        </table>
                        <script type="text/javascript"> 
                            $(document).ready(function() {
                                $('#mytable_rangking').DataTable( {
                                    dom: 'Bfrtip',
                                    buttons: [
                                        {
                                            extend: 'excelHtml5',
                                            title: 'Data Hasil Laporan'
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            title: 'Data Hasil Laporan'
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
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    
    <!-- main js -->
    <script src="<?php echo base_url();?>assets/libs/js/main-js.js"></script>
    
    <!-- data table -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

</body>
 
</html>