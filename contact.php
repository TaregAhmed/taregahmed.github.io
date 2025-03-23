
<?php
// التحقق من طريقة الإرسال
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على بيانات النموذج
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // التحقق من صحة البيانات
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "الاسم مطلوب";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "البريد الإلكتروني غير صالح";
    }
    
    if (empty($message)) {
        $errors[] = "الرسالة مطلوبة";
    }
    
    // إذا لم تكن هناك أخطاء، قم بإرسال البريد الإلكتروني
    if (empty($errors)) {
        // عنوان البريد الإلكتروني للمستلم
        $to = "info@shifaa-pharma.com";
        
        // عنوان البريد الإلكتروني
        $subject = "رسالة جديدة من موقع شركة الشفاء";
        
        // محتوى البريد الإلكتروني
        $email_content = "الاسم: $name\n";
        $email_content .= "البريد الإلكتروني: $email\n";
        
        if (!empty($phone)) {
            $email_content .= "رقم الهاتف: $phone\n";
        }
        
        $email_content .= "الرسالة:\n$message\n";
        
        // ترويسات البريد الإلكتروني
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // محاولة إرسال البريد الإلكتروني
        if (mail($to, $subject, $email_content, $headers)) {
            // إعادة التوجيه إلى الصفحة الرئيسية مع رسالة نجاح
            header("Location: index.html?status=success#contact");
            exit;
        } else {
            // إعادة التوجيه مع رسالة خطأ
            header("Location: index.html?status=error#contact");
            exit;
        }
    } else {
        // إعادة التوجيه مع أخطاء التحقق
        $error_string = implode(",", $errors);
        header("Location: index.html?status=validation_error&errors=$error_string#contact");
        exit;
    }
} else {
    // إذا تم الوصول إلى هذا الملف مباشرة، قم بإعادة التوجيه إلى الصفحة الرئيسية
    header("Location: index.html");
    exit;
}
?>
