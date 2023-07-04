<?php
session_start();
if (!$_SESSION['user_id'])
    header('location: login.php');
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
    include 'assets/for_index/header/index.php';
    include 'config.php';
    if (isset($_POST['submit_redact_profil'])) {
        $pw_hash = password_hash($_POST['input_pass_redact'], PASSWORD_BCRYPT) ;
        $query = $connection->prepare("UPDATE `users` SET `username`='".$_POST['input_name_redact']."',`password`='".$pw_hash."',`email`='".$_POST['input_email_redact']."',`phone`='".$_POST['input_phone_redact']."' WHERE id_user = ".$_SESSION['user_id']);
        $query->execute();
        $_SESSION['username'] = $_POST['input_name_redact'];
        $_SESSION['email'] = $_POST['input_email_redact'];
        $_SESSION['phone'] = $_POST['input_phone_redact'];
        echo '<script>sweet_true("success", "Данные изменены!")</script>';
    }
    if (isset($_POST['delete_reservation'])) {
        $query = $connection->prepare("UPDATE `reservations` SET `duration_reservation`='0' WHERE id_reservation=:id_reservation");
        $query->bindParam("id_reservation", $_POST['delete_reservation'], PDO::PARAM_STR);
        $query->execute();
        echo '<meta http-equiv="refresh" content="0">';
    }
    ?>
    <section class="greeting">
        <div class="greeting_block">
            <h2 class="maxi_header">Здравствуйте <?php echo $_SESSION['username'] ?>!</h2>
        </div>
        <div class="greeting_block">
            <a href="session-destroy.php"><button href="session-destroy.php" class="btn_a">Выйти из аккаунта</button></a>
        </div>
        <div class="info_user">
            <p>Ваши данные: </p>
            <div class="info_user_wimg"></div>
            <div class="info_user_data">
                <form action="" method="post">
                <div class="head_info_user">
                    <p id="phone_redact_profil"><?= $_SESSION['phone'] ?></p>
                    <img class="nav-logo" src="img/logo.svg" alt="">
                </div>
                <div class="body_info_user">
                    <p id="name_redact_profil"><?= $_SESSION['username'] ?></p>
                </div>
                <div class="foot_info_user">
                    <p></p>
                    <p id="email_redact_profil"><?= $_SESSION['email'] ?></p>
                </div>
                <div id="div_redact_profil">
                        <button id="redact_profil" onclick="replace();">Редактировать профиль</button>
                </div>
                </form>
            </div>

            <p id="book">Ваши бронирования:</p>
            <button onclick="addStyle()" class="btn_a" id="ss">Показать удаленные брони</button>
           
        </div>

    </section>

    <form action="" method="post">

        <div id="page_bookings">
            <div class="container_bookings">
                <?php

                $query = $connection->prepare("SELECT reservations.*, tables.*, users.*
                                                FROM reservations
                                                JOIN tables ON reservations.has_id_table = tables.id_table
                                                JOIN users ON reservations.has_id_user = id_user;");
                $result = $query->execute();
                $reservations = $query->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < count($reservations); $i++) {
                    if ($reservations[$i]['id_user'] == $_SESSION['user_id']) {
                        $barcode = 100000000000 + strtotime($reservations[$i]['date_reservation']) + $reservations[$i]['id_reservation'] + $reservations[$i]['id_user'];
                        if ($reservations[$i]['duration_reservation'] == 0) echo '<div class="bookings_block dn">';
                        else {
                            echo '<div class="bookings_block">';
                        }
                        echo '  <div class="bookings_item">
                                <span style="text-align: center;">OOO «GRADIENT»</span>
                                <p>Кассовый чек № ' . $reservations[$i]['id_reservation'] . '</p>
                                <hr>
                                <p>Дата бронирования: <br> ' . $reservations[$i]['date_reservation'] . '</p>
                                <p>Начало действия брони: <br> <strong>' . $reservations[$i]['time_begin_reservation'] . '</strong></p>
                                <div class="check_between"> <span>Компьютер №</span><span>' . $reservations[$i]['has_id_table'] . '</span> </div>
                                <div class="check_between"> <span>Телефон:</span><span>' . $reservations[$i]['phone'] . '</span> </div>
                                <div class="check_between"> <span>Длительность:</span><span>1 ЧАС</span> </div>
                                <div class="check_between"> <span>ИТОГО К ОПЛАТЕ</span><span>= ' . $reservations[$i]['price_hour_table'] . '&#8381;</span></div>
                                <br>
                                <svg class="barcode" jsbarcode-width="1" jsbarcode-height="35" jsbarcode-format="CODE39" jsbarcode-value="' . $barcode . '" jsbarcode-textmargin="0" jsbarcode-fontoptions="bold">
                                </svg>
                            </div>
                            <div class="check_between">';

                        if ($reservations[$i]['duration_reservation'] == 0) echo '<div class="red_back">бронь</div><div class="red_back">удалена</div>';
                        else echo '<button class="delete_reservation" name="delete_reservation" type="submit" value="' . $reservations[$i]['id_reservation'] . '">Удалить</button>';
                        echo '</div></div>
                        ';
                    }
                }
                ?>
            </div>
    </form>
    </div>
    <?php
    include('assets/for_index/footer/index.php');
    ?>
    
    <script type="text/javascript" src="assets/main.js"></script>
    <script src="assets/mask.js"></script>
    <script type="text/javascript" src="assets/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode(".barcode").init();
    </script>
    
</body>

</html>