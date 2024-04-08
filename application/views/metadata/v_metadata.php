<div class="table-responsive">
    <?php 
    $CI =& get_instance();
    $CI->load->model('m_metadata');
    $CI->load->model('m_aloptama');
    $semua_jenis_hardware = $CI->m_metadata->ambil_aja("SELECT DISTINCT jenis_hardware FROM hardware_aloptama WHERE jenis_aloptama = '$jenis_aloptama'");
    $jenis_hardware = [];
    foreach($semua_jenis_hardware as $key => $value){
        array_push($jenis_hardware,$value->jenis_hardware);
    }
    ?>
    <table style="white-space: nowrap;" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Kode Site</th>
                <?php foreach ($jenis_hardware as $value): ?>

                <th colspan="4"><?=$value ?></th>
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
            $semua_id_aloptama = $CI->m_metadata->ambil_aja("SELECT DISTINCT id_aloptama FROM hardware_aloptama WHERE jenis_aloptama = '$jenis_aloptama' ORDER BY id_aloptama ASC");  
            $no = 1;
            foreach($semua_id_aloptama as $key => $id):
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?php 
                $aloptama = $CI->m_aloptama->detail_aloptama($jenis_aloptama,$id->id_aloptama);
                
                
                ?><a
                        href="<?=base_url('metadata/detail_metadata/'.$jenis_aloptama.'/'.$aloptama->id.'/'.$aloptama->kode) ?>"><?=$aloptama->kode?></a>
                </td>
                <?php foreach ($jenis_hardware as $jha): ?>
                <!-- UPS -->
                <?php
                    $CI =& get_instance();
                    $CI->load->model('m_metadata');
                    $hardware = $CI->m_metadata->detail_hardware($jenis_aloptama, $jha, $id->id_aloptama); ?>
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
            <?php 
            $no++;
            endforeach ?>

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