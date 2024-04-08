<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Intensity</th>
                <th>Jenis Hardware</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>SN</th>
                <th>Pemasangan</th>
                <th>Sumber</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($hardware as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->id_aloptama?></td>
                <td><?=$value->jenis_hardware?></td>
                <td><?=$value->merk?></td>
                <td><?=$value->tipe?></td>
                <td><?=$value->sn?></td>
                <td><?=$value->tanggal_pemasangan?></td>
                <td><?=$value->sumber?></td>
                
              
                <td>
                    <a class='btn btn-xs btn-success'
                        href='<?=base_url('intensity/detail_kunjungan/'.$value->id_kunjungan) ?>'>
                        Detail</a>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('intensity/edit_kunjungan/'.$value->id_kunjungan) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('intensity/delete_kunjungan/'.$value->id_kunjungan) ?>' , '<?=$value->kode?>')">
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