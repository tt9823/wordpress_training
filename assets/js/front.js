jQuery(function($){
    // worksセクション
    $(window).scroll(function (){
        $('.kiji-list, .contact-content, .works-section1, .works-section2, .works-section3, .btn, .section-title').each(function(){
        let targetElement = $(this).offset().top;
        let scroll = $(window).scrollTop();
        let windowHeight = $(window).height();
            if (scroll > targetElement - windowHeight + 200){
                $(this).css('opacity','1');
                $(this).css('transform','translateY(0)');
            }
        });
    });

});
