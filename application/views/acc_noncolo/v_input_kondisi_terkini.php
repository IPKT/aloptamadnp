<div class="row">
    <div class="col-sm-8">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('acc_noncolo"').'>Lihat Data</a> </div>';
        }
        
        ?>

        <?php echo form_open_multipart('acc_noncolo/input_kondisi_terkini_2')?>
        <div class="row">
            <?php
        $loop = 0; 
        foreach($site as $key => $value){ ?>
            <?php if ($loop == 0) {
            echo '<div class="col-sm-2">
            <table class="table">';
          }?>

            <tr>
                <td><label for=""><?=$value->kode?></label></td>
                <td>
                    <div class="form-group">

                        <label for="<?=$value->kode?>" class="switch">
                            <input class="form-control" name="<?=$value->kode?>"
                                value="<?php if ($value->kondisi_terkini =="ON") {echo "ON";}else{echo "OFF";} ?>"
                                id="<?=$value->kode?>" type="checkbox" onclick="myFunction('<?=$value->kode?>')"
                                <?php if ($value->kondisi_terkini =="ON"){echo 'checked';}?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </td>
            </tr>
            <?php $loop++; 
                if ($loop == 9) {
                  $loop=0;
                  echo '</table> </div>';}?>
            <?php } ?>
            <?php if ($loop!= 0) {
            echo '</table>
            </div>';
          }?>

        </div>






        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Riset</button>
        </div>

        <?php echo form_close()?>


    </div>

</div>

<script>
function myFunction(id) {
    // Get the checkbox
    var a = String(id);
    var checkBox = document.getElementById(a);
    //   console.log(checkBox);
    //     console.log(checkBox.value);
    // Get the output text
    //   var text = document.getElementById("text");
    b = checkBox.value;
    console.log(b);
    // If the checkbox is checked, display the output text
    if (b == "OFF") {
        // text.style.display = "block";
        checkBox.value = "ON";
        checkBox.checked = true;
    } else {
        // text.style.display = "none";
        checkBox.value = "OFF";
        checkBox.checked = false;


    };
    //   console.log(a);
    //   console.log(checkBox.value);
    //   console.log(checkBox);

}
</script>