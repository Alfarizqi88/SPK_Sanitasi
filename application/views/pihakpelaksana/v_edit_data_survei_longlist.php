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
    <title>Tambah Data Alternatif</title>
    <?php error_reporting(0) ?>
</head>

<body>
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">EDIT DATA SURVEI LONGLIST</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <?php foreach($data_alternatif as $data_alternatif){
                                    echo("<h4>".$data_alternatif['nik_alternatif']);
                                    echo(" - ");
                                    echo($data_alternatif['nama_alternatif']."</h4>");
                                }
                                ?>
                                <form action="<?php echo base_url('c_pihakpelaksana/edit_data_lapangan') ?>?id_alternatif=<?php echo $ambil_id_alternatif?>" method="post">
                                <div class="form-group">  
                            <?php
                                foreach($data_kriteria as $nik=>$krit){
                                    $no=0;
                                    foreach($kriteria as $k){
                                    $nama_kriteria = $k['nama_kriteria'];
                                    ?>
                                    
                                    <input id="" type="text" class="form-control" value="<?php echo $data_kriteria[$nik][$nama_kriteria]?>" name="id_dsl<?php echo $no+1?>" hidden>
                                    <label class="col-form-label">C<?php echo $no+1?> - <?php echo $nama_kriteria?><span class="text-danger">*</span></label><br>
                                    <select class="form-control" id="exampleFormControlSelect1" name="c<?php echo $no+1?>">
                                            <?php
                                                foreach ($data_lapangan1 as $data_lapangan)
                                                {
                                                    if($data_lapangan['id_kriteria']== $k['id_kriteria']){
                                                        ?>
                                                        <option  value="<?php echo $data_lapangan['id_subkriteria']?>">
                                                        <?php echo $data_lapangan['nama_subkriteria']?>
                                                        
                                                        <?php
                                                    }
                                                }
                                            ?>
                                            </select>
                                    <?php
                                    $no++;
                                  }
                                }
                            ?>
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