<?php
session_start();
if ($_SESSION['accountlvl'] != 2) {
    echo '<script>window.location = "index.php";</script>';
}
?>

<?php
$error = '';
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
    <script src="assets/main.js"></script>
    <script>
        function sweet_true(sw_icon, sw_title) {
            Swal.fire({
            position: 'top-end',
            icon: sw_icon,
            title: sw_title,
            showConfirmButton: false,
            timer: 1500
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





    <div class="account-interface">
        <section class="account-interface_block">
            <h1>Добавить модератора</h1>
            <form method="post" action="" name="login-form" class="account-lvl-up" action="">
                <legend>укажите почту привязанную к назначаемому аккаунту</legend>
                <input name="email" type="email" placeholder="pochta@yamdex.ru">
                <button type="submit" name="login" value="login">Назначить модератором</button>
            </form>
        </section>

        <section class="account-interface_block">
            <h1>Модераторы</h1>
            <form class="left_text" method="post" action="">
                <?php
                $queryModerID = $connection->prepare("SELECT id_user FROM users WHERE accountlvl=1");
                $queryModerID->execute();
                $resultModerID = $queryModerID->fetchall(PDO::FETCH_COLUMN);
                $queryModer = $connection->prepare("SELECT email FROM users WHERE accountlvl=1");
                $queryModer->execute();
                $resultModer = $queryModer->fetchall(PDO::FETCH_COLUMN);
                $queryModerAccountlvl = $connection->prepare("SELECT id_user FROM users WHERE accountlvl=1");
                $queryModerAccountlvl->execute();
                $resultModerAccountlvl = $queryModerAccountlvl->fetchall(PDO::FETCH_COLUMN);
                $index = 0;

                while ($index < count($resultModer)) {
                    echo "<button type='submit' name='deleteModer' value='" . $resultModerID[$index] . "'  class='deleteModer'>Удалить</button>" . $resultModer[$index] . "<br>\r\n";
                    $index++;
                }
                if (isset($_POST['deleteModer'])) {
                    $query1 = $connection->prepare("UPDATE users SET accountlvl = 0 WHERE id_user=:id_user");
                    $query1->bindParam("id_user", $_POST['deleteModer'], PDO::PARAM_STR);
                    $query1->execute();
                    header("Refresh:1");
                    echo "<script>sweet_true('success', 'Модератор разжалован!')</script>";
                }

                ?>
            </form>
        </section>
    </div>

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