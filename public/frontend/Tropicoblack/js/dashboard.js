var animationHeaderCount = 1;
var animationFooterCount = 1;
var animationGameItemCount = 1;
setInterval(function () { HeaderMenuAnimation() }, 50);
setInterval(function () { FooterMenuAnimation() }, 50);
setInterval(function () { GameItemMenuAnimation() }, 50);

function HeaderMenuAnimation() {
    animationHeaderCount++;
    var bg_left_postion_x = $('.main-menu-left').css('background-position-x');
    var bg_left_postion_y = $('.main-menu-left').css('background-position-y');
    var bg_right_postion_x = $('.main-menu-left').css('background-position-x');
    var bg_right_postion_y = $('.main-menu-left').css('background-position-y');
    if (bg_left_postion_x == "0px") {
        $('.main-menu-left').css('background-position-x', '-963px');
    } else {
        $('.main-menu-left').css('background-position-x', 0);
        $('.main-menu-left').css('background-position-y', Number(bg_left_postion_y.slice(0, -2)) - 144 + "px");
    }

    if (bg_right_postion_x == "0px") {
        $('.main-menu-right').css('background-position-x', '-963px');
    } else {
        $('.main-menu-right').css('background-position-x', 0);
        $('.main-menu-right').css('background-position-y', Number(bg_right_postion_y.slice(0, -2)) - 144 + "px");
    }



    if (animationHeaderCount == 39) {
        animationHeaderCount = 0;
        $('.main-menu-left').css('background-position-x', 0);
        $('.main-menu-left').css('background-position-y', 0);
        $('.main-menu-right').css('background-position-x', 0);
        $('.main-menu-right').css('background-position-y', 0);
    }
}

function FooterMenuAnimation() {
    var bg_postion_x = $('.footer-menu-user').css('background-position-x');
    var bg_postion_y = $('.footer-menu-user').css('background-position-y');
    $('.footer-menu-user').css('background-position-x', Number(bg_postion_x.slice(0, -2)) - 447 + "px");
    if (animationFooterCount % 4 == 0) {
        $('.footer-menu-user').css('background-position-y', Number(bg_postion_y.slice(0, -2)) - 145 + "px");
        $('.footer-menu-user').css('background-position-x', 0);
    }
    if (animationFooterCount == 36) {
        $('.footer-menu-user').css('background-position-x', 0);
        $('.footer-menu-user').css('background-position-y', 0);
        animationFooterCount = 0;
    }
    animationFooterCount++;
}

function GameItemMenuAnimation() {
    var bg_postion_x = $('.slot-game-item').css('background-position-x', 0);
    var bg_postion_y = $('.slot-game-item').css('background-position-y', 0);
    $('.slot-game-item').css('background-position-x', Number(bg_postion_x.slice(0, -2)) - 243 + "px");
    // $('.slot-game-item').css('background-position-y', Number(bg_postion_y.slice(0, -2)) - 370 + "px");
    // if ((animationGameItemCount % 5 == 0 || animationGameItemCount == 24) && animationGameItemCount != 25) {
    if (animationGameItemCount % 8 == 0) {
        $('.slot-game-item').css('background-position-y', Number(bg_postion_y.slice(0, -2)) - 287 + "px");
        // $('.slot-game-item').css('background-position-x', Number(bg_postion_x.slice(0, -2)) - 313 + "px");
        $('.slot-game-item').css('background-position-x', 0);
    }
    if (animationGameItemCount == 27) {
        $('.slot-game-item').css('background-position-x', 0);
        $('.slot-game-item').css('background-position-y', 0);
        animationGameItemCount = 0;
    }
    animationGameItemCount++;
}

$(".left_arrow").click(function () {
    $('.owl-prev').click();
})

$(".right_arrow").click(function () {
    $('.owl-next').click();
})
// ** Game Kind

