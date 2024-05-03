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
        <?php echo form_open_multipart("checklist/input_aloptama_kantor")?>

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
            <label for="" onclick="hideStyle('seismo')">Seismograph DNP</label>
            <select class="form-control" id="seismo" name="seismo" onchange="toggleInput('seismo')"
                style="display: block;">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="seismo_lainnya" class="form-control" type="text" id="seismo_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('radio_broadcaster')">Radio Broadcaster</label>
            <select class="form-control" id="radio_broadcaster" name="radio_broadcaster"
                onchange="toggleInput('radio_broadcaster')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="radio_broadcaster_lainnya" class="form-control" type="text" id="radio_broadcaster_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="" onclick="hideStyle('tdq')">TDQ Accelerograf Portable</label>
            <select class="form-control" id="tdq" name="tdq"
                onchange="toggleInput('tdq')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="tdq_lainnya" class="form-control" type="text" id="tdq_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <label for="" onclick="hideStyle('wrs')">WRS</label>
            <select class="form-control" id="wrs" name="wrs" onchange="toggleInput('wrs')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="wrs_lainnya" class="form-control" type="text" id="wrs_lainnya" style="display: none;"
                placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <label for="" onclick="hideStyle('intensity_realshake')">Intensitymeter Realshake</label>
            <select class="form-control" id="intensity_realshake" name="intensity_realshake"
                onchange="toggleInput('intensity_realshake')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="intensity_realshake_lainnya" class="form-control" type="text" id="intensity_realshake_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>

        <div class="form-group">
            <label for="" onclick="hideStyle('petir')">Lightning Detector</label>
            <select class="form-control" id="petir" name="petir" onchange="toggleInput('petir')">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="petir_lainnya" class="form-control" type="text" id="petir_lainnya" style="display: none;"
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