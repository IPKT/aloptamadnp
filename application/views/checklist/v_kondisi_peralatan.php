<?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }
        
        ?>

<div>
    <div>
        <h5>Teknisi&emsp; &emsp; &emsp;&emsp;&emsp;&emsp;: <?=$taman_alat->petugas?></h5>
        <h5>Waktu Pengecekan&emsp;: <?=$taman_alat->shift?></h5>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th style="white-space: nowrap; width: 1%;">No</th>
                    <th style="white-space: nowrap; width: 1%;">Peralatan</th>
                    <th style="white-space: nowrap; width: 1%;">Kondisi Peralatan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color: #ebba34;">A</td>
                    <td colspan="3" style="background-color: #ebba34;">Taman Alat</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td style="white-space: nowrap; width: 1%;">Sangkar Meteorologi</td>
                    <td>Baik</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Anemometer</td>
                    <td>Baik</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Panci Penguapan</td>
                    <td>Baik</td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Penakar Hujan Manual</td>
                    <td>Baik</td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td style="white-space: nowrap; width: 1%;">Penakar Hujan Hillman</td>
                    <td>Baik</td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Automatic Rain Gauge</td>
                    <td>Baik</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>

        </table>
    </div>
</div>


<script>
function del(url, kode) {
    if (confirm("yakin ingin menghapus kunjungan site " + kode)) {
        window.location.assign(url);
    }
}
</script>