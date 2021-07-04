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
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <title>Data Login</title>
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
                    <h3 class="card-header">DATA USER
                    <a href="<?php echo base_url('c_admin/tampil_tambah_data_login') ?>"><button class="btn btn-primary btn-sm float-right mr-6" type="button"><i class="fas fa-plus" ></i> Tambah Data</button></a>
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
                        <table class="table table-hover" id="mytable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pihak Pelaksana</th>
                                    <th scope="col">Divisi</th>
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $number = 0;
                                    foreach($data_login as $data_login)
                                    {
                                        $number ++;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $number?></th>
                                    <td><?php echo $data_login['nama'] ?></td>
                                    <td><?php echo $data_login['divisi'] ?></td>
                                    <td><?php echo $data_login['no_telepon'] ?></td>
                                    <td><?php echo $data_login['username'] ?></td>
                                    <td><?php echo $data_login['password'] ?></td>
                                    <td><?php echo $data_login['level'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url('c_admin/tampil_edit_data_login')?>?id_datalogin=<?php echo $data_login['id_datalogin']?>"><button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button></a>
                                    <?php 
                                        if($data_login['level'] != 'Admin')
                                        {
                                    ?>    
                                        <a href="<?php echo base_url('c_admin/hapus_data_login')?>?id_datalogin=<?php echo $data_login['id_datalogin'] ?>"onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-danger "><i class="fas fa-trash-alt"></i></button></a>
                                    
                                    <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <script language="JavaScript" type="text/javascript">
                            function checkDelete(){
                                return confirm('Are you sure?');
                            }
                        </script>
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
    <!-- main js -->
    <script src="<?php echo base_url();?>assets/libs/js/main-js.js"></script>
    
    <!-- data table -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
</body>
 
</html>