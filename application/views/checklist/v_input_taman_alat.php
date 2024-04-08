<div class="row">
    <div class="col-sm-6">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('gudang/"').'>Lihat Data</a> </div>';
        }
        
        ?>
        <?php echo form_open_multipart("checklist/input/taman_alat")?>

        <div class="form-group">
            <label for="">Petugas</label>
            <input class="form-control" name="petugas" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Tanggal</label>
            <input class="form-control" type="date" name="tanggal">
        </div>
        <div class="form-group">
            <label for="">Hillman</label>
            <select class="form-control" id="hillman" name="hillman" onchange="toggleInput('hillman')">
                <option value="baik">Baik</option>
                <option value="buruk">Buruk</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <input name="hillman_lainnya" class="form-control" type="text" id="hillman_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Riset</button>
        </div>
        <?php echo form_close()?>


    </div>

</div>



<script>
//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});


function toggleInput(jenis) {
    var id_lainnya = jenis + "_lainnya";
    var selectBox = document.getElementById(jenis);
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var lainnyaInput = document.getElementById(id_lainnya);

    if (selectedValue === "lainnya") {
        lainnyaInput.style.display = "block";
        lainnyaInput.name = jenis;
    } else {
        lainnyaInput.style.display = "none";
        lainnyaInput.name = id_lainnya;
    }
}
</script>