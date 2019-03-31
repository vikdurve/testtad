(function ($) {

    $(document).ready(function () {

        //hide View More button on FAQ when there are <=4 question
        var faqItemCount = $('.faq-item').length;
        if (faqItemCount <= 4) {
            $('.lnkViewMore').hide();
        }

        //Reset form when pop-up is closed
        $("#become-mentor-modal,#callback-modal,#join-tad-modal,#get-in-touch-modal").on("hidden.bs.modal", function () {
            var form_id = $(this).find("form").attr("id");
            $('#' + form_id).trigger("reset");
            $(this).find("label.error").each(function (index) {
                $(this).css('display', 'none');
            });
            $(this).find(".form-control").each(function (index) {
                $(this).removeClass("error");
            });
        });

        $('.btnLogin').click(function () {
            $('.user-login-wrap').toggle();
            $('.user-login-form').show();
            $('.user-pass-reset-form').hide();
        });

        $('.frg-pass-link').click(function () {
            $('.user-login-form').hide();
            $('.user-pass-reset-form').show();
        });

        $('.login-link').click(function () {
            $('.user-login-form').show();
            $('.user-pass-reset-form').hide();
        });

        $('.btnProfile').click(function () {
            $('.user-profile-info-wrap').toggle();

        });

        //Login box hide on body click

        $('body').click(function (event) {
            $('.user-login-wrap, .user-login-form, .user-pass-reset-form, .pre-requisites-data').fadeOut();
        });

        $('.user-login-wrap, .user-login-form, .user-pass-reset-form, .btnLogin, .pre-requisites-data, .pre-req-trigger').click(function (event) {
            event.stopPropagation();
        });

        // Pre-requisites pop-up show hide               
        $('.pre-req-trigger').click(function () {
            $('.pre-requisites-data, .pre-requisites-wrap').fadeIn();
        });
        if ($( window ).width() < 768) {
            $('.pre-requisites-data').click(function () {
            $('.pre-requisites-data, .pre-requisites-wrap').fadeOut();
        });
        }

        //faq view more

        $('.lnkViewMore').click(function () {
            $('.faq-section2').toggleClass("show-all");
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                $(this).text("View Less");
            } else {
                $(this).text("View More");
            }
        });

        //popup text view more

        $('.tad-modal-big .view-more span').click(function () {
            $('.para-area').toggleClass("show-all");
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                $(this).text("View Less");
            } else {
                $(this).text("View More");
            }

        });

        //hide login screen on hamburger click

        $('.navbar-toggle').click(function () {
            $('.user-login-wrap').fadeOut();

        });


        //In collaboration counter stats

        function isScrolledIntoView(elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();

            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        $(window).scroll(function () {
            $('.counter span').each(function () {
                if (isScrolledIntoView(this) === true) {


                    $('.counter span').each(function () {
                        var $this = $(this),
                            countTo = $this.attr('data-count');

                        $({
                            countNum: $this.text()
                        }).animate({
                                countNum: countTo
                            },

                            {
                                duration: 1777,
                                easing: 'linear',
                                step: function () {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function () {
                                    $this.text(this.countNum);
                                    //alert('finished');
                                }
                            });
                    });
                } else {}
            });
        });


    });

}(jQuery));

(function ($) {
    Drupal.behaviors.tad_custom_mod = {
        attach: function (context, settings) {
            //Add active class to mentor filter  
            $("input[type=radio][name=field_category_tid]:checked").parent('.control-label').addClass("cat-active");
            
            //Set value of hidden course drop-down
            $(".getin-touch-link").click(function(){
                var nid = $(this).data('nid');
                $("#edit-submitted-course").val(nid);
            });
        }
    };
}(jQuery));
