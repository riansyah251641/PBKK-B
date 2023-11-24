<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-sm btn-success">
                <?php 
                $grand_total = 0;
                if ($keranjang = $this->cart->contents())
                {
                    foreach ($keranjang as $item)
                    {
                        $grand_total = $grand_total + $item['subtotal'];
                    }
                    echo "total belanja anda : Rp. ".number_format($grand_total,0,',','.');
                } ?>
            </div>
            <br>
            <br>
            <h3>input alamat pengiriman dan pembayaran</h3>
            <form method="post" action="<?php echo base_url('dashboard/proses_pesanan') ?>">
            <input type="hidden" name="param" value="<?= $idx ?>">
                <input type="hidden" value="<?= $grand_total ?>" name="tot">
            <div class="form-group">
                <label>Nama Anda</label>
                <?php foreach($us as $u){ $n = $u->nama_konsumen; $n1=$u->no_hp; $al=$u->alamat; } ?>
                <input type="text" name="" value="<?= $n ?>" placeholder="Nama lengkap anda" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Alamat Pengiriman</label>
                <input type="text" name="alamat" value="<?= $al ?>" placeholder="alamat lengkap anda" class="form-control">
            </div>

            <div class="form-group">
                <label>No. telepon</label>
                <input type="text" name="no_telepon" placeholder="Nomor telepon anda" value="<?= $n1 ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>jasa pengiriman</label>
                <select class="form-control" name="jasa">
                    <option>JNE</option>
                    <option>JNT</option>
                    <option>Sicepat</option>
                    <option>GOJEK</option>
                    <option>GRAB</option>
                </select>
            </div>

            <div class="form-group">
                <label>Bank pembayaran</label>
                <select class="form-control" name="mp">
                    <option>BCA - 314136132133</option>
                    <option>BNI - 326437645244</option>
                    <option>BRI - 2436247623423</option>
                    <option>Mandiri - 64745634806</option>
                </select>
            </div>

            <button type="submit" class="btn btn-sm btn-primary mb-3">pesan</button>

            </form>
        </div>
       
        <div class="col-md-2"></div>
    </div>
</div>