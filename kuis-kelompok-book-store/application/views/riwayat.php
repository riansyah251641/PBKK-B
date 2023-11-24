<div class="container-fluid">
    <h3>Riwayat Transaksi</h3>
    <br><br>
    <table id="dt" class="table table-bordered">
<thead>
    <tr class="text-center">
        <th>No</th>
        <th>Kode transaksi</th>
        <th>Jumlah Beli</th>
        <th>Total Bayar</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    <?php $i=1; foreach($riw as $r){ ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= $r->id_transaksi ?></td>
        <td><?php // $r->jumlah_belii ?></td>
        <td><?= $r->bayar ?></td>
        <td>
            <?php 
            if(empty($r->bukti)) {
                    echo "<button class='btn btn-warning' data-toggle='modal' data-target='#struk".$r->id_transaksi."'><i class='fa fa-upload'></i> Upload Bukti</button>"; 
                }else{
                    echo "<button class='btn btn-primary'><i class='fa fa-check'></i> </button>"; 
                }
            ?>
    </td>
    </tr>
    <?php $i++; } ?>
</tbody>
    </table>
</div>

<?php foreach($riw as $r){ ?>
<!-- Modal -->
<div class="modal fade" id="struk<?= $r->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPLOAD STRUK PEMBAYARAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('dashboard/struk'); ?>" name="f1" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <input type="hidden" value="<?= $r->id_transaksi ?>" name="id">
            <label>STRUK PEMBYARAN</label>
            <input type="file" name="struk" class="form-control">
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
