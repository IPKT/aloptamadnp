<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lokasi</th>
            <th>Detail Lokasi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; 
        foreach($sosialisasi as $key => $value){?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$value->nama_lokasi?></td>
            <td><?=$value->detail_lokasi?></td>
            <td>
            <a class='btn btn-xs btn-success' href='<?=base_url('sosialisasi/detail/'.$value->id_lokasi) ?>'> Detail</a>
            <a class='btn btn-xs btn-warning' href='<?=base_url('sosialisasi/edit/'.$value->id_lokasi) ?>'> Edit</a>
			<a class='btn btn-xs btn-danger' href='<?=base_url('lokasi/delete/') ?>'> Delete</a>
            </td>
        </tr>
        <?php }?>
    </tbody>

</table>
</div>