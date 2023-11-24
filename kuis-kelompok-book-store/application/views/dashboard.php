<div class="container-fluid">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?php echo base_url('assets/img/slider1.jpg') ?>" class="d-block w-100" alt="..." height="300px">
      </div>
      <div class="carousel-item">
        <img src="<?php echo base_url('assets/img/slider2.jpg') ?>" class="d-block w-100" alt="...">
      </div>
      <!-- slider masih blm bisa -->
    </div>
    <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>
  <br>
  <div class="row text-center">
    <?php foreach ($barang as $brg) : ?>
      <div class="card ml-4 mb-3" style="width: 18rem;">
        <img src="<?php echo base_url() . '/upload/book/' . $brg->gambar ?>" class="card-img-top" alt="..." width="80px" height="300px">
        <div class="card-body">
          <h5 class="card-title mb-1"><?php echo $brg->judul_buku ?></h5>
          <small><?php echo $brg->keterangan ?></small> <br>
          <span class="badge rounded-pill bg-success mb-1"> Rp. <?php echo $brg->harga  ?></span><br><br>
          <?php if (empty($this->session->userdata('id_konsumen'))) { ?>
            <a data-toggle="modal" data-target="#login" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart" onclick="alert('Silahkan Login Terlebih Dahulu')"></i></a>
            <a data-toggle="modal" data-target="#view_barang<?= $brg->id_buku ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
          <?php } else { ?>
            <a data-toggle="modal" data-target="#tambah_barang<?= $brg->id_buku ?>" class="btn btn-sm btn-primary"><i class="fas fa-shopping-cart"></i></a>
            <a data-toggle="modal" class="btn btn-sm btn-success" data-target="#view_barang<?= $brg->id_buku ?>"><i class="fa fa-eye"></i></a>
          <?php } ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php foreach ($barang as $brg) { ?>
  <!-- Modal -->
  <div class="modal fade" id="tambah_barang<?= $brg->id_buku ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">INPUT JUMLAH PEMBELIAN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('dashboard/tambah_ke_keranjang/');
                        echo $brg->id_buku ?>" name="f1" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label>JUMLAH BELI</label>

              <select class="form-control" name="jb">
                <?php $zz = $brg->stok;
                for ($i = 1; $i <= $zz; $i++) { ?>
                  <option><?= $i ?></option>
                <?php } ?>
              </select>
            </div>
            <input type="hidden" name="st" value="<?= $zz  ?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<?php foreach ($barang as $brg) { ?>
  <!-- Modal -->
  <div class="modal fade" id="view_barang<?= $brg->id_buku ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" name="f1" method="" enctype="">
            <div class="form-group">
              <center><img src="<?php echo base_url() . '/upload/book/' . $brg->gambar ?>" class="card-img-top" alt="..." style="width:50%;text-align:center;" height="300px"></center>
            </div>
            <br>
            <div class="form-group text-center">
              Nama Buku : <?= $brg->judul_buku ?>
            </div>
            <div class="form-group text-center">
              Jumlah Stok : <?= $brg->stok ?>
            </div>
            <div class="form-group text-center">
              Harga Buku : <?= $brg->harga ?>
            </div>
            <div class="form-group text-center">
              Kategori Buku : <?= $brg->nama_kategori ?>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Modal Login -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Form Login Konsumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('login/login2') ?>" name="f1" method="post" enctype="">
          <div class="form-group">
            <label for="us">Username :</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="us">Password :</label>
            <input type="password" name="pw" class="form-control">
          </div>
          <a data-toggle="modal" data-target="#daftar">Daftar Disini</a>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Masuk</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal daftar -->
<div class="modal fade" id="daftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Form Daftar Konsumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('login/daftar') ?>" name="f1" method="post" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
            <div class="col-md-6">
              <input type="text" name="user" placeholder="Username" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
              <input type="password" name="pass" placeholder="Password" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
            <div class="col-md-6">
              <input type="text" name="nama" placeholder="Nama " class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-md-4 col-form-label text-md-right">Alamat</label>
            <div class="col-md-6">
              <input type="text" name="alamat" placeholder="Alamat " class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="jk" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>
            <div class="col-md-6">
              <select name="jk" class="form-control" required>
                <option>-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
              </select>

            </div>
          </div>

          <div class="form-group row">
            <label for="nope" class="col-md-4 col-form-label text-md-right">No HP</label>
            <div class="col-md-6">
              <input type="nope" name="nope" placeholder="085xxxxxxx" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="foto" class="col-md-4 col-form-label text-md-right">Foto</label>
            <div class="col-md-6">
              <input type="file" name="foto" placeholder="foto" class="form-control" required>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Daftar</button>
      </div>
      </form>
    </div>
  </div>
</div>