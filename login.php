<?php include 'koneksi.php'; session_start() ?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>
    <center>
        <div
            class="mt-40 text-left place-content-center w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <?php 
                  //ambil data yang di kirim kan oleh <form> dengan method post
                  $submit=@$_POST['submit'];
                  if($submit=='Login'){
                     $username=$_POST['username'];
                     $password=md5($_POST['password']);
                     //cek apakah username dan password yang di masukan ke dalam <input> ada di database
                     $sql=mysqli_query($conn, "SELECT * FROM user WHERE Username='$username' AND Password='$password'");
                     $cek=mysqli_num_rows($sql);
                     if ($cek!=0) {
                        //ambil data dari database untuk membuat session
                        $sesi=mysqli_fetch_array($sql);
                        echo 'Login Berhasil!!!';
                        $_SESSION['username']=$sesi['Username'];
                        $_SESSION['user_id']=$sesi['UserID'];
                        $_SESSION['email']=$sesi['Email'];
                        $_SESSION['nama_lengkap']=$sesi['NamaLengkap'];
                        echo '<meta http-equiv="refresh" content="0.8; url=./">';
                     }else{
                        echo 'Login Gagal!!!';
                        echo '<meta http-equiv="refresh" content="0.8; url=login.php">';
                     }
                  }
                  ?>
            <form class="space-y-6" action="login.php" method="post">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Login</h5>
               
                <div>
                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        Username</label>
                    <input type="text" name="username" id="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="12345678" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>

                <p class="text-center"><a href="daftar.php" >CREATE ACCOUNT</a></p>
                  
                <button type="submit" name="submit" value="Login"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                    to your account</button>

            </form>
        </div>
    </center>

</body>

</html>