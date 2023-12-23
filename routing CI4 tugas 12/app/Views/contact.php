<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami | Rental Mobil My Car</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
            /* Warna latar putih untuk tema mobil */
        }

        .navbar {
            background-color: #2196F3;
            /* Warna biru untuk tema mobil */
        }

        .navbar-nav .nav-link {
            color: #fff;
            /* Teks warna putih untuk kontras */
        }

        .navbar-nav .nav-link.active {
            color: #2196F3;
            /* Teks warna biru untuk tautan aktif */
        }

        .container {
            background-color: #fff;
            /* Warna latar putih untuk konten */
            border-radius: 10px;
            /* Sudut membulat untuk tampilan yang lebih lembut */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Driveway Rentals</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('home') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('about') ?>">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('contact') ?>">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Hubungi Kami</h1>
        <p class="text-center">
            Jangan ragu untuk menghubungi kami. Gunakan formulir di bawah ini untuk mengirimkan pesan kepada kami.
        </p>

        <form action="<?= site_url('kirim_pesan') ?>" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="pesan">Pesan:</label>
                <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Kirim Pesan</button>
        </form>

        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Lokasi Kantor</h2>
                <p>Jalan Raya No. 123, Kota Maju</p>
                <p>Telepon: 0812-3456-7890</p>
            </div>
            <div class="col-md-6">
                <h2>Jam Operasional</h2>
                <p>Senin - Sabtu: 08.00 - 18.00</p>
                <p>Minggu: 09.00 - 16.00</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="https://www.instagram.com/mycar_id" target="_blank"><img src="img/instagram.png" alt="Instagram"></a>
                <a href="https://www.facebook.com/mycar_id" target="_blank"><img src="img/facebook.png" alt="Facebook"></a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>