<div class="container">
    <div class="row justify-content-center">
        <div class="text-center">
         <div class="card ml-20 mt-20">
                <div class="card-body">
                    <h2>Halaman Profile</h2>
                    <?php
                    $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE UserID='{$_SESSION['user_id']}'"));
                    if (isset($_POST['editprofile'])) {
                        $nama = $_POST['nama'];
                        $email = $_POST['email'];
                        $username = $_POST['username'];
                        $alamat = $_POST['alamat'];
                        if (isset($username) && isset($email)) {
                            if ($username == $user['Username'] && $email == $user['Email'] && $alamat == $user['Alamat']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET NamaLengkap='$nama' WHERE UserID='$_SESSION[user_id]'");
                                $session = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE UserID='$_SESSION[user_id]'"));
                                if ($ubah) {
                                    $_SESSION['userid'] = $session['UserID'];
                                    $_SESSION['username'] = $session['Username'];
                                    $_SESSION['namalengkap'] = $session['NamaLengkap'];
                                    $_SESSION['email'] = $session['Email'];
                                    $alert = 'Ubah nama berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah nama gagal';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                }
                            } else if ($username == $user['Username'] && $email == $user['Email'] && $nama == $user['NamaLengkap']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET Alamat='$alamat' WHERE UserID='$_SESSION[user_id]'");
                                if ($ubah) {
                                    $alert = 'Ubah alamat berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah alamat berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                }
                            } else if ($username == $user['Username'] && $alamat == $user['Alamat'] && $nama == $user['NamaLengkap']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET Email='$email' WHERE UserID='$_SESSION[user_id]'");
                                $session = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE UserID='$_SESSION[user_id]'"));
                                if ($ubah) {
                                    $_SESSION['userid'] = $session['UserID'];
                                    $_SESSION['username'] = $session['Username'];
                                    $_SESSION['namalengkap'] = $session['NamaLengkap'];
                                    $_SESSION['email'] = $session['Email'];
                                    $alert = 'Ubah email berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah email berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                }
                            } else if ($email == $user['Email'] && $alamat == $user['Alamat'] && $nama == $user['NamaLengkap']) {
                                $ubah = mysqli_query($conn, "UPDATE user SET Username='$username' WHERE UserID='$_SESSION[user_id]'");
                                $session = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE UserID='$_SESSION[user_id]'"));
                                if ($ubah) {
                                    $_SESSION['userid'] = $session['UserID'];
                                    $_SESSION['username'] = $session['Username'];
                                    $_SESSION['namalengkap'] = $session['NamaLengkap'];
                                    $_SESSION['email'] = $session['Email'];
                                    $alert = 'Ubah username berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                } else {
                                    $alert = 'Ubah username berhasil';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editprofile">';
                                }
                            }
                        }
                    } else if (isset($_POST['editpassword'])) {
                        $password = md5($_POST['password']);
                        if ($password != $user['Password']) {
                            $ubah = mysqli_query($conn, "UPDATE user SET Password='$password' WHERE UserID='$_SESSION[user_id]'");
                            if ($ubah) {
                                $alert = 'Ubah password berhasil';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editpassword">';
                            } else {
                                $alert = 'Ubah password gagal';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=profile&&proses=editpassword">';
                            }
                        }
                    }
                    ?>
                    
                    <?php echo @$alert; if (@$_GET['proses'] == 'editprofile') : ?>
                        <form action="?url=profile&&proses=editprofile" method="post">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Edit Profile</h5>
               
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        Nama Lengkap</label>
                    <input type="text"  value="<?= $user['NamaLengkap'] ?>" id="nama" name="nama" required placeholder="Masukan Nama Lengkap"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                         >
                </div>
                <div>
                    <label for="Email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        Email</label>
                    <input type="text"   value="<?= $user['Email'] ?>" id="email" name="email" required placeholder="Masukan Email Anda"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                         >
                </div>
                <div>
                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        Username</label>
                    <input type="text" value="<?= $user['Username'] ?>" id="username" name="username" required placeholder="Masukan Username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                         >
                </div>
                <div>
                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        Alamat</label>
                    <input type="text" value="<?= $user['Alamat'] ?>" name="alamat" required placeholder="Masukan Alamat Lengkap"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                         >
                </div>
                
                  
                <button type="submit" value="Simpan Perubahan" name="editprofile"
                    class="m-2 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan
                    </button>
                    <button type="submit"
                    class="m-2 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><a href="?url=profile" >Kembali</a>
                    </button>
                
                    
                   

            </form>
                    <?php elseif (@$_GET['proses'] == 'editpassword') : ?>
                        <form action="?url=profile&&proses=editpassword" method="post">
                        <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan
                        password</label>
                    <input type="password" name="password"  id="password" name="password" required placeholder="Masukan Password Baru"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                            <a href="?url=profile" class="btn btn-dark fw-semibold">Kembali</a>
                            <input type="submit" value="Simpan Perubahan" name="editpassword" class="btn btn-primary fw-semibold">
                        </form>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-white table-hover">
                                <tr>
                                    <th style="width: 20%;" class="py-3">Nama Lengkap</th>
                                    <td class="py-3 text-muted"><?= $user['NamaLengkap'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;" class="py-3">Email</th>
                                    <td class="py-3 text-muted"><?= $user['Email'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;" class="py-3">Username</th>
                                    <td class="py-3 text-muted"><?= $user['Username'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;" class="py-3">Alamat</th>
                                    <td class="py-3 text-muted"><?= $user['Alamat'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <a href="?url=profile&&proses=editprofile" class="btn btn-danger">Edit Profil</a>
                        <a href="?url=profile&&proses=editpassword" class="btn btn-primary">Edit Password</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>