<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "بريد إلكتروني غير صالح.";
        exit;
    }

    $to = "info@example.com"; 
    $subject = "رسالة جديدة من موقعك";
    $body = "الاسم: $name\nالبريد الإلكتروني: $email\nالرسالة:\n$message\n";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "تم إرسال رسالتك بنجاح.";
    } else {
        echo "حدث خطأ أثناء الإرسال.";
    }
} else {
    echo "طلب غير صالح.";
}
?>
