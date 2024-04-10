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
    <h5>Teknisi : <?=$taman_alat->petugas?></h5>
    <h5>Waktu Pengecekan : <?=$taman_alat->shift?></h5>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="text-center">

                <th class="text-center">Sangkar Meteo</th>
                <th class="text-center">Anemometer</th>
                <th class="text-center">Panci Penguapan</th>
                <th class="text-center">Campbell</th>
                <th class="text-center">Hillman</th>
                <th class="text-center">Penakar Hujan</th>
                <th class="text-center">Catatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$taman_alat->sangkar_meteo?></td>
                <td><?=$taman_alat->anemometer?></td>
                <td><?=$taman_alat->panci_penguapan?></td>
                <td><?=$taman_alat->campbell?></td>
                <td><?=$taman_alat->hillman?></td>
                <td><?=$taman_alat->penakar_hujan?></td>
                <td><?=$taman_alat->catatan?></td>
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