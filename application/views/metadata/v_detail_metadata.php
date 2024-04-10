<?php 
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }
?>

<!-- tombol Modal -->
<button class="btn btn-primary m-5" data-toggle="modal" data-target="#tesModal">
  Tambah Hardware
</button>
<div class="table-responsive">
    
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode <?=ucwords($jenis_aloptama)?></th>
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
                <td><?=$kode?></td>
                <td><?=$value->jenis_hardware?></td>
                <td><?=$value->merk?></td>
                <td><?=$value->tipe?></td>
                <td><?=$value->sn?></td>
                <td><?=$value->tanggal_pemasangan?></td>
                <td><?=$value->sumber?></td>


                <td>
                    <a class='btn btn-xs btn-success hidden'
                        href='<?=base_url('intensity/detail_hardware/'.$value->id) ?>'>
                        Detail</a>
                    <a  class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('metadata/edit_hardware/'.$value->id.'/'.$kode) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('intensity/delete_kunjungan/'.$value->id) ?>' , '<?=$value->id?>')">
                        Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>

    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="tesModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <!-- header-->
      <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Tambah Hardware Site <?=$aloptama->kode?></h3>
      </div>
      <!--body-->
      <div class="modal-body">
      <?php echo form_open_multipart("metadata/input_via_modal/$jenis_aloptama/$aloptama->kode")?>
        <div class="form-group">
            <label for="">Kode</label>
            <select class="form-control" name="id_aloptama" id="cars">
                <option selected value="<?=$aloptama->id?>"><?=$aloptama->kode?></option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Jenis Hardware</label>
            <select class="form-control" name="jenis_hardware" id="">
                <option disabled selected value="">Pilih Jenis Hardware</option>
                <?php if ($jenis_aloptama == 'intensity'):?>
                <option value="Modem GSM">Modem GSM</option>
                <option value="Sensor">Sensor</option>
                <option value="Cube">Cube</option>
                <option value="Stabilizer">Stabilizer</option>
                <option value="UPS">UPS</option>
                <option value="Hub Switch">Hub Switch</option>
                <option value="Terminal Arrester">Terminal Arrester</option>
                <option value="Adaptor Cube">Adaptor Cube</option>
                <?php endif ?>
                <?php if ($jenis_aloptama == 'seismo'):?>
                <option value="Modem GSM">Modem VSAT</option>
                <option value="Sensor">Sensor</option>
                <option value="Cube">Digitizer</option>
                <option value="Stabilizer">Stabiilizer</option>
                <option value="UPS">Baterai</option>
                <?php endif ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Merk</label>
            <input class="form-control" name="merk" id="" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="">Tipe</label>
            <input class="form-control" name="tipe" id="" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="">Serial Number</label>
            <input class="form-control" name="sn" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Tanggal Pemasangan</label>
            <input class="form-control" type="date" name="tanggal_pemasangan">
        </div>
        <div class="form-group">
            <label for="">Sumber Pengadaan</label>
            <select class="form-control" name="sumber" id="">
                <?php if ($jenis_aloptama == 'intensity'):?>
                <option selected value="PSGT">PSGT</option>
                <option value="Stageof Denpasar">Stageof Denpasar</option>
                <?php endif ?>
                <?php if ($jenis_aloptama == 'seismo'):?>
                <option selected value="Pusat">Pusat</option>
                <option value="Balai 3">Balai 3</option>
                <?php endif ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?php echo form_close()?>
      </div>
      <!--footer-->
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
function del(url, kode) {
    if (confirm("yakin ingin menghapus kunjungan site " + kode)) {
        window.location.assign(url);
    }
}
</script>