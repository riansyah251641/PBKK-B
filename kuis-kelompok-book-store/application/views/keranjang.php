<form method="post" action="<?= base_url('dashboard/pembayaran') ?>">
<div class="container-fluid">
    <h4>keranjang belanja</h4>

    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>NO</th>
            <th>NAMA BUKU</th>
            <th>JUMLAH</th>
            <th>harga</th>
            <th>sub-total</th>
        </tr>

        <?php $no=1;
        foreach ($this->cart->contents() as $items) : ?>

        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $items['name'] ?></td>
            <td><?php echo $items['qty'] ?></td>
            <td align="right">Rp. <?php echo number_format($items['price'], 0,',','.') ?></td>
            <td align="right">Rp. <?php echo number_format($items['subtotal'], 0,',','.') ?></td>
        </tr>
        
            <input type="text" name="id_buku[]" value="<?= $items['id'] ?>">
            <input type="hidden" name="jb[]" value="<?= $items['qty']; ?>">
            <input type="hidden" name="sub[]" value="<?= $items['subtotal']; ?>">
            
            
        <?php endforeach ?>
        <input type="hidden" name="tgl" value="<?= date('Y-m-d') ?>">
        <input type="hidden" name="id_kon" value="<?= $this->session->userdata('id_konsumen'); ?>">
        <input type="hidden" name="kdd" value="<?= uniqid() ?>">
        <input type="hidden" name="bayar" value="<?= $this->cart->total() ?>">
        <tr>
            <td colspan="4"></td>
            <td align="right">Rp. <?php echo 
            number_format($this->cart->total(),0,',','.' ) ?>
            </td>
        </tr>
    </table>
    
    <div align="right">
    <button type="submit" class="btn btn-sm btn-success">pembayaran</button>
        </form>
        <a href="<?PHP echo base_url('dashboard/hapus_keranjang') ?>">
            <div class="btn btn-sm btn-danger">hapus keranjang</div>
        </a>
        <a href="<?PHP echo base_url() ?>">
            <div class="btn btn-sm btn-primary">lanjut belanja</div>
        </a>
        
    </div>
</div>