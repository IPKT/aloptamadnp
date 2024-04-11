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
        <h5>Waktu Pengecekan&emsp;: <?=$taman_alat->shift?> <?=$taman_alat->waktu?></h5>
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
                    <td><?php if ($taman_alat->sangkar_meteo != 'Baik' and $taman_alat->sangkar_meteo != 'Rusak'  ) {echo "Dengan Catatan";} else {echo $taman_alat->sangkar_meteo;}?>
                    </td>
                    <td><?php if ($taman_alat->sangkar_meteo != 'Baik' and $taman_alat->sangkar_meteo != 'Rusak'  ) {echo $taman_alat->sangkar_meteo;} ?>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Anemometer</td>
                    <td><?php if ($taman_alat->anemometer != 'Baik' and $taman_alat->anemometer != 'Rusak') {echo "Dengan Catatan";} else {echo $taman_alat->anemometer;}?>
                    </td>
                    <td><?php if ($taman_alat->anemometer != 'Baik' and $taman_alat->anemometer != 'Rusak'  ) {echo $taman_alat->anemometer;} ?>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Panci Penguapan</td>
                    <td><?php if ($taman_alat->panci_penguapan != 'Baik' and $taman_alat->panci_penguapan != 'Rusak') {echo "Dengan Catatan";} else {echo $taman_alat->panci_penguapan;}?>
                    </td>
                    <td><?php if ($taman_alat->panci_penguapan != 'Baik' and $taman_alat->panci_penguapan != 'Rusak'  ) {echo $taman_alat->panci_penguapan;} ?>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Penakar Hujan Manual</td>
                    <td><?php if ($taman_alat->penakar_hujan != 'Baik' and $taman_alat->penakar_hujan != 'Rusak') {echo "Dengan Catatan";} else {echo $taman_alat->penakar_hujan;}?>
                    </td>
                    <td><?php if ($taman_alat->penakar_hujan != 'Baik' and $taman_alat->penakar_hujan != 'Rusak'  ) {echo $taman_alat->penakar_hujan;} ?>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td style="white-space: nowrap; width: 1%;">Penakar Hujan Hillman</td>
                    <td><?php if ($taman_alat->hillman != 'Baik' and $taman_alat->hillman != 'Rusak') {echo "Dengan Catatan";} else {echo $taman_alat->hillman;}?>
                    </td>
                    <td><?php if ($taman_alat->hillman != 'Baik' and $taman_alat->hillman != 'Rusak'  ) {echo $taman_alat->hillman;} ?>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Automatic Rain Gauge</td>
                    <td><?php if ($taman_alat->arg != 'Baik' and $taman_alat->arg != 'Rusak') {echo "Dengan Catatan";} else {echo $taman_alat->arg;}?>
                    </td>
                    <td><?php if ($taman_alat->arg != 'Baik' and $taman_alat->arg != 'Rusak'  ) {echo $taman_alat->arg;} ?>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Campbell Stoke</td>
                    <td><?php if ($taman_alat->campbell != 'Baik' and $taman_alat->campbell != 'Rusak') {echo "Dengan Catatan";} else {echo $taman_alat->campbell;}?>
                    </td>
                    <td><?php if ($taman_alat->campbell != 'Baik' and $taman_alat->campbell != 'Rusak'  ) {echo $taman_alat->campbell;} ?>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #ebba34;">B</td>
                    <td colspan="3" style="background-color: #ebba34;">Aloptama Geofisika</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td style="white-space: nowrap; width: 1%;">Seismograph DNP</td>
                    <td><?php if ($aloptama_kantor->seismo != 'Baik' and $aloptama_kantor->seismo != 'Rusak'  ) {echo "Dengan Catatan";} else {echo $aloptama_kantor->seismo;}?>
                    </td>
                    <td><?php if ($aloptama_kantor->seismo != 'Baik' and $aloptama_kantor->seismo != 'Rusak'  ) {echo $aloptama_kantor->seismo;} ?>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td style="white-space: nowrap; width: 1%;">Radio Broadcaster</td>
                    <td><?php if ($aloptama_kantor->radio_broadcaster != 'Baik' and $aloptama_kantor->radio_broadcaster != 'Rusak'  ) {echo "Dengan Catatan";} else {echo $aloptama_kantor->radio_broadcaster;}?>
                    </td>
                    <td><?php if ($aloptama_kantor->radio_broadcaster != 'Baik' and $aloptama_kantor->radio_broadcaster != 'Rusak'  ) {echo $aloptama_kantor->radio_broadcaster;} ?>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td style="white-space: nowrap; width: 1%;">Warning Receiver System (WRS)</td>
                    <td><?php if ($aloptama_kantor->wrs != 'Baik' and $aloptama_kantor->wrs != 'Rusak'  ) {echo "Dengan Catatan";} else {echo $aloptama_kantor->wrs;}?>
                    </td>
                    <td><?php if ($aloptama_kantor->wrs != 'Baik' and $aloptama_kantor->wrs != 'Rusak'  ) {echo $aloptama_kantor->wrs;} ?>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td style="white-space: nowrap; width: 1%;">Intensitymeter Realshake</td>
                    <td><?php if ($aloptama_kantor->intensity_realshake != 'Baik' and $aloptama_kantor->intensity_realshake != 'Rusak'  ) {echo "Dengan Catatan";} else {echo $aloptama_kantor->intensity_realshake;}?>
                    </td>
                    <td><?php if ($aloptama_kantor->intensity_realshake != 'Baik' and $aloptama_kantor->intensity_realshake != 'Rusak'  ) {echo $aloptama_kantor->intensity_realshake;} ?>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td style="white-space: nowrap; width: 1%;">Lightning Detector</td>
                    <td><?php if ($aloptama_kantor->petir != 'Baik' and $aloptama_kantor->petir != 'Rusak'  ) {echo "Dengan Catatan";} else {echo $aloptama_kantor->petir;}?>
                    </td>
                    <td><?php if ($aloptama_kantor->petir != 'Baik' and $aloptama_kantor->petir != 'Rusak'  ) {echo $aloptama_kantor->petir;} ?>
                    </td>
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