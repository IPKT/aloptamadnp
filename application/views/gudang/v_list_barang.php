<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Barang</th>
                <th>Jenis Aloptama</th>
                <th>Merk/Tipe</th>
                <th>SN</th>
                <th>Status</th>
                <th>Sumber</th>
                <th>Tanggal Masuk</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($list_barang as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->jenis_barang?></td>
                <td><?=$value->jenis_aloptama?></td>
                <td><?=$value->merk?> <?=$value->tipe?> </td>
                <td><?=$value->sn?></td>
                <td><?=$value->status?></td>
                <td><?=$value->sumber?></td>
                <td><?=$value->tanggal_masuk?></td>
                <td><?=$value->catatan?></td>


                <td>
                    <a class='btn btn-xs btn-danger' href='<?=base_url('gudang/verifikasi_keluar/'.$value->id) ?>'>
                        Keluar</a>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('intensity/edit_kunjungan/'.$value->id) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('intensity/delete_kunjungan/'.$value->id) ?>' , '<?=$value->kode?>')">
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