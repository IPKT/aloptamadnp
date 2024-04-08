<div class="row">
    <div class="col-sm-8">
    <div id="map" style="width: 100%; height: 600px;"></div>
    </div>
    <div class="col-sm-4">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }
        
        ?>

       <?php echo form_open_multipart('sosialisasi/update/'.$lokasi->id_lokasi)?>
       <div class="form-group" hidden>
            <label for="">id Lokasi</label>
            <input class="form-control" name="id_lokasi" placeholder="Nama Lokasi" value="<?=$lokasi->id_lokasi?>" required > 
        </div> 
       <div class="form-group">
            <label for="">Nama Lokasi</label>
            <input class="form-control" name="nama_lokasi" placeholder="Nama Lokasi" value="<?=$lokasi->nama_lokasi?>" required > 
        </div>
        <div class="form-group">
            <label for="">Koordinat</label>
            <input class="form-control" name="koordinat" id="Longitude" placeholder = "lat,lng" value="<?=$lokasi->koordinat?>" required>
        </div>
        <!-- <div class="form-group">
            <label for="">Latitude</label>
            <input class="form-control" name="latitude" id="Latitude" placeholder = "Latitude">
        </div>
        <div class="form-group">
            <label for="">Longitude</label>
            <input class="form-control" name="longitude" id="Longitude" placeholder = "Longitude">
        </div> -->
        <div class="form-group">
            <label for="">Detail Lokasi</label>
            <input class="form-control" name="detail_lokasi" placeholder = "Detail Lokasi" required value="<?=$lokasi->detail_lokasi?>">
        </div>
        <div class="form-group">
            <label for="">Tanggal Sosialisasi</label>
            <input class="form-control" type="date" name="tanggal" required value="<?=$lokasi->tanggal?>">
        </div>
        <div class="form-group">
            <label for="">Jenis Kegiatan</label>
            <input class="form-control" name="jenis_kegiatan" placeholder = "Misalnya BGTS dll" required value="<?=$lokasi->jenis_kegiatan?>" >
        </div>
        <div class="form-group">
            <label for="">Pelaksana</label>
            <textarea class="form-control textAreaMultiline" name="pelaksana" rows="5" placeholder="1. Nama \n2. Nama" required value=""><?=$lokasi->pelaksana?></textarea>
        </div>
        <div class="form-group">
            <label for="">Jumlah Peserta</label>
            <input class="form-control" name="jumlah_peserta" rows="5" placeholder="Jumlah Peserta" required value="<?=$lokasi->jumlah_peserta?>">
        </div>
        <div class="form-group">
            <label for="">Gambar</label>
            <input class="form-control" name="gambar" type="file" accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Riset</button>
        </div>
         
        
        <?php echo form_close()?>
        <div class="form-group">
        <button type="" class="btn btn-success" name ="btn-check">Cek Lokasi</button>
        </div>
        
    
    </div>
    
</div>



<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/satellite-v9'
	});


var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/dark-v10'
	});
var center_map_lat = -8.34656224716775;
var center_map_lng = 115.16081838649232;
    const map = L.map('map', {
		center: [<?=$lokasi->koordinat?>],
		zoom: 10,
		layers: [peta1]
	});

	const baseLayers = {
		'Default': peta1,
		'Satelite': peta2,
        'Street': peta3,
        'Dark': peta4,
	};

    const layerControl = L.control.layers(baseLayers).addTo(map);


    // get koordinat
// var latInput = document.querySelector("[name=latitude]");
// var lngInput = document.querySelector("[name=longitude]");
var btn_check = document.querySelector("[name=btn-check]");
var koordinat = document.querySelector("[name=koordinat]");


var curLocation = [<?=$lokasi->koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation,{
    draggable : 'true',
});

marker.on('dragend', function(e){
    var position = marker.getLatLng();
    marker.setLatLng(position,{
        curLocation
    }).bindPopup(position).update();
    // $("#Latitude").val(position.lat);
    // $("#Longitude").val(position.lng);

    koordinat.value = position.lat + ", " +position.lng;
});

map.on("click", function(e){
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    if(!marker){
        marker = L.marker(e.latlng).addTo(map);
    } else {
        marker.setLatLng(e.latlng);
    }
    koordinat.value = lat + ", " +lng;
    // lngInput.value = lng;

});

btn_check.onclick =  function(e){
    //var lat = latInput.value;
    //var lng = lngInput.value;
    var lat_lng1 = koordinat.value;
    var lat_lng = lat_lng1.split(", ");

    var lat = lat_lng[0];
    var lng = lat_lng[1];


    // var lat_lng = koordinat.value;
    // console.log(lat);
    
    
    if(!marker){
        marker = L.marker([lat, lng]).addTo(map);
    } else {
        marker.setLatLng([lat, lng]);
    }
    map.panTo(new L.LatLng(lat, lng));
    map.setView([lat, lng], 13);
    
    

};
map.addLayer(marker);


//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});



</script>