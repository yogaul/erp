<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Register</title>

    <?php $this->load->view('partials/head', FALSE); ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block" style="background-image: url(<?php echo base_url().'assets/img/kosme.jpg' ?>); background-position: center;background-size: cover;"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <b><h1 class="h4 text-gray-900 mb-4">Daftar ke PT. KOSME</h1></b>
                            </div>
                            <form class="user" method="post" action="<?php echo base_url().'Register/save_user'?>">
                                <div class="form-group">
                                     <input type="nama" class="form-control form-control-user" id="nama_user" name="nama_user" 
                                        placeholder="Masukkan Nama Anda">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email_user" name="email_user" 
                                        placeholder="Masukkan Alamat E-Mail">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password_user" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Masukkan Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Ulangi Password Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                	Register
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url().'login' ?>">Sudah memiliki akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php $this->load->view('partials/js', FALSE); ?>

</body>

</html>