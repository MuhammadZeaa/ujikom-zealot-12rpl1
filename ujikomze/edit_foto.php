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
    <title>Halaman Edit Foto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
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
        input[type="text"], input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman Edit Foto</h1>
        <p>Selamat Datang di Halaman Edit Foto <b><?=$_SESSION['namalengkap']?></b></p>

        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>

        <form action="update_foto.php" method="post" enctype="multipart/form-data">
            <?php
                include "koneksi.php";
                $fotoid=$_GET['fotoid'];
                $sql=mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
            <table>
                <tr>
                    <td>Judul</td>
                    <td><input type="text" name="judulfoto" value="<?=$data['judulfoto']?>"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsifoto" value="<?=$data['deskripsifoto']?>"></td>
                </tr>
                <tr>
                    <td>Lokasi File</td>
                    <td><input type="file" name="lokasifile"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Ubah"></input></td>
                <?php
                    }
                ?>