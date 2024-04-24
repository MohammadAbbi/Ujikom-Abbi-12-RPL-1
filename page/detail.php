<?php 
$details=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.UserID=user.UserID WHERE foto.FotoID='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]' AND UserID='".@$_SESSION['user_id']."'"));
?>
<center><div class="card w-96 bg-base-100 shadow-xl mt-20  ">
  <figure> <img src="uploads/<?= $data['LokasiFile'] ?>" alt="<?= $data['JudulFoto'] ?>" class="object-fit-cover"></figure>
  <div class="card-body">
    <h2 class="card-title">
    <?= $data['JudulFoto'] ?><a href="<?php if(isset($_SESSION['user_id'])) 
    {echo '?url=like&&id='.$data['FotoID'].'';}else{echo 'login.php';} ?>" class="btn btn-sm <?php if($cek==0){echo "text-active " ;}else{echo "text-error";} ?> "><i class="fa-regular fa-heart"></i> <?= $likes ?></a>
    </h2>
    <p class="card-actions justify-start" ><?= $data['DeskripsiFoto'] ?></p>
    <div class="card-actions justify-end">
      <div class="badge badge-outline">by:<?= $data['Username'] ?></div> 
      <div class="badge badge-outline"><?= $data['TanggalUnggah'] ?></div>
    </div>
  </div></center>
  </div>

  <?php 
  $komen_id=@$_GET["komentar_id"];
               $submit=@$_POST['submit'];
               $komentar=@$_POST['komentar'];
               $foto_id=@$_POST['foto_id'];
               $user_id=@$_SESSION['user_id'];
               $tanggal=date('Y-m-d');
               $dataKomentar=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM komentarfoto WHERE KomentarID='$komen_id' AND UserID='$user_id' AND FotoID='$foto_id'"));
               if ($submit=='Kirim') {
                  $komen=mysqli_query($conn, "INSERT INTO komentarfoto VALUES('','$foto_id','$user_id','$komentar','$tanggal')");
                  header("Location: ?url=detail&&id=$foto_id");
               }elseif($submit=='Edit'){
                  
               }

               ?>
  <center><form action="?url=detail" method="post">

   <input type="hidden" name="foto_id" value="<?= $data['FotoID'] ?>">
   <?php if(isset($_SESSION['user_id'])): ?>
   <input type="hidden" name="foto_id" value="<?= $data['FotoID'] ?>">
   <textarea placeholder="Comment"  name="komentar" required placeholder="Masukan Komentar" class="textarea textarea-bordered textarea-md w-full max-w-xs mt-10" ></textarea>
   <p></p>
   <a href="?url=home" class="btn btn-error">Kembali</a> <input type="submit" value="Kirim" name="submit" class="btn btn-success m-2 ">
   <?php endif; ?></center>
   </form>
   <hr>
   <p class="text-center" >Comment</p>
   <div class="overflow-x-auto">
  <table class="table ">
    <!-- head -->
    <thead>
      <tr>
        <th>Name</th>
        <th>Comment</th>
        <th>Date</th>
        <th></th>

      </tr>
    </thead>
    <tbody>
    <?= @$alert ?>
    
         <?php 
         if(isset($_SESSION["user_id"])) {
          $user_id = $_SESSION["user_id"];
      } else {
          // Pengguna belum login, atur $user_id ke nilai default atau berikan pesan kepada pengguna
          $user_id = 0; // Nilai default
          // Atau Anda dapat memberi tahu pengguna bahwa mereka perlu login untuk melihat komentar
          // echo "Anda perlu login untuk melihat komentar";
      }
         
         $UserID=@$_SESSION["user_id"]; $komen=mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID=user.UserID INNER JOIN foto ON komentarfoto.FotoID=foto.FotoId WHERE komentarfoto.FotoID='$_GET[id]' AND user.UserID = $user_id");
         foreach($komen as $komens): ?>
      <!-- row 1 -->
      <tr class="">
        <td><?= $komens['Username']?></td>
        <td><?= $komens['IsiKomentar'] ?></td>
        <td><?= $komens['TanggalKomentar'] ?></td>

        <td><a href="komentar_hapus.php?komenid=<?= $komens['KomentarID']?>"><svg width="30px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></a>

          </td>
          </tr>
          
      <?php endforeach; ?>
      <?php $UserID=@$_SESSION["user_id"]; $komen=mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID=user.UserID INNER JOIN foto ON komentarfoto.FotoID=foto.FotoId WHERE komentarfoto.FotoID='$_GET[id]' AND user.UserID != $user_id");
         foreach($komen as $komens): ?>
      <!-- row 1 -->
      <tr class="">
        <td><?= $komens['Username']?></td>
        <td><?= $komens['IsiKomentar'] ?></td>
        <td><?= $komens['TanggalKomentar'] ?></td>


          </td>
          </tr>
          
      <?php endforeach; ?>
      
      
        
      </div>

</div>