$(".footer-menu-game-kind img").click(function (e) {
    if ($(e.currentTarget).hasClass("all_btn")) {
        window.location.pathname = "/categories/all";
        $('.fish_btn').removeClass('active');
        $('.fish_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g2btn1.png");
        $('.slot_btn').removeClass('active');
        $('.slot_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g3btn1.png");
        $('.fire_btn').removeClass('active');
        $('.fire_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g4btn1.png");
    } else if ($(e.currentTarget).hasClass("fish_btn")) {
        window.location.pathname = "/categories/new";
        $('.all_btn').removeClass('active');
        $('.all_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g1btn1.png");
        $('.slot_btn').removeClass('active');
        $('.slot_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g3btn1.png");
        $('.fire_btn').removeClass('active');
        $('.fire_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g4btn1.png");
    } else if ($(e.currentTarget).hasClass("slot_btn")) {
        window.location.pathname = "/categories/slot";
        $('.all_btn').removeClass('active');
        $('.all_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g1btn1.png");
        $('.fish_btn').removeClass('active');
        $('.fish_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g2btn1.png");
        $('.fire_btn').removeClass('active');
        $('.fire_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g4btn1.png");
    } else if ($(e.currentTarget).hasClass("fire_btn")) {
        window.location.pathname = "/categories/hot";
        $('.all_btn').removeClass('active');
        $('.all_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g1btn1.png");
        $('.fish_btn').removeClass('active');
        $('.fish_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g2btn1.png");
        $('.slot_btn').removeClass('active');
        $('.slot_btn').attr("src", "/frontend/Tropicoblack/img/dashboard/kind/g3btn1.png");
    }

    if (!$(e.currentTarget).hasClass("active")) {
        $(e.currentTarget).addClass("active");
        const changedSRC = $(e.currentTarget).attr("src").split("").reverse().join("").replace("1", "2").split("").reverse().join("");
        $(e.currentTarget).attr("src", changedSRC);
        // const changedSRC = $(e.currentTarget).attr("src").split("").reverse().join("").replace("2", "1").split("").reverse().join("");
        // $(e.currentTarget).attr("src", changedSRC);
        // $(e.currentTarget).removeClass("active");
    }

})

$('.main-menu-exit').click(function () {
    location.pathname = "/logout";
});

$('.main-menu-sound').click(function () {
    var bgURL = $(".main-menu-sound").css("background-image");
    if (bgURL.includes("2")) {
        $(".main-menu-sound").css("background-image", "url(/frontend/Tropicoblack/img/dashboard/header/sound.png)");
    } else {
        $(".main-menu-sound").css("background-image", "url(/frontend/Tropicoblack/img/dashboard/header/sound2.png)");
    }
})

$('.footer-menu-user').click(function () {
    $("#modal-content").css("display", "");
    $(".userinfo_modal").css("display", "");
    $("#content").css("background", "#000C20");
    $("#content").css("opacity", "0.04");
})

$(".userinfo_modal_change_password").click(function () {
    $(".userinfo_modal").css("display", "none");
    $(".change_password_modal").css("display", "");
})

$(".change_password_modal_close").click(function () {
    $("#modal-content").css("display", "none");
    $(".change_password_modal").css("display", "none");
    $('#content').css("background", "none");
    $("#content").css("opacity", 1);
})

$(".userinfo_modal_close").click(function () {
    $("#modal-content").css("display", "none");
    $(".userinfo_modal").css("display", "none");
    $('#content').css("background", "none");
    $("#content").css("opacity", 1);
})

// ** Password Change
$('.change_password_modal_change_btn').click(function () {
    const pass = $('.change_password_modal_password').val();
    const pass_confirm = $('.change_password_modal_password_confirm').val();
    if (pass == "" || pass_confirm == "") {
        $(".change_password_modal_password_error").fadeIn(2000, 0);
        $(".change_password_modal_password_error_text").html("Input password must be 5-10 chars");
        setTimeout(function () {
            $(".change_password_modal_password_error").fadeOut(2000, 0);
        }, 2000)
    } else if (pass != pass_confirm) {
        $(".change_password_modal_password_error").fadeIn(2000, 0);
        $(".change_password_modal_password_error_text").html("Password & repeat password must match");
        setTimeout(function () {
            $(".change_password_modal_password_error").fadeOut(2000, 0);
        }, 2000)
    }
})

$(document).ready(function () {
    fixScale();
    // Orintation
    if ((window.screen.height - window.screen.width) > 50) {
        $('.orientation').css('display', "block");
    } else {
        $('.orientation').css('display', "none");
    }

    // mainContent postion
    $(".main-container").css("transform", 'translate(0,' + window.innerHeight * 30 / 1090 + '%)');


    $("#content").css("display", "none");

    setTimeout(function () {
        $('.preloader-game').fadeTo(2000, 0);
    }, 2000);
    setTimeout(function () {
        $("#content").fadeIn(1000, 0);
        // Set Responsive Size
        $("#content").css("height", window.innerHeight);
        $(".sticky-top").css("height", window.innerHeight);
    }, 4000);
})

// ** Public Function

$(window).resize(function (data) {
    fixScale();
    // Set Responsive Size
    $("#content").css("height", window.innerHeight);
    $(".sticky-top").css("height", window.innerHeight);

    // Orintation
    if ((window.screen.height - window.screen.width) > 100) {
        $('.orientation').css('display', "block");
    } else {
        $('.orientation').css('display', "none");
    }

    // mainContent postion
    $(".main-container").css("transform", 'translate(0,' + window.innerHeight * 30 / 1090 + '%)');
})


function fixScale() {
    var cont = document.getElementsByClassName('sticky-top main-bg');
    var cont_scale_x = window.innerWidth / 1926;
    var cont_scale_y = window.innerHeight / 969;
    if (cont) {
        cont[0].style.transform = "scaleX(" + cont_scale_x + ")";
        // cont[0].style.transform = "scale(" + cont_scale_x + "," + cont_scale_y + ")";
    }

    const cont_main = document.getElementById('mainContent');
    const cont_main_y = window.innerHeight / 956;
    if (cont_main) {
        cont_main.style.transform = "scaleY(" + cont_main_y + ")";
    }

    // Main menu
    const cont_menu = document.getElementById('main-menu');
    const cont_menu_y = window.innerHeight / 969;
    if (cont_menu) {
        cont_menu.style.transform = "scaleY(" + cont_menu_y + ")";
    }

    // footer
    const cont_footer = document.getElementsByClassName('footer-menu');
    const cont_footer_y = window.innerHeight / 969;
    if (cont_footer) {
        cont_footer[0].style.transform = "scaleY(" + cont_footer_y + ")";
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
