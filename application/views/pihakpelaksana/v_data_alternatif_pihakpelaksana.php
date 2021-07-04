<!doctype html>
<html lang="en">
 
<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Masyarakat</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    
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
                    <h3 class="card-header">DATA MASYARAKAT</h3>
                    <div class="card-body">
                        <table class="table table-hover" id="mytable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <!-- <th scope="col">Kode Longlist</th> -->
                                    <th scope="col">NIK </th>
                                    <th scope="col">Nama Kepala Keluarga</th>
                                    <th scope="col">Nama Dusun</th>
                                    <th scope="col">RT</th>
                                    <th scope="col">RW</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $number = 0;
                                    foreach($data_alternatif as $data_alternatif)
                                    {
                                        $number ++;    
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $number?></th>
                                    <!-- <td><?php echo $data_alternatif['kode_longlist'] ?></td> -->
                                    <td><?php echo $data_alternatif['nik_alternatif'] ?></td>
                                    <td><?php echo $data_alternatif['nama_alternatif'] ?></td>
                                    <td><?php echo $data_alternatif['nama_dusun'] ?></td>
                                    <td><?php echo $data_alternatif['rt'] ?></td>
                                    <td><?php echo $data_alternatif['rw'] ?></td>
                                </tr>
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
                                            title: 'Data Masyarakat'
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            title: 'Data Masyarakat'
                                        }
                                    ]
                                } );
                            } );
                        </script>
                    </div>
                </div>
                    <!-- END CONTENTTTTT -->
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    
    <!-- <script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- bootstap bundle js -->
    <!-- <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script> -->
    
    <script src="<?php echo base_url();?>assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="<?php echo base_url();?>assets/libs/js/main-js.js"></script>
    
    <!-- data tables -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
</body>
 
</html>