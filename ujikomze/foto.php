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
    <title>Halaman Foto</title>
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
        img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .action-links a {
            margin-right: 10px;
            color: #333;
        }
        .action-links a:hover {
            color: #f00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman Foto</h1>
        <p>Selamat Datang di Halaman Foto <b><?=$_SESSION['namalengkap']?></b></p>

        <ul>
            <li><a href="landingpage.php">Landingpage</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>

        <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Judul Foto</td>
                    <td><input type="text" name="judulfoto"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsifoto"></td>
                </tr>
                <tr>
                    <td>Lokasi File</td>
                    <td><input type="file" name="lokasifile"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tambah"></td>
                </tr>
            </table>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Judul Foto</th>
                <th>Deskripsi</th>
                <th>Tanggal Unggah</th>
                <th>Lokasi File</th>
                <th>Disukai</th>
                <th>Aksi</th>
            </tr>
            <?php
                include "koneksi.php";
                $no = 1;
                $userid=$_SESSION['userid'];
                $sql=mysqli_query($conn, "select * from foto where foto.userid='$userid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$data['judulfoto']?></td>
                <td><?=$data['deskripsifoto']?></td>
                <td><?=$data['tanggalunggah']?></td>
                <td>
                    <img src="gambar/<?=$data['lokasifile']?>" alt="Foto <?=$data['judulfoto']?>">
                </td>
                <td>
                    <?php
                        $fotoid=$data['fotoid'];
                        $sql2=mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                        echo mysqli_num_rows($sql2);
                    ?>
                </td>
                <td class="action-links">
                    <a href="hapus_foto.php?fotoid=<?=$data['fotoid']?>" >Hapus</a><br><br><br>
                    <a href="edit_foto.php?fotoid=<?=$data['fotoid']?>" >Edit</a>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>
</html>
