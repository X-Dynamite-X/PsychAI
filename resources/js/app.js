// import './bootstrap';

import $ from 'jquery';
import "./auth/login"
import "./auth/register"
import "./auth/forgot_password"
import "./auth/reset_password"
import "./admin/users"
import "./app/chat"

// اختبار بسيط للتأكد من أن jQuery يعمل
$(document).ready(function() {
    console.log('jQuery is working!');
 });
 document.addEventListener('DOMContentLoaded', function() {

    const $themeToggleDarkIcon = $('#theme-toggle-dark-icon');
    const $themeToggleLightIcon = $('#theme-toggle-light-icon');
    const $themeToggleBtn = $('#theme-toggle');
    const $html = $('html');

    // تعيين الثيم الأولي بناءً على الإعدادات السابقة
    if (localStorage.getItem('theme') === 'dark' ||
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        $themeToggleLightIcon.removeClass('hidden');
        $html.addClass('dark');
    } else {
        $themeToggleDarkIcon.removeClass('hidden');
        $html.removeClass('dark');
    }

    // معالج النقر على زر تبديل الثيم
    $themeToggleBtn.on('click', function() {
        // تبديل الأيقونات
        $themeToggleDarkIcon.toggleClass('hidden');
        $themeToggleLightIcon.toggleClass('hidden');

        // التحقق من وجود الثيم في localStorage
        if (localStorage.getItem('theme')) {
            if (localStorage.getItem('theme') === 'light') {
                $html.addClass('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                $html.removeClass('dark');
                localStorage.setItem('theme', 'light');
            }
        } else {
            if ($html.hasClass('dark')) {
                $html.removeClass('dark');
                localStorage.setItem('theme', 'light');
            } else {
                $html.addClass('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    });
});
