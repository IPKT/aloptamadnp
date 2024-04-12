<h3>Taman Alat</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Waktu</th>
                <th>Petugas</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($ta as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->tanggal?></td>
                <td><?=$value->shift?></td>
                <td><?=$value->waktu?></td>
                <td><?=$value->petugas?></td>
                <td><?php $catatan = str_replace("\n", '<br />', $value->catatan);
                    echo $catatan;?>

                </td>
                <td style="white-space: nowrap;">
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('aloptama/delete_kunjungan/'.'/'.$value->id) ?>' , '<?=$value->id?>')">
                        Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>

    </table>
</div>
<h3>Aloptama Geofisika Kantor</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Waktu</th>
                <th>Petugas</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($ak as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->tanggal?></td>
                <td><?=$value->shift?></td>
                <td><?=$value->waktu?></td>
                <td><?=$value->petugas?></td>
                <td><?php $catatan = str_replace("\n", '<br />', $value->catatan);
                    echo $catatan;?>

                </td>
                <td style="white-space: nowrap;">
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('aloptama/delete_kunjungan/'.'/'.$value->id) ?>' , '<?=$value->id?>')">
                        Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>

    </table>
</div>

<h3>Sistem Processing</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Waktu</th>
                <th>Petugas</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($sp as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->tanggal?></td>
                <td><?=$value->shift?></td>
                <td><?=$value->waktu?></td>
                <td><?=$value->petugas?></td>
                <td><?php $catatan = str_replace("\n", '<br />', $value->catatan);
                    echo $catatan;?>

                </td>
                <td style="white-space: nowrap;">
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('aloptama/delete_kunjungan/'.'/'.$value->id) ?>' , '<?=$value->id?>')">
                        Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>

    </table>
</div>

<h3>Jaringan Internet</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Waktu</th>
                <th>Petugas</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($ji as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->tanggal?></td>
                <td><?=$value->shift?></td>
                <td><?=$value->waktu?></td>
                <td><?=$value->petugas?></td>
                <td><?php $catatan = str_replace("\n", '<br />', $value->catatan);
                    echo $catatan;?>

                </td>
                <td style="white-space: nowrap;">
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('aloptama/delete_kunjungan/'.'/'.$value->id) ?>' , '<?=$value->id?>')">
                        Delete</a>
                </td>
            </tr>
            <?php }?>
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