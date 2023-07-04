<meta charset="UTF-8">
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
    <title>Вход</title>
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
        session_start();
        include('config.php');
        if (isset($_POST['login'])) {
            $email = $_POST['login-email'];
            $password = $_POST['password'];
            $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
              echo "<script>sweet_true('error','Неверные почта или пароль');console.log('1');</script>";;
            } else {
                if (password_verify($password, $result['password'])) {
                    $_SESSION['user_id'] = $result['id_user'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['accountlvl'] = $result['accountlvl'];
                    $_SESSION['phone'] = $result['phone'];
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['timeonline_users'] = $result['timeonline_users'];
                    switch ($_SESSION['accountlvl']){
                      case 0: $redirect_url = "/accountUser.php"; break;
                      case 1: $redirect_url = "/accountModer.php"; break;
                      case 2: $redirect_url = "/accountAdmin.php"; break;
                      default: $redirect_url = "/accountUser.php";
                    }
                    echo "<div class=\"alert\">Поздравляем, вы прошли авторизацию!</div>
                    <script>window.location =  \"$redirect_url \";</script>";
                    
                } else {
                  echo "<script>sweet_true('error','Неверные данные!');</script>";
                }
            }
        }
    ?>

<section class="form_inputs">
    <h1>Вход</h1>

    <form method="post" action="">

      <div class="form_row"><label for="email_user">почта</label>             <input type="email" name="login-email" id="login-email" placeholder="ghffhgsuvhis635@gmail.com" required></div>
      <div class="form_row"><label for="password_user">Пароль</label>         <input type="password" name="password" id="password_user" placeholder="*********" required></div>
      <button type="submit" name="login" value="login">Войти</button>
      <a href="register.php">Вы еще не зарегистрированы?</a>
      <a href="index.php#account_url">На главную</a>
    </form>
      
  </section>
    
</body>
</html>