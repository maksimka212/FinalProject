<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <link rel="stylesheet" href="assets/style1.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;900&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Компьютерный клуб "GRADIENT"</title>
</head>

<body>
  <?php
  include 'assets/for_index/header/index.php';
  ?>
  <!-- ---------------------------------- main --------------------------------------- -->
  <main>
    <h1 style="display: none;">Главная страница</h1>
    <section class="Agit">
      <div class="margin_agit">
        <h1>ВРЫВАЙСЯ В ИГРУ С КОМПЬЮТЕРНЫМ КЛУБОМ - GRADIENT</h1>
        <div class="agit_arrow_down">
          <h2>Играй в свое удовольствие!</h2>
          <div class="arrow_full">
            <a href="#js-grid">
              <div class="agit_arrow_down_a">
                <span></span>
                <span></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- -------------- sections ------------------- -->



    <?php
    include('assets/for_index/blocks/advantages.php');       // section advantages
    if (!$_SESSION) include('assets/for_index/blocks/personal_account.php'); // section personal_account
    include('assets/for_index/blocks/prices.php');           // section prices
    include('assets/for_index/blocks/configurations.php');   // section configurations
    ?>
    <div class="gallery">
    <a tabindex="1"><img src="img/image1HD.jpg"></a>
    <a tabindex="2"><img src="img/image2HD.jpg"></a>
    <a tabindex="3"><img src="img/image3HD.jpg"></a>
    <a tabindex="4"><img src="img/image4HD.jpg"></a>
    <a tabindex="5"><img src="img/image5HD.jpg"></a>
</div>
    <?php
    include('assets/for_index/footer/index.php')             // section index
    ?>
  </main>

  <script src="assets/main.js"></script>

</body>

</html>