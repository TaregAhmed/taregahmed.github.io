
<?php
// التحقق من طريقة الإرسال
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البريد الإلكتروني
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    // التحقق من صحة البريد الإلكتروني
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // إعادة التوجيه مع رسالة خطأ
        header("Location: index.html?newsletter=invalid_email#footer");
        exit;
    }
    
    // في الإنتاج، هنا ستقوم بإضافة البريد الإلكتروني إلى قاعدة البيانات أو إرساله إلى نظام إدارة النشرة الإخبارية
    // نموذج بسيط: كتابة البريد الإلكتروني في ملف
    $file = fopen("subscribers.txt", "a");
    fwrite($file, $email . "\n");
    fclose($file);
    
    // إعادة التوجيه مع رسالة نجاح
    header("Location: index.html?newsletter=success#footer");
    exit;
} else {
    // إذا تم الوصول إلى هذا الملف مباشرة، قم بإعادة التوجيه إلى الصفحة الرئيسية
    header("Location: index.html");
    exit;
}
?>
