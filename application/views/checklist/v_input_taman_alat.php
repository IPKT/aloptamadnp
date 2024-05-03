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
        <?php echo form_open_multipart("checklist/input_taman_alat")?>

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
                <option value="Malam">Malam</option>
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
            <label for="" onclick="hideStyle('sangkar_meteo')">Sangkar Meteo</label>
            <select class="form-control" id="sangkar_meteo" name="sangkar_meteo" onchange="toggleInput('sangkar_meteo')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="sangkar_meteo_lainnya" class="form-control" type="text" id="sangkar_meteo_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('anemometer')">Anemometer</label>
            <select class="form-control" id="anemometer" name="anemometer" onchange="toggleInput('anemometer')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="anemometer_lainnya" class="form-control" type="text" id="anemometer_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <label for="" onclick="hideStyle('panci_penguapan')">Panci Penguapan</label>
            <select class="form-control" id="panci_penguapan" name="panci_penguapan"
                onchange="toggleInput('panci_penguapan')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="panci_penguapan_lainnya" class="form-control" type="text" id="panci_penguapan_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <label for="" onclick="hideStyle('campbell')">Campbell Stoke</label>
            <select class="form-control" id="campbell" name="campbell" onchange="toggleInput('campbell')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="campbell_lainnya" class="form-control" type="text" id="campbell_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <label for="" onclick="hideStyle('penakar_hujan')">Penakar Hujan Manual</label>
            <select class="form-control" id="penakar_hujan" name="penakar_hujan"
                onchange="toggleInput('penakar_hujan')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="penakar_hujan_lainnya" class="form-control" type="text" id="penakar_hujan_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('hillman')">Hillman</label>
            <select class="form-control" id="hillman" name="hillman" onchange="toggleInput('hillman')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="hillman_lainnya" class="form-control" type="text" id="hillman_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('arg')">ARG</label>
            <select class="form-control" id="arg" name="arg" onchange="toggleInput('arg')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="arg_lainnya" class="form-control" type="text" id="arg_lainnya" style="display: none;"
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