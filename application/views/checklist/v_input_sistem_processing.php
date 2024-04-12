<div class="row">
    <div class="col-sm-12">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('checklist/"').'>Lihat Data</a> </div>';
        }
        
        ?>
        <?php echo form_open_multipart("checklist/input_sp")?>

        <div class="form-group">
            <label for="" onclick="hideStyle('petugas')">Petugas</label>
            <select class="form-control" id="petugas" name="petugas" onchange="toggleInput('petugas')"
                style="display: block;">
                <option disabled selected value="">Pilih Petugas</option>
                <option value="Putu Martin Winajun Pratama">Martin</option>
                <option value="I Putu Kembar Tirtayasa">Putu Kembar</option>
                <option value="Arindea Anggraini S">Arindea</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="petugas_lainnya" class="form-control" type="text" id="petugas_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="">Shift</label>
            <select class="form-control" id="" name="shift">
                <option disabled selected value="">Pilih Shift</option>
                <option value="Pagi">Pagi</option>
                <option value="Siang">Siang</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Tanggal</label>
            <input class="form-control" type="date" name="tanggal">
        </div>
        <div class="form-group">
            <label for="">Waktu</label>
            <input class="form-control" type="time" name="waktu">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('sc_seismo_server')">Seiscomp Inatews (Server)</label>
            <select class="form-control" id="sc_seismo_server" name="sc_seismo_server" onchange="toggleInput('sc_seismo_server')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="sc_seismo_server_lainnya" class="form-control" type="text" id="sc_seismo_server_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('sc_seismo_client')">Seiscomp Inatews (Client)</label>
            <select class="form-control" id="sc_seismo_client" name="sc_seismo_client" onchange="toggleInput('sc_seismo_client')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="sc_seismo_client_lainnya" class="form-control" type="text" id="sc_seismo_client_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('sc_acc_server')">Shakemap Processing (Server)</label>
            <select class="form-control" id="sc_acc_server" name="sc_acc_server" onchange="toggleInput('sc_acc_server')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="sc_acc_server_lainnya" class="form-control" type="text" id="sc_acc_server_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('sc_acc_pusat')">Shakemap Processing Backup Pusat</label>
            <select class="form-control" id="sc_acc_pusat" name="sc_acc_pusat" onchange="toggleInput('sc_acc_pusat')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="sc_acc_pusat_lainnya" class="form-control" type="text" id="sc_acc_pusat_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('sc_acc_regional')">Shakemap Processing Regional</label>
            <select class="form-control" id="sc_acc_regional" name="sc_acc_regional" onchange="toggleInput('sc_acc_regional')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="sc_acc_regional_lainnya" class="form-control" type="text" id="sc_acc_regional_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('petir')">Sistem Akuisisi Petir</label>
            <select class="form-control" id="petir" name="petir" onchange="toggleInput('petir')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="petir_lainnya" class="form-control" type="text" id="petir_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('anemometer')">Sistem Akuisisi Anemometer</label>
            <select class="form-control" id="anemometer" name="anemometer" onchange="toggleInput('anemometer')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="anemometer_lainnya" class="form-control" type="text" id="anemometer_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="">Catatan</label>
            <textarea class="form-control textAreaMultiline" name="catatan" rows="3" placeholder="1. \n2. "></textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
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
        selectBox.style.display = "none";
    } else {
        lainnyaInput.style.display = "none";
        lainnyaInput.name = id_lainnya;
    }
}

function hideStyle(jenis) {
    var selectBox = document.getElementById(jenis);
    selectBox.style.display = "block";
    selectBox.selectedIndex = 0;
    var id_lainnya = jenis + "_lainnya";
    var lainnyaInput = document.getElementById(id_lainnya);
    lainnyaInput.style.display = "none";
    lainnyaInput.name = id_lainnya;
}
</script>