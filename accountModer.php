<?php
    session_start();
    if ($_SESSION['accountlvl'] != 1)
        header('location: index.php');

        /*fdf */
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
    <title><? echo $_SESSION['username']?></title>
</head>
<body>
    <script src="assets/sweetalert2.all.min.js"></script>
    <script>
        function sweet_true(sw_icon, sw_title) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: sw_icon,
                title: sw_title
            })
        }
    </script>


    <?php
    include('config.php');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($result['accountlvl'] == 1) {
                echo "<script>sweet_true('error', 'пользователь $email уже назначен модератором!')</script>";
            } else {
                if ($result['accountlvl'] == 2) {
                    echo "<script>sweet_true('error', 'Недостаточно прав!')</script>";
                } else {
                    $query = $connection->prepare("UPDATE users SET accountlvl = 1 WHERE email=:email");
                    $query->bindParam("email", $email, PDO::PARAM_STR);
                    $query->execute();
                    echo "<script>sweet_true('success', 'Пользователь $email назначен модератором!')</script>";
                }
            }
        } else {
            echo "<script>sweet_true('error', 'Почта $email не зарегестрирована!')</script>";
        }
    }
    ?>

    <?php
    include 'assets/for_index/header/index.php';
    ?>
    <section class="greeting">

        <div class="greeting_block">
            <h2 class="maxi_header">Здравствуйте <?php echo $_SESSION['username'] ?>!</h2>
        </div>

        <div class="greeting_block">
        <a href="session-destroy.php"><button href="session-destroy.php" class="btn_a">Выйти из аккаунта</button></a>
        </div>

    </section>

    <?php
        include 'search.php';
    ?>

    <?php
        include('assets/for_index/footer/index.php');
    ?>
    <script src="assets/search.js"></script>
    <script type="text/javascript" src="assets/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode(".barcode").init();
    </script>
</body>
</html>