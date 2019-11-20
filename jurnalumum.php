<?php
date_default_timezone_set('Asia/Jakarta');
include "lib/config.php";
if (!isset($_SESSION)) {
    session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
    $logoutAction .= "&" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
    //to fully log out a visitor we need to clear the session varialbles
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);

    $logoutGoTo = "../index.php";
    if ($logoutGoTo) {
        header("Location: $logoutGoTo");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>tugas sia</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Sistem Informasi Akuntansi</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">


            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="akun.php"><i class="fa fa-fw fa-book"></i> Akun</a>
                    </li>
                    <li>
                        <a href="jurnalumum.php"><i class="fa fa-fw fa-book"></i> Jurnal Umum</a>
                    </li>
                    <li>
                        <a href="bukubesar.php"><i class="fa fa-fw fa-book"></i> Buku Besar</a>
                    </li>
                    <li>
                        <a href="neracasaldo.php"><i class="fa fa-fw fa-book"></i> Neraca Saldo</a>
                    </li>
                    <!--<li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Jurnal Umum <small>Sistem Informasi Akutansi</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <ol class="breadcrumb">
                            <div></div>
                            <b>INPUT TRANSAKSI : </b><br>
                            <form method="POST" action="pro_input_transaksi.php">
                                Tanggal transaksi : <br>
                                <div class="input-group date form_date col-md-12" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="10" type="text" name="tgl" id="tgl_transaksi">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                Pilih Akun :
                                <select name="id_akun" class="form-control">
                                    <?php
                                    $data = mysqli_query($config->koneksi(), "SELECT * FROM tb_akun");
                                    while ($row = mysqli_fetch_array($data)) {
                                        ?><option value='<?php echo $row['id'] ?>'><?php echo $row['nama_akun'] ?></option><?php
                                                                                                                            }
                                                                                                                            ?>
                                </select>

                                Nominal : Rp.
                                <input type="text" name="nominal" class="form-control">

                                Keterangan :
                                <textarea name="ket" class="form-control"></textarea>

                                Tipe :
                                <select name="tipe" class="form-control">
                                    <option value="D">Debet</option>
                                    <option value="K">Kredit</option>
                                </select><br>

                                <input type="submit" name="simpan" value="Simpan Transaksi" class="btn btn-primary">
                            </form>
                        </ol>
                    </div>

                    <div class="col-md-9">
                        <ol class="breadcrumb">
                            <div></div>
                            <b>JURNAL UMUM</b><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Trans</th>
                                            <th>Akun</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                        </ol>
                    </div>

                    <?php
                    $by_tgl = mysqli_query($config->koneksi(), "SELECT *, tb_jurnal.id 'idjurnal', tb_akun.id 'idakun' from tb_jurnal, tb_akun where tb_jurnal.id_akun=tb_akun.id group by tgl order by tb_jurnal.tgl ASC");
                    $no = 1;
                    $total_debet    =   0;
                    $total_kredit   =   0;
                    $all_debet      =   0;
                    $all_kredit     =   0;
                    while ($data = mysqli_fetch_array($by_tgl)) {
                        echo "
                                <tr>
                                    <td align='center'>$no</td>
                                    <td>$data[tgl]</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>";

                        $transaksi = mysqli_query($config->koneksi(), "SELECT *, tb_jurnal.id 'idjurnal' from tb_jurnal, tb_akun where tb_jurnal.id_akun=tb_akun.id and tb_jurnal.tgl='$data[tgl]' order by tb_jurnal.id ASC");
                        $total_debet    =   0;
                        $total_kredit   =   0;
                        while ($v = mysqli_fetch_array($transaksi)) {

                            switch ($v['tipe']) {
                                case "D":
                                    $akun               =   "<p>$v[nama_akun]</p>";
                                    $kolom_debet    =   $v['nominal'];
                                    $kolom_kredit   =   "0";
                                    $total_debet        +=  $kolom_debet;

                                    break;

                                case "K":
                                    $akun               =   "<p style='margin-left:10px;'>$v[nama_akun]</p>";
                                    $kolom_kredit   =   $v['nominal'];
                                    $kolom_debet    =   "0";
                                    $total_kredit       +=  $kolom_kredit;

                                    break;
                            }

                            echo "
                                    <tr>
                                        <td align='center'></td>
                                        <td></td>
                                        <td>$akun</td>
                                        <td align='center'><p align='right'>Rp. " . number_format($kolom_debet, 0, ",", ".") . "</p></td>
                                        <td align='center'><p align='right'>Rp. " . number_format($kolom_kredit, 0, ",", ".") . "</p></td>
                                        <td align='center'><a href='editjurnal.php?id=" . $v['idjurnal'] . "'>edit</a> 
                                        <a href='hapus_transaksi.php?id=" . $v['idjurnal'] . "'>Hapus</a>  </td>
                                    </tr>
                                ";
                        }
                        /*echo"
                                                                
                                    <tr>
                                        <td colspan='3' align='center'  style='padding:10px;'>JUMLAH</td>
                                        <td align='right'>Rp. ".number_format($total_debet,0,",",".")."</td>
                                        <td align='right'>Rp. ".number_format($total_kredit,0,",",".")."</td>
                                    </tr>
                            ";*/
                        $no++;
                        $all_debet  +=  $total_debet;
                        $all_kredit +=  $total_kredit;
                    }

                    echo "
                                    <tr>
                                        <td colspan='3' align='center' style='padding:20px;'><b>TOTAL</b></td>
                                        <td align='center'><b>Rp. " . number_format($all_debet, 0, ",", ".") . "</b></td>
                                        <td align='center'><b>Rp. " . number_format($all_kredit, 0, ",", ".") . "</b></td>
                                    </tr>
                            ";
                    ?>
                        </table>
                </div>
            </div>
            <!-- /.row -->

            <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            <!--   <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>New Comments!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>New Tasks!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div>
                                        <div>Support Tickets!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>-->
            <!-- /.row -->

            <!--<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            <!--<div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge">just now</span>
                                        <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">4 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">23 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">46 minutes ago</span>
                                        <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">2 hours ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                    </a>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>-->
            <!-- <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3326</td>
                                                <td>10/21/2013</td>
                                                <td>3:29 PM</td>
                                                <td>$321.33</td>
                                            </tr>
                                            <tr>
                                                <td>3325</td>
                                                <td>10/21/2013</td>
                                                <td>3:20 PM</td>
                                                <td>$234.34</td>
                                            </tr>
                                            <tr>
                                                <td>3324</td>
                                                <td>10/21/2013</td>
                                                <td>3:03 PM</td>
                                                <td>$724.17</td>
                                            </tr>
                                            <tr>
                                                <td>3323</td>
                                                <td>10/21/2013</td>
                                                <td>3:00 PM</td>
                                                <td>$23.71</td>
                                            </tr>
                                            <tr>
                                                <td>3322</td>
                                                <td>10/21/2013</td>
                                                <td>2:49 PM</td>
                                                <td>$8345.23</td>
                                            </tr>
                                            <tr>
                                                <td>3321</td>
                                                <td>10/21/2013</td>
                                                <td>2:23 PM</td>
                                                <td>$245.12</td>
                                            </tr>
                                            <tr>
                                                <td>3320</td>
                                                <td>10/21/2013</td>
                                                <td>2:15 PM</td>
                                                <td>$5663.54</td>
                                            </tr>
                                            <tr>
                                                <td>3319</td>
                                                <td>10/21/2013</td>
                                                <td>2:13 PM</td>
                                                <td>$943.45</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>