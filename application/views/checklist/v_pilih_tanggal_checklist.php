<div class="row">
    <div class="col-sm-12">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-danger">';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }
        
        ?>
        <?php echo form_open_multipart("checklist/check_hasil")?>
        <div class="form-group">
            <label for="">Tanggal</label>
            <input class="form-control" type="date" name="tanggal">
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
            <button type="submit" class="btn btn-primary">Submit</button>
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