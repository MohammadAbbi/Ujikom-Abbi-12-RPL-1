
<!DOCTYPE html>
<html data-theme="dark"  lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>


<div class="grid grid-cols-3 gap-7 mt-20 ml-20">
<?php 
        $tampil=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.UserID=user.UserID");
        foreach($tampil as $tampils):
        ?>
  <div> 
  <div class="card w-96 bg-base-100 shadow-xl p-7">
  <figure><img src="uploads/<?= $tampils['LokasiFile'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9;"></figure>
  <div class="card-body">
    <h2 class="card-title"><?= $tampils['JudulFoto'] ?></h2>
    <p><?= $tampils['DeskripsiFoto'] ?></p>
    <div class="card-actions justify-end">
    <p class="card-text text-muted">by: <?= $tampils['Username'] ?></p>
      <a href="?url=detail&&id=<?= $tampils['FotoID'] ?>" class="btn btn-primary">See More</a>
    </div>
  </div>
</div>
  </div>
  <?php endforeach; ?>
</div>
  </div>
</body>
</html>