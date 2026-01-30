/*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
// ============================================================== 
// Auto select left navbar
// ============================================================== 
$(function () {
    "use strict";

    var current = window.location.pathname;

    // CLIENTES
    if (current.startsWith('/panel/clientes')) {
        $('#sidebarnav a[href="/panel/clientes/ver-clientes"]')
            .addClass('active')
            .parents('li')
            .addClass('active selected');
    } else {
        $('ul#sidebarnav a').each(function () {
            var href = $(this).attr('href');

            if (current.startsWith(href)) {
                $(this).addClass('active');
                $(this).parents('li').addClass('active selected');
            }
        });
    }

    $('#sidebarnav a').on('click', function (e) {
        if (!$(this).hasClass("active")) {
            $("ul", $(this).parents("ul:first")).removeClass("in");
            $("a", $(this).parents("ul:first")).removeClass("active");

            $(this).next("ul").addClass("in");
            $(this).addClass("active");
        } else {
            $(this).removeClass("active");
            $(this).parents("ul:first").removeClass("active");
            $(this).next("ul").removeClass("in");
        }
    });

    $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
        e.preventDefault();
    });
});
