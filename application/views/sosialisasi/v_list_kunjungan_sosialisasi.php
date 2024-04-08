<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lokasi</th>
                <th>Kabupaten</th>
                <th>Jenis Lokasi</th>
                <th>Tanggal</th>
                <th>Jenis Kegiatan</th>
                <th>Jumlah Peserta</th>\
                <th>Pelaksana</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; 
        foreach($kunjungan as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->nama_lokasi?></td>
                <td><?=$value->kabupaten?></td>
                <td><?=$value->jenis_lokasi?></td>
                <td><?=$value->tanggal?></td>
                <td><?=$value->jenis_kegiatan?></td>
                <td><?=$value->jumlah_peserta?></td>
                <td><?php $pelaksana = str_replace("\n", '<br />', $value->pelaksana);
                    echo $pelaksana;?></td>
                <td>
                    <a class='btn btn-xs btn-success'
                        href='<?=base_url('sosialisasi/detail_kunjungan/'.$value->id_kunjungan) ?>'>
                        Detail</a>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('sosialisasi/edit_kunjungan/'.$value->id_kunjungan) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                    onclick="del('<?=base_url('sosialisasi/delete_kunjungan/'.$value->id_kunjungan) ?>' , '<?=$value->nama_lokasi?>')"> Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>

    </table>
</div>
<script>
function del(url,kode) {
  if (confirm("yakin ingin menghapus kunjungan site " + kode)) {
    window.location.assign(url);
  }
}
</script>