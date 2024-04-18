<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aloptama DNP</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('gambar/logo bmkg.png') ?>">


    <!-- BOOTSTRAP STYLES-->
    <link href="<?=base_url('binary-admin/')?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?=base_url('binary-admin/')?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="<?=base_url('binary-admin/')?>assets/css/custom.css" rel="stylesheet" />
    <!-- Library Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <!-- PDF PRINT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <!-- JQUERY SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/custom.js"></script>
    <!-- TABLE STYLES-->
    <link href="<?=base_url('binary-admin/')?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"
        integrity="sha512-/cZZTKETbsuutvNXdPji/z8N+9e+LHq9D60JhcBCigq9I5a2VDEcLzml8PdVlVqzmWlVbhZCuTx+9CTi2xb30A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    /*Legend specific*/
    .legend {
        padding: 6px 8px;
        font: 14px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(115, 184, 249, 0.8);
        /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
        /*border-radius: 5px;*/
        line-height: 24px;
        color: rgba(17, 17, 17, 1);
    }

    .legend h4 {
        text-align: center;
        font-size: 16px;
        margin: 2px 12px 8px;
        color: rgba(0, 0, 0, 1);
    }

    .legend span {
        position: relative;
        bottom: 3px;
    }

    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin: 0 8px 0 0;
        opacity: 0.7;
    }

    .legend i.icon {
        background-size: 18px;
        background-color: rgba(255, 255, 255, 1);
    }

    .leaflet-tooltip {
        font: 9px Arial, Helvetica, sans-serif;
    }

    span {
        color: rgba(0, 0, 0, 1);
    }

    .hidden {
        display: none
    }

    .selectedCell {
        background-color: yellow !important;
    }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">STAGEOF DNP</a>
            </div>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
                <?php if ($this->session->userdata('username') != null) {echo $this->session->userdata('name');} ?>
                &nbsp; <a href="<?=base_url('auth/logout')?>" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img style="background: #4d4d4d;" src="<?=base_url('binary-admin/')?>assets/img/bmkg.png"
                            class="user-image img-responsive" />
                    </li>


                    <li>
                        <a href="<?=base_url('aloptama/')?>"><i class="fa fa-dashboard "></i> Home</a>
                    </li>
                    <li class="hidden">
                        <a href="login.html"><i class="fa fa-bolt "></i> Login</a>
                    </li>
                    <li class="hidden">
                        <a href="registeration.html"><i class="fa fa-laptop "></i> Registeration</a>
                    </li>

                    <li class="hidden">
                        <a href="#"><i class="fa fa-sitemap "></i> Lokasi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('lokasi/input')?>">Input Lokasi</a>
                            </li>
                            <li>
                                <a href="<?=base_url('lokasi')?>">Pemetaan Lokasi</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-sitemap "></i> Sosialisasi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('sosialisasi')?>">Pemetaan Lokasi Sosialisasi</a>
                            </li>
                            <li>
                                <a href="<?=base_url('sosialisasi/input_page')?>">Input Lokasi Sosialisasi</a>
                            </li>

                            <li>
                                <a href="<?=base_url('sosialisasi/input_page_kunjungan')?>">Input Kunjungan
                                    Sosialisasi</a>
                            </li>
                            <li class="">
                                <a href="<?=base_url('sosialisasi/list_kunjungan')?>">List Kunjungan Sosialisasi</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> Intensitymeter Realshake<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('aloptama/home/intensity')?>">Peta Intensity</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/input_page/intensity')?>">Input Intensity</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/input_page_kunjungan/intensity')?>">Input Kunjungan
                                    Intensity</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/list_kunjungan/intensity')?>">List Kunjungan
                                    Intensity</a>
                            </li>
                            <li>
                                <a href="<?=base_url('metadata/input_page/intensity')?>">Input Metadata
                                    Hardware</a>
                            </li>
                            <li>
                                <a href="<?=base_url('metadata/intensity')?>">Show Metadata</a>
                            </li>

                            <li>
                                <a href="<?=base_url('intensity/input_page_kondisi_terkini')?>">Input Kondisi
                                    Terkini</a>
                            </li>
                            <li class="hidden">
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> WRS<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('aloptama/home/wrs')?>">Peta WRS</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/input_page/wrs')?>">Input WRS</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/input_page_kunjungan/wrs')?>">Input Kunjungan WRS</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/list_kunjungan/wrs')?>">List Kunjungan WRS</a>
                            </li>

                            <li>
                                <a href="<?=base_url('metadata/input_page/wrs')?>">Input Metadata
                                    Hardware</a>
                            </li>
                            <li>
                                <a href="<?=base_url('metadata/wrs')?>">Show Metadata</a>
                            </li>
                            <li>
                                <a href="<?=base_url('wrs/input_page_kondisi_terkini')?>">Input Kondisi
                                    Terkini</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> Seismometer<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('aloptama/home/seismo')?>">Peta seismo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/input_page/seismo')?>">Input seismo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/input_page_kunjungan/seismo')?>">Input Kunjungan
                                    seismo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('aloptama/list_kunjungan/seismo')?>">List Kunjungan seismo</a>
                            </li>

                            <li>
                                <a href="<?=base_url('metadata/input_page/seismo')?>">Input Metadata
                                    Hardware</a>
                            </li>
                            <li>
                                <a href="<?=base_url('metadata/seismo')?>">Show Metadata</a>
                            </li>
                            <li>
                                <a href="<?=base_url('seismo/input_page_kondisi_terkini')?>">Input Kondisi
                                    Terkini</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> Accelerometer Non Colocated<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('acc_noncolo/')?>">Peta acc_noncolo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('acc_noncolo/input_page')?>">Input acc_noncolo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('acc_noncolo/input_page_kunjungan')?>">Input Kunjungan
                                    acc_noncolo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('acc_noncolo/list_kunjungan')?>">List Kunjungan acc_noncolo</a>
                            </li>
                            <li>
                                <a href="<?=base_url('acc_noncolo/input_page_kondisi_terkini')?>">Input Kondisi
                                    Terkini</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> Intensitymeter Reis<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('int_reis/')?>">Peta Intensity Reis</a>
                            </li>
                            <li>
                                <a href="<?=base_url('int_reis/input_page')?>">Input Intensity Reis</a>
                            </li>
                            <li>
                                <a href="<?=base_url('int_reis/input_page_kunjungan')?>">Input Kunjungan
                                    Intensity Reis</a>
                            </li>
                            <li>
                                <a href="<?=base_url('int_reis/list_kunjungan')?>">List Kunjungan Intensity Reis</a>
                            </li>
                            <li>
                                <a href="<?=base_url('int_reis/input_page_kondisi_terkini')?>">Input Kondisi
                                    Terkini</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> Gudang<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Daftar Barang<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="<?=base_url('gudang')?>">Semua Barang</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('gudang/intensity')?>">Intensity Realshake</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('gudang/accelero')?>">Accelero</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('gudang/wrs')?>">WRS</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('gudang/int_reis')?>">Intensity Reis</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('gudang/peralatan_kantor')?>">Peralatan Kantor</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?=base_url('gudang/input')?>">Input Barang</a>
                            </li>
                            <li>
                                <a href="<?=base_url('gudang/barang_keluar')?>">Barang Keluar</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i> Check List Aloptama<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=base_url('checklist/')?>">Kondisi Terbaru Peralatan</a>
                            </li>
                            <li>
                                <a href="<?=base_url('checklist/pilih_tanggal')?>">Hasil Checklist Harian</a>
                            </li>
                            <li>
                                <a href="<?=base_url('checklist/history')?>">History Checklist</a>
                            </li>
                            <li>
                                <a href="<?=base_url('checklist/input_page/taman_alat')?>">Checklist Taman Alat</a>
                            </li>
                            <li>
                                <a href="<?=base_url('checklist/input_page/aloptama_kantor')?>">Checklist Aloptama
                                    Kantor</a>
                            </li>
                            <li>
                                <a href="<?=base_url('checklist/input_page/sistem_processing')?>">Checklist Sistem
                                    Processing</a>
                            </li>
                            <li>
                                <a href="<?=base_url('checklist/input_page/jaringan_internet')?>">Checklist Jaringan
                                    Internet</a>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden">
                        <a class="active-menu" href="blank.html"><i class="fa fa-square-o"></i> Blank Page</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?= $judul?></h2>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php 
                 if ($page) {
                    $this->load->view($page);
                 }
                 ?>
                <!-- Konten  -->
                <!-- /. Konten  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- PDF -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script> -->
    <!-- JQUERY SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="<?=base_url('binary-admin/')?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?=base_url('binary-admin/')?>assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"
        integrity="sha512-/cZZTKETbsuutvNXdPji/z8N+9e+LHq9D60JhcBCigq9I5a2VDEcLzml8PdVlVqzmWlVbhZCuTx+9CTi2xb30A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"
        integrity="sha512-2/YdOMV+YNpanLCF5MdQwaoFRVbTmrJ4u4EpqS/USXAQNUDgI5uwYi6J98WVtJKcfe1AbgerygzDFToxAlOGEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
    <style></style>
</body>

</html>