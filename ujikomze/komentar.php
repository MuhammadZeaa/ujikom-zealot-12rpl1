<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
            margin-bottom: 20px;
        }
        li {
            display: inline-block;
            margin-right: 20px;
        }
        li:last-child {
            margin-right: 0;
        }
        a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            padding: 8px 12px;
            border: 1px solid #333;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        a:hover {
            background-color: #333;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman Komentar</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>

        <ul>
            <li><a href="landingpage.php">Home</a></li>
            <li><a href="foto.php">Foto</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>

        <form action="tambah_komentar.php" method="post">
            <?php
                include "koneksi.php";
                $fotoid=$_GET['fotoid'];
                $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
            <table>
                <tr>
                    <td>Judul</td>
                    <td><input type="text" disable readonly name="judulfoto" value="<?=$data['judulfoto']?>"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" disable readonly name="deskripsifoto" value="<?=$data['deskripsifoto']?>"></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td><img src="gambar/<?=$data['lokasifile']?>" width="200px"></td>
                </tr>
                <tr>
                    <td>Komentar</td>
                    <td><input type="text" name="isikomentar"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tambah"></td>
                </tr>
            </table>
            <?php
                }
            ?>
        </form>

        <table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Komentar</th>
        <th>Tanggal</th>
    </tr>
    <?php
    include "koneksi.php";
    $no = 1;
    $fotoid = $_GET['fotoid']; // Ambil ID foto dari parameter URL
    $sql = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid = '$fotoid'");
    while ($data = mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?=$no++?></td>
            <td><?= $data['namalengkap'] ?></td>
            <td><?= $data['isikomentar'] ?></td>
            <td><?= $data['tanggalkomentar'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>

    </div>
</body>
</html>
