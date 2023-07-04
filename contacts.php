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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Компьютерный клуб "GRADIENT"</title>
</head>
<body>
    
<?php 
    include 'header.php';
?>

    <main class="contacts-main">

        <section class="contacts">
            
            <ul>
                <li class="contact-text-h1">
                    <h1>Контакты</h1>
                </li>
                <li>
                    <span class="contacts-text-name">Адрес:</span><br>
                    <span class="contacts-text">Кострома, пл. Мира, 34</span>
                </li>
                <li>
                    <span class="contacts-text-name">Телефон:</span><br>
                    <span class="contacts-text">8 (950) 245 10-80</span>
                </li>
                <li>
                    <span class="contacts-text-name">E-mail</span><br>
                    <span class="contacts-text">gradient.kostroma@gmail.com</span>
                </li>
                <li>
                    <span>ООО "РИКИС"</span><br>
                    <span>ИНН: 2368010296</span><br>
                    <span>ОГРН: 1182375044697</span><br>
                    <span>Почтовый адрес: 352630, Краснодарский кр, город
                        Белореченск, район Белореченский, улица Интернациональная,
                        дом 30</span>
                </li>
            </ul>
        </section>

        <section class="contacts-map">
            <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/7/kostroma/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Кострома</a><a href="https://yandex.ru/maps/7/kostroma/house/kalinovskaya_ulitsa_2/YEkYfwRmTkEOQFttfXt2eHtlbA==/?ll=40.935712%2C57.778125&utm_medium=mapframe&utm_source=maps&z=16.6" style="color:#eee;font-size:12px;position:absolute;top:14px;">Калиновская улица, 2 — Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?ll=40.935712%2C57.778125&mode=whatshere&whatshere%5Bpoint%5D=40.936696%2C57.779771&whatshere%5Bzoom%5D=17&z=16.6" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
        </section>

    </main>

<?php 
    include ('assets/for_index/footer/index.php');
?>

</body>
</html>