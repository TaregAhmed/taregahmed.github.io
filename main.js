
document.addEventListener('DOMContentLoaded', function() {
    // تحديث سنة حقوق النشر
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    
    // معالجة التبديل بين التبويبات
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
      button.addEventListener('click', () => {
        // إزالة الفئة النشطة من جميع الأزرار والمحتويات
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));
        
        // إضافة الفئة النشطة للزر المحدد
        button.classList.add('active');
        
        // عرض المحتوى المناسب
        const tabId = button.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
      });
    });
    
    // معالجة نموذج الاتصال
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
      contactForm.addEventListener('submit', function(event) {
        // سيتم إرسال النموذج إلى contact.php
        // هذا المكان لإضافة التحقق من صحة النموذج في جانب العميل إذا لزم الأمر
      });
    }
    
    // تمرير سلس للروابط الداخلية
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  });
  