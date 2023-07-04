<header>
      <input class="side-menu" type="checkbox" id="side-menu"/>
      <label class="hamb" for="side-menu"><span class="hamb-line"></span></label>
      <nav class="left_wrapper">
        <a href="index.php#prices_url">Цены</a>
        <a href="index.php#configurations_url">Конфигурации</a>
      </nav>
        <a href="../../index.php"><img src="assets/images/logo.svg" alt=""></a>
      <nav class="right_wrapper">
        <?php
        if (isset($_SESSION['accountlvl'])) {
           switch ($_SESSION['accountlvl']){
            case 0: $redirect_url = "/accountUser.php"; break;
            case 1: $redirect_url = "/accountModer.php"; break;
            case 2: $redirect_url = "/accountAdmin.php"; break;
            default: $redirect_url = "/accountUser.php";
          }
          echo "<a href='".$redirect_url."'>Личный кабинет</a>";
        } else {
          echo "<a href='index.php#account_url'>Личный кабинет</a>";
        }
        ?>
        <a href="index.php#contacts_url">Контакты</a>
      </nav>
      <div class="mobile_nav_background"></div>
</header>