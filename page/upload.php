<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card ">
                <div class="card-body">
                    <center><h4>Halaman Upload</h4></center>
                    <?php
                    //ambil data dari <form>
                    $submit = @$_POST['submit'];
                    $fotoid = @$_GET['fotoid'];
                    if ($submit == 'Simpan') {
                        $judul_foto = @$_POST['judul_foto'];
                        $deskripsi_foto = @$_POST['deskripsi_foto'];
                        $nama_file = @$_FILES['namafile']['name'];
                        $tmp_foto = @$_FILES['namafile']['tmp_name'];
                        $tanggal = date('Y-m-d');
                        $user_id = @$_SESSION['user_id'];
                        if (move_uploaded_file($tmp_foto, 'uploads/' . $nama_file)) {
                            $insert = mysqli_query($conn, "INSERT INTO foto VALUES('','$judul_foto','$deskripsi_foto','$tanggal','$nama_file','$user_id')");
                            echo 'Gambar Berhasil di simpan';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        } else {
                            echo 'Gambar gagal di simpan';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    } elseif (isset($_GET['edit'])) {
                        if ($submit == "Ubah") {
                            $judul_foto = @$_POST['judul_foto'];
                            $deskripsi_foto = @$_POST['deskripsi_foto'];
                            $nama_file = @$_FILES['namafile']['name'];
                            $tmp_foto = @$_FILES['namafile']['tmp_name'];
                            $tanggal = date('Y-m-d');

                            $user_id = @$_SESSION['user_id'];
                            if (strlen($nama_file) == 0) {
                                $update = mysqli_query($conn, "UPDATE foto SET JudulFoto='$judul_foto', DeskripsiFoto='$deskripsi_foto', TanggalUnggah='$tanggal' WHERE FotoID='$fotoid'");
                                if ($update) {
                                    echo 'Gambar Berhasil di Ubah';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                } else {
                                    echo 'Gambar gagal di Ubah';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                }
                            } else {
                                if (move_uploaded_file($tmp_foto, "uploads/" . $nama_file)) {
                                    $update = mysqli_query($conn, "UPDATE foto SET JudulFoto='$judul_foto', DeskripsiFoto='$deskripsi_foto', LokasiFile = '$nama_file', TanggalUnggah='$tanggal' WHERE FotoID='$fotoid'");
                                    if ($update) {
                                        echo 'Gambar Berhasil di Ubah';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    } else {
                                        echo 'Gambar gagal di Ubah';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    }
                                }
                            }
                        }
                    } elseif (isset($_GET['hapus'])) {
                        $delete = mysqli_query($conn, "DELETE FROM foto WHERE FotoID='$fotoid'");
                        if ($delete) {
                            echo 'Gambar Berhasil di Hapus';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        } else {
                            echo 'Gambar gagal di Hapus';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    }
                    //mencari data album
                    $val = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM foto WHERE FotoID='$fotoid'"));
                    ?>
                    <?php if (!isset($_GET['edit'])) : ?>
                        <section class="bg-cover bg-center h-screen  bg-no-repeat bg-[url('gambar/')] ">

<div class="flex justify-center items-center h-screen ">
    <div id="form" class="mb-10 block bg-slate-50 p-6 rounded-xl shadow-md shadow-slate-300 w-90">
    <form action="?url=upload" method="post" enctype="multipart/form-data"  class="w-[600px]">
           
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" required name="judul_foto" id="judul_foto"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="judul_foto"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Masukan
                    Judul Foto</label>
            </div>
            <div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text"  name="deskripsi_foto" id="deskripsi_foto"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="deskripsi_foto"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Masukan
                        Deskripsi Foto</label>
                </div>
           
                <div class="relative z-0 w-full mb-6 group">

                    <label class="block mt-4 mb-2 text-sm font-medium text-gray-900 "
                        for="berkas">Upload Gambar</label>
                    <input type="file"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="berkas" id="berkas" name="namafile">
                </div>
            </div>


            <button type="submit" value="Simpan" name="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
</div>
</section>

                        </form>
                        <?php elseif (isset($_GET['edit'])): ?>
                        <section class="bg-cover bg-center h-screen  bg-no-repeat bg-[url('gambar/')] ">

                            <div class="flex justify-center items-center h-screen ">
                                <div id="form"
                                    class="mb-10 block bg-slate-50 p-6 rounded-xl shadow-md shadow-slate-300 w-90">

                                    <form action="?url=upload&&edit&&fotoid=<?= $val['FotoID'] ?>" method="post"
                                        enctype="multipart/form-data" class="w-[600px]">

                                        <div class="relative z-0 w-full mb-6 group">
                                            <input type="text" required name="judul_foto" id="judul_foto"
                                                value="<?= $val['JudulFoto'] ?>"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="judul_foto"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Masukan
                                                Judul Foto</label>
                                        </div>
                                        <div>
                                            <div class="relative z-0 w-full mb-6 group">
                                                <input type="text" name="deskripsi_foto" id="deskripsi_foto"
                                                value="<?= $val['DeskripsiFoto'] ?>"
                                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required />
                                                <label for="deskripsi_foto"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Masukan
                                                    Deskripsi Foto</label>
                                            </div>

                                            <div class="relative z-0 w-full mb-6 group">

                                                <label class="block mt-4 mb-2 text-sm font-medium text-gray-900 "
                                                    for="berkas">Upload Gambar</label>
                                                <input type="file"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    aria-describedby="berkas" id="berkas" name="namafile">
                                            </div>
                                        </div>


                                        <button type="submit" value="Ubah" name="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                        </form>
                                    <?php endif; ?>
                </div>
            </div>
        </div>
        <center>
            
        <table class="table w-[1000px]">
  <thead>
  <?php

                $i = 1;
                $fotos = mysqli_query($conn, "SELECT * FROM foto WHERE UserID='" . @$_SESSION['user_id'] . "'");
                foreach ($fotos as $foto) : 
                ?>
    <tr>
      <th>No</th>
      <th>Foto</th>
      <th>Judul Foto</th>
      <th>DeskripsiFoto</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= $i;?></td>
      <td><img src="uploads/<?= $foto['LokasiFile'] ?>" class="w-[140px] h-auto"></td>
      <td><p class=""><?= $foto['JudulFoto'] ?></p></td>
      <td><p class=""><?= $foto['DeskripsiFoto'] ?></p></td>
      <td> <a href="?url=upload&&edit&&fotoid=<?= $foto['FotoID'] ?>" class="btn btn-sm btn-warning"><svg width="12px" height="12px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>edit [#1479]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-99.000000, -400.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M61.9,258.010643 L45.1,258.010643 L45.1,242.095788 L53.5,242.095788 L53.5,240.106431 L43,240.106431 L43,260 L64,260 L64,250.053215 L61.9,250.053215 L61.9,258.010643 Z M49.3,249.949769 L59.63095,240 L64,244.114985 L53.3341,254.031929 L49.3,254.031929 L49.3,249.949769 Z" id="edit-[#1479]"> </path> </g> </g> </g> </g></svg></a>
        <a href="?url=upload&&hapus&&fotoid=<?= $foto['FotoID'] ?>" class="btn btn-sm btn-error"><svg width="14px" height="14px" viewBox="-3 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#f2f2f2" stroke="#f2f2f2"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>trash</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-259.000000, -203.000000)" fill="#000000"> <path d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z" id="trash" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg></a></td>
    </tr>
  </tbody>
  <?php $i++; endforeach; ?>
</table></center>
    </div>
    </div>
</div>