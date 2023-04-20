$(document).ready(function () {
    fixScale();

    $('#login-container').css("display", "none");
    setTimeout(function () {
        $('.preloader-game').fadeTo(2000, 0);
    }, 2000);
    setTimeout(function () {
        $('#login-container').fadeIn(1000);
        $('.preloader-game').css('display', 'none');
    }, 4000)
})

$('.game-button').click(function () {
    const username = $("#login-form-username").val();
    const password = $("#login-form-password").val();
    if (!username || !password)
        return false;
    $('#login-form').submit();
})


$('.login__check').click(function () {
    const opacity = $('.login__check').css("opacity");
    if (Number(opacity)) {
        $('.login__check').css("opacity", 0);
    } else {
        $('.login__check').css("opacity", 1)
    }
})


$(window).resize(function (data) {
    fixScale();
})


function fixScale() {
    var cont = document.getElementById("login-form");
    var cont_scale = Math.min(window.screen.height / 2 / 432, window.screen.width / 2 / 1046);
    if (cont) {
        console.log(cont.style.transform);
        cont.style.transform = "scale(" + cont_scale + ")";
    }
}

$('body').click(function () {
    toggleFullscreen();
})

function toggleFullscreen(elem) {
    elem = elem || document.documentElement;
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
}
