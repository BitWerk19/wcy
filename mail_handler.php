<?php
// 获取表单数据
$name = $_POST['Name'] ?? '';
$email = $_POST['email'] ?? '';
$date = $_POST['Datum'] ?? '';
$time = $_POST['Uhrzeit'] ?? '';
$persons = $_POST['Personen'] ?? '';
$phone = $_POST['Telefon'] ?? '';
$message = $_POST['Nachricht'] ?? '';

// 验证邮箱
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "无效的邮箱地址";
  exit;
}

// 邮件内容
$subject = "Neue Reservierung von $name";
$body = "Neue Reservierung:\n\n"
      . "Name: $name\n"
      . "Email: $email\n"
      . "Telefon: $phone\n"
      . "Datum: $date\n"
      . "Uhrzeit: $time\n"
      . "Personen: $persons\n"
      . "Nachricht: $message\n";

// 发邮件给老板
$adminEmail = "silkbowls@gmail.com";
$headers = "From: $email\r\nReply-To: $email\r\n";
mail($adminEmail, $subject, $body, $headers);

// 自动回复客户
$autoSubject = "Ihre Reservierung bei 味纯园";
$autoBody = "Danke, $name!\n\n"
          . "Wir haben Ihre Reservierung erhalten:\n"
          . "- Datum: $date\n"
          . "- Uhrzeit: $time\n"
          . "- Personen: $persons\n\n"
          . "Wir freuen uns auf Ihren Besuch!\n味纯园 Handmade Noodles";
$autoHeaders = "From: 味纯园 <silkbowls@gmail.com>\r\n";
mail($email, $autoSubject, $autoBody, $autoHeaders);

// 返回成功响应
http_response_code(200);
echo "Reservierung erfolgreich gesendet!";
?>
