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
    <title>Tambah Data Sub Kriteria</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- basic form  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">TAMBAH DATA SUB KRITERIA</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo base_url('c_admin/tambah_subkriteria') ?>" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Pilih Kriteria<span class="text-danger">*</span></label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="list_id_kriteria">
                                            <?php
                                                foreach($data_kriteria as $data_kriteria)
                                                {
                                            ?>
                                            <option value ="<?php echo $data_kriteria['id_kriteria'] ?>"><?php echo $data_kriteria['kode_kriteria'] ?> - <?php echo $data_kriteria['nama_kriteria'] ?></option>
                                            <?php
                                                }
                                            ?>                                    
                                        </select>
                                    </div>                                           
                                    <div class="form-group">
                                        <label for="Kode_Sub_Kriteria" class="col-form-label">Kode Sub Kriteria<span class="text-danger">*</span></label>
                                        <input id="kode_subkriteria" type="text" class="form-control <?php if($this->session->flashdata('kode_subkriteria')) {?> form-control is-invalid <?php }?>" placeholder="Kode Sub Kriteria" name="kode_subkriteria" required>
                                        <snap class='text-danger'><?php echo $this->session->flashdata('kode_subkriteria'); ?></snap>
                                    </div>                                            
                                    <div class="form-group">
                                        <label for="inputText4" class="col-form-label">Nama Sub Kriteria<span class="text-danger">*</span></label>
                                        <input id="inputText4" type="text" class="form-control" placeholder="Nama Sub Kriteria" name="nama_subkriteria" required>
                                    </div>                                            
                                        <div class="form-group">
                                        <label for="inputText4" class="col-form-label">Nilai Sub Kriteria<span class="text-danger">*</span></label>
                                        <input id="inputText4" type="number" class="form-control" placeholder="Nilai Sub Kriteria" name="nilai_subkriteria" required>
                                    </div>                                            
                                    <button class="btn btn-primary btn-sm float-left mr-6" type="submit"><i class="fas fa-plus" ></i> Tambah Data</button>
                                </form>
                            </div>
                        </div>
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
    
</body>
 
</html>