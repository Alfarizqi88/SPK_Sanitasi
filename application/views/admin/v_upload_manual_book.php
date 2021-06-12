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
    <title>Upload Manual Book</title>
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
                    <h3 class="card-header">DATA MANUAL BOOK
                        <?php
                            if($jumlah_upload < 2){
                        ?>
                                <button class="btn btn-primary btn-sm float-right mr-6"  data-toggle="modal" data-target="#tambahmembers" id="#modalCenter">
                                <i class="fas fa-plus" ></i> Upload Manual Book</button>
                        <?php
                            }
                        ?>
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

                        <?php
                            if ($this->session->flashdata('error')){?>
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $this->session->flashdata('error')?>
                                </div>
                        <?php
                            }
                        ?>         
                        <table class="table table-hover" id="mytable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">File</th>                                    
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $number = 0;
                                    foreach($data_manual_book as $data_manual_book)
                                    {
                                        $number ++;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $number?></th>
                                    <td><?php echo $data_manual_book['user'] ?></td>
                                    <td><?php echo $data_manual_book['file'] ?></td>
                                    <td>                                        
                                        <a href="<?php echo base_url('c_admin/hapus_manual_book')?>?id_manual_book=<?php echo $data_manual_book['id_manual_book'] ?>"  onclick="return confirm('Are you sure?')">
                                        <button class="btn btn-sm btn-danger "><i class="fas fa-trash-alt"></i></button></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>

                         <!-- modal tambah members -->
                        <div class="modal fade" id="tambahmembers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Manual Book</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            echo form_open_multipart('c_admin/do_upload');
                                        ?>
                                        <form action="<?php echo base_url('c_admin/do_upload') ?>" method="post">
                                            <div class="form-group">
                                                <label>Upload file .pdf </label>
                                                <input type="file" name="file" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Select User</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="list_user">
                                                    <option value ="admin">Admin</option>
                                                    <option value ="pihak_pelaksana">Pihak Pelaksana</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm float-right mr-6">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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