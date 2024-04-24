<?php 
include 'koneksi.php';

$id = $_GET["komenid"];
$user_id=@$_SESSION["user_id"];
$komen_id=@$_GET['komentar_id'];
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM komentarfoto WHERE KomentarID=$id"));
if ($cek > 0) {
   $delete=mysqli_query($conn, "DELETE FROM komentarfoto WHERE KomentarID=$id");
   echo '<script>alert("Anda berhasil menghapus komentar ini");</script>';
   echo '<meta http-equiv="refresh" content="0; index.php">';
   
} else {
   // User is not allowed to delete the comment
   $alert='Gagal hapus komentar';
   echo '<script>alert("Anda tidak berhak menghapus komentar ini");</script>';
   echo '<meta http-equiv="refresh" content="0; index.php">';
   
}
?>