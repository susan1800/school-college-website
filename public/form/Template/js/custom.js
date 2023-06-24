//register tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

//owl carousel for company slider
$('.owl-banner').owlCarousel({
    loop: true,
    nav: false,
    autoplay: true,
    margin: 30,
    animateOut: 'fadeOut',
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    dots: true,
    mouseDrag: true,
    items: 1
});


//show hide toggle item on click
$(".search-label-title").click(function () {
    $(this).parents('.search-content-col').find(".search-item-toggle").toggle();
    $(this).parents('.search-content-col').find('.search-title-icon').toggleClass('search-title-icon-closed');
});


//stepper for job post form
var stepToggleClass = $(".step-toggle");
var stepFormSingleClass = $(".step-from-single");

$(stepToggleClass).click(function (event) {
    event.preventDefault();
    $(this).addClass("step-nav-current");
    $(stepToggleClass).not(this).removeClass('step-nav-current');

    var toggleID = $(this).attr('data-toggle');
    $(".step-from-single").hide();
    $("#" + toggleID).show();

    $(".step-from-single").removeClass("done-step");
    $(".step-from-single").removeClass("undone-step");
});
$(".form-step-next").click(function () {
    $(this).parents(".step-from-single").addClass("done-step");
    $(this).parents(".step-from-single").removeClass("undone-step");
    $(this).parents(".step-from-single").hide();
    $(".step-form-wrapper").find('.done-step').next().show();
    $(".step-form-wrapper").find('.done-step').hide();
    var navStepSelector = $(this).parents(".step-from-single").attr('data-toggle');
    $('.step-toggle[data-toggle = ' + navStepSelector + ']').addClass('step-nav-visited');
    $(".step-nav-visited").parents('li').next("li").find('.step-toggle').addClass("step-nav-current step-identity");
    $(".step-nav-visited").removeClass("step-nav-current");
    $("html, body").animate({scrollTop: 20});
});
$(".form-step-prev").click(function () {
    $(".step-form-wrapper").find(".step-nav-current").parents('li').prev('li').find('.step-toggle').trigger('click');
    $("html, body").animate({scrollTop: 20});
});
$('.step-toggle').click(function (event) {
    event.preventDefault();
    $(".step-toggle").removeClass("step-nav-visited");
});


// Initialization of date picker
$('.datepicker-custom').datepicker({
    language: 'en',
    autoClose : true
});
$('.date-dob').datepicker({
    language: 'en',
    autoClose: true
});






//SELECT
//selectize form search and option only
$('.form-control-select').selectize({});


//selectize for user able to select multiple option
$('.select-multiple').selectize({
    plugins: ['remove_button'],
    maxItems: null,
    persist: false,

});




//to show file name on upload
$('input[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $(this).parent().find('.custom-file-label').html(fileName);
});
//nav notification
//$(".notification-nav").click(function () {

//    $(this).find(".u-nav-tray").toggle();
//    $(".notification-nav").not(this).find(".u-nav-tray").hide();
//});
//$(document).mouseup(function (e) {
//    var container = $(".notification-nav");
//    if (!container.is(e.target) && container.has(e.target).length === 0) {
//        container.parent().find(".u-nav-tray").hide();
//    }
//});


$(window).on('load', function () {
    $(".loader-body").fadeOut("slow");

});

//dynamic give radio button different name
var counter = 0;
$(document).on('click', '.btn-id-gen', function () {
    counter++;
    var appendFromHtmlDual = $('.content-append-from-top');
    var appendToHtmlDual = $(this).parents('.append-dual-row').find('.content-append-to');
    var recentlyAppended1 = appendToHtmlDual.find(".projectComptoggle").removeAttr("name");
    var recentlyAppended2 = appendToHtmlDual.find(".projectComptoggle").attr("name", "level2-" + counter);
    var appendComp = $(appendToHtmlDual).append(appendFromHtmlDual.html());
    var appendDiv = $(appendToHtmlDual).find('.language-add-box').addClass("append-success");
});

//Inbox Materialize Design

$(".form-control").parent().addClass("label-animate");
$(document).ready(function () {
    $("#DOB").val("");

    $(".form-control").click(function() {
        $(this).parent().addClass("label-animate");
    });
    $(".form-control").focus(function () {
        $(this).parent().addClass("label-animate");
    });
    $(".previewDocument").click(function () {
        $(".form-control").parent().addClass("label-animate");
    });
    $(".finalFormSubmition").click(function () {
        $(".form-control").parent().addClass("label-animate");
        $(".custom-alert").show();
    });
    $(".form-control").parent().addClass("label-animate");
    //$(window).click(function() {
    //    if (!$(event.target).is('.form-control')) {
    //        $(".form-control").each(function() {
    //            if ($(this).val() == '') {
    //                $(this).parent().removeClass("label-animate");
    //            }
    //        });
    //    }
    //});
});
