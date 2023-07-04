 
 <?php
        $unlogin = '<a href="#account_url">войти</a>';
        $login0 = '<a class="nav-button-login" href="accountUser.php">Личный кабинет</a>';
        $login1 = '<a class="nav-button-login" href="accountModer.php">Admin Panel</a>';
        $login2 = '<a class="nav-button-login" href="accountAdmin.php">Admin Panel</a>'; 
    ?>

<header>
      <input class="side-menu" type="checkbox" id="side-menu"/>
      <label class="hamb" for="side-menu"><span class="hamb-line"></span></label>
      <nav class="left_wrapper">
        <a href="index.php">Главная</a> 
        <a href="index.php#prices_url">Цены</a>
      </nav>
        <img class="nav-logo" src="img/logo.svg" alt="">
      <nav class="right_wrapper">
      <a href="index.php#contacts_url">Контакты</a>
        <?php
            if(!(isset($_SESSION['user_id']))){
                echo $unlogin;
            }
            else{
                if($_SESSION['accountlvl'] == "0"){
                    echo $login0;
                }
                else{
                    if($_SESSION['accountlvl'] == "1"){
                        echo $login1;
                    }
                    else{
                        if($_SESSION['accountlvl'] == "2"){
                            echo $login2;
                        }  
                    }
                }
            
            }
        ?>
        
      </nav>
      <div class="mobile_nav_background"></div>
</header>