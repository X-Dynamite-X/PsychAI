// import './bootstrap';

import $ from 'jquery';
import "./auth/login"
import "./auth/register"
import "./auth/forgot_password"
import "./auth/reset_password"
import "./admin/users"
import "./app/chat"

// اختبار بسيط للتأكد من أن jQuery يعمل

document.querySelector('.mobile-menu-button').addEventListener('click', function() {
    document.querySelector('.mobile-menu').classList.toggle('active');
});

