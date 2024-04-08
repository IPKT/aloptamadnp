<div class="table-responsive">
    <?php 
    $CI =& get_instance();
    $CI->load->model('m_metadata');
    $semua_jenis_hardware = $CI->m_metadata->ambil_aja("SELECT DISTINCT jenis_hardware FROM hardware_aloptama");
    $jenis_hardware = [];
    foreach($semua_jenis_hardware as $key => $value){
        array_push($jenis_hardware,$value->jenis_hardware);
    }
    print_r($jenis_hardware);
    foreach ($jenis_hardware as $value) {
        echo $value;
    }
    ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Intensity</th>
                <?php foreach ($jenis_hardware as $value): ?>

                <th colspan="5"><?=$value ?></th>
                <?php endforeach ?>
            </tr>
            <tr>
                <?php 
                $semua_jenis_hardware = $CI->m_metadata->ambil_aja("SELECT DISTINCT jenis_hardware FROM hardware_aloptama");
                foreach($semua_jenis_hardware as $key => $jh):
                ?>
                <th>Merk</th>
                <th>Tipe</th>
                <th>SN</th>
                <th>Pemasangan</th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $CI =& get_instance();
            $CI->load->model('m_metadata');
            $semua_id_aloptama = $CI->m_metadata->ambil_aja("SELECT DISTINCT id_aloptama FROM hardware_aloptama ORDER BY id_aloptama ASC");  
            foreach($semua_id_aloptama as $key => $id):
            ?>
            <tr>
                <td>1</td>
                <td><?=$id->id_aloptama?></td>
                <!-- UPS -->
                <?php
                    $CI =& get_instance();
                    $CI->load->model('m_metadata');
                    $ups = $CI->m_metadata->detail_hardware("UPS", $id->id_aloptama); ?>
                <?php if ($ups == null): ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php endif ?>
                <?php foreach($ups as $key => $value):?>
                <td><?=$value->merk?></td>
                <td><?=$value->tipe?></td>
                <td><?=$value->sn?></td>
                <td><?=$value->tanggal_pemasangan?></td>
                <?php endforeach ?>
                <!-- AKHIR UPS -->

                <!-- Modem GSM -->
                <?php
                $gsm = $CI->m_metadata->detail_hardware("Modem GSM", $id->id_aloptama); ?>

                <?php if ($gsm == null): ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php endif ?>

                <?php foreach($gsm as $key => $value):?>
                <td><?=$value->merk?></td>
                <td><?=$value->tipe?></td>
                <td><?=$value->sn?></td>
                <td><?=$value->tanggal_pemasangan?></td>
                <?php endforeach ?>
                <!-- AKHIR Modem GSM -->

                <!-- Modem Sensor -->
                <?php
                $sensor = $CI->m_metadata->detail_hardware("Sensor", $id->id_aloptama); ?>

                <?php if ($sensor == null): ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php endif ?>

                <?php foreach($sensor as $key => $value):?>
                <td><?=$value->merk?></td>
                <td><?=$value->tipe?></td>
                <td><?=$value->sn?></td>
                <td><?=$value->tanggal_pemasangan?></td>
                <?php endforeach ?>
                <!-- AKHIR Modem GSM -->
            </tr>
            <?php endforeach ?>

        </tbody>


    </table>





    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Intensity</th>
                <?php foreach ($jenis_hardware as $value): ?>

                <th colspan="5"><?=$value ?></th>
                <?php endforeach ?>
            </tr>
            <tr>
                <?php 
                // $semua_jenis_hardware = $CI->m_metadata->ambil_aja("SELECT DISTINCT jenis_hardware FROM hardware_aloptama");
                foreach ($jenis_hardware as $value): ?>
                <th>Merk</th>
                <th>Tipe</th>
                <th>SN</th>
                <th>Pemasangan</th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $CI =& get_instance();
            $CI->load->model('m_metadata');
            $semua_id_aloptama = $CI->m_metadata->ambil_aja("SELECT DISTINCT id_aloptama FROM hardware_aloptama ORDER BY id_aloptama ASC");  
            foreach($semua_id_aloptama as $key => $id):
            ?>
            <tr>
                <td>1</td>
                <td><?=$id->id_aloptama?></td>
                <?php foreach ($jenis_hardware as $jha): ?>
                <!-- UPS -->
                <?php
                    $CI =& get_instance();
                    $CI->load->model('m_metadata');
                    $hardware = $CI->m_metadata->detail_hardware($jha, $id->id_aloptama); ?>
                <?php if ($hardware == null): ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php endif ?>
                <?php foreach($hardware as $key => $value):?>
                <td><?=$value->merk?></td>
                <td><?=$value->tipe?></td>
                <td><?=$value->sn?></td>
                <td><?=$value->tanggal_pemasangan?></td>
                <?php endforeach ?>
                <?php endforeach ?>
                <!-- AKHIR UPS -->
            </tr>
            <?php endforeach ?>

        </tbody>


    </table>
</div>

<script>
function del(url, kode) {
    if (confirm("yakin ingin menghapus kunjungan site " + kode)) {
        window.location.assign(url);
    }
}
</script>