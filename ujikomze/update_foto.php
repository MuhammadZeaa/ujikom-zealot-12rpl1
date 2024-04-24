<?php
include "koneksi.php";
session_start();

if(isset($_POST['judulfoto']) && isset($_POST['deskripsifoto'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];

    // Jika ada file gambar yang diunggah
    if($_FILES['lokasifile']['name'] != ""){
        $rand = rand();
        $ekstensi = array('png','jpg','jpeg','gif');
        $filename = $_FILES['lokasifile']['name'];
        $ukuran = $_FILES['lokasifile']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        // Memeriksa ekstensi file
        if(!in_array($ext, $ekstensi)) {
            $_SESSION['error'] = "Ekstensi file tidak valid. Hanya file PNG, JPG, JPEG, dan GIF yang diperbolehkan.";
            header("location:foto.php");
            exit();
        }

        // Memeriksa ukuran file (1MB = 1048576 bytes)
        if($ukuran > 1048576){		
            $_SESSION['error'] = "Ukuran file terlalu besar. Maksimum ukuran file adalah 1MB.";
            header("location:foto.php");
            exit();
        }

        // Pindahkan file yang diunggah ke folder gambar
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['lokasifile']['tmp_name'], 'gambar/' . $rand . '_' . $filename);

        // Update data foto
        $stmt = $conn->prepare("UPDATE foto SET judulfoto=?, deskripsifoto=?, lokasifile=? WHERE fotoid=?");
        $stmt->bind_param("sssi", $judulfoto, $deskripsifoto, $xx, $_POST['fotoid']);
        $stmt->execute();
    } else {
        // Update data foto tanpa mengubah gambar
        $stmt = $conn->prepare("UPDATE foto SET judulfoto=?, deskripsifoto=? WHERE fotoid=?");
        $stmt->bind_param("ssi", $judulfoto, $deskripsifoto, $_POST['fotoid']);
        $stmt->execute();
    }
    
    header("location:foto.php");
    exit();
} else {
    // Jika data tidak lengkap
    $_SESSION['error'] = "Data tidak lengkap.";
    header("location:foto.php");
    exit();
}
?>
