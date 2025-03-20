# Psych AI - منصة الدعم النفسي الذكية 🧠

<div dir="rtl">

## نظرة عامة 🌟
Psych AI هي منصة مبتكرة تجمع بين الذكاء الاصطناعي والدعم النفسي، مصممة لتقديم المساعدة والدعم النفسي باللغة العربية. المنصة تستخدم تقنية Google Gemini AI لتوفير تجربة محادثة طبيعية وفعالة.

## المميزات الرئيسية ✨
- **محادثة ذكية**: دردشة تفاعلية مع مساعد ذكي يفهم احتياجاتك النفسية
- **مقالات متخصصة**: محتوى نفسي موثوق من متخصصين معتمدين
- **فيديوهات تعليمية**: محتوى مرئي يساعد في فهم القضايا النفسية
- **نظام تعليقات**: تفاعل مجتمعي مع المحتوى والمقالات
- **لوحة تحكم للإدارة**: إدارة كاملة للمحتوى والمستخدمين
- **دعم متعدد الأدوار**: أدوار مختلفة للمستخدمين (مدير، طبيب، مستخدم عادي)

## المتطلبات التقنية 🛠
- PHP 8.2 أو أحدث
- Laravel 12.x
- Node.js & NPM
- MySQL/PostgreSQL
- Composer
- Google Gemini API Key

## التثبيت 📥

1. **استنساخ المشروع**
```bash
git clone https://github.com/yourusername/psych-ai.git
cd psych-ai
```

2. **تثبيت اعتماديات PHP**
```bash
composer install
```

3. **تثبيت اعتماديات Node.js**
```bash
npm install
```

4. **إعداد ملف البيئة**
```bash
cp .env.example .env
php artisan key:generate
```

5. **تكوين قاعدة البيانات**
```bash
php artisan migrate --seed
```

6. **بناء الأصول**
```bash
npm run build
```

7. **تشغيل المشروع**
```bash
php artisan serve
```

## التكوين ⚙️

### إعداد Gemini AI
1. احصل على مفتاح API من [Google AI Studio](https://makersuite.google.com)
2. أضف المفتاح إلى ملف `.env`:
```env
GEMINI_API_KEY=your_api_key_here
```

## الهيكل التنظيمي للمشروع 📁
```
├── app/
│   ├── Http/
│   ├── Models/
│   └── Services/
├── resources/
│   ├── views/
│   ├── js/
│   └── css/
└── routes/
```

## المساهمة 🤝
نرحب بمساهماتكم! يرجى اتباع الخطوات التالية:
1. Fork المشروع
2. إنشاء فرع للميزة الجديدة
3. تقديم Pull Request

## الترخيص 📄
هذا المشروع مرخص تحت [MIT License](LICENSE)

## الشكر والتقدير 💝
- شكر خاص لفريق Google Gemini AI
- جميع المساهمين في المشروع
- مجتمع Laravel

## التواصل 📞
- للأسئلة والاستفسارات: [your-email@example.com]
- تابعنا على تويتر: [@PsychAI]

</div>