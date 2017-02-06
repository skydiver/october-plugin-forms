var captchas = [];

var onloadCallback = function() {
    jQuery('.g-recaptcha').each(function(index, el) {
        captchas[el.id] = grecaptcha.render(el, $(el).data());
    });
}

function resetReCaptcha(id) {
    var widget = captchas[id];
    grecaptcha.reset(widget);
}