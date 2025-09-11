// import './bootstrap';

import $ from 'jquery';
 var baseUrl = "/PsychAI";

 $.ajaxSetup({
    beforeSend: function (jqXHR, settings) {
        // إذا الرابط مش مطلق (ما ببلش بـ http) ضيف البادئة
        if (settings.url.indexOf("http") !== 0) {
            settings.url = baseUrl + settings.url;
        }
    }
});

import "./auth/login"
import "./auth/register"
import "./auth/forgot_password"
import "./auth/reset_password"
import "./admin/users"
import "./app/chat"
import "./admin/users"
import "./app/video"
// import "./app/article";
import "./app/review";

