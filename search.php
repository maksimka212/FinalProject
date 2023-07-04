<script src="assets/sweetalert2.all.min.js"></script>
<script>
    function warning() {
        Swal.fire(
        'Упс...',
        'Данная функция пока не доступна',
        'error'
)
    }
</script>
<section>
        <div class="account-interface_block">
            <h1>Найти брони</h1>
                <legend>Укажите почту пользователя или номер брони</legend>
                <input id="email_or_phone" type="text">
        </div>
        <form action="" method="post">
            <div id="page_bookings">
                <div class="container_bookings" id="search_result">
                    <?php
                        $query = $connection->prepare("SELECT reservations.*, tables.*, users.*
                                                    FROM reservations
                                                    JOIN tables ON reservations.has_id_table = tables.id_table
                                                    JOIN users ON reservations.has_id_user = id_user;");
                        $result = $query->execute();
                        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < count($reservations); $i++) {
                            $barcode = 100000000000 + strtotime($reservations[$i]['date_reservation']) + $reservations[$i]['id_reservation'] + $reservations[$i]['id_user'];
                                echo '
                            <div class="bookings_block" style="display: none;">
                                <div class="bookings_item">
                                    <span style="text-align: center;">OOO «GRADIENT»</span>
                                    <p class="search_numb">Кассовый чек № ' . $reservations[$i]['id_reservation'] . '</p>
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
                                    <div class="check_between search_email">'. $reservations[$i]['email'] .'</div>';
                                
                                    if ($reservations[$i]['duration_reservation'] == 0) echo '<div class="red_back">бронь удалена</div><button onclick="warning();" type="button">стереть</button>';
                                echo '</div></div>
                                ';
                        }

                    ?>
                </div>
            </div>
        </form>
    </section>