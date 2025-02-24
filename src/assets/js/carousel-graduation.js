var owl = $('.owl-carousel');

owl.owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay:true,
    autoplayTimeout:1000,
    stagePadding:30,
    responsive:{
        0:{
            items:1,
            stagePadding:0,
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1440: {
            items:4
        }
    }
});


owl.owlCarousel();
$('.customNextBtn').click(function() {
    owl.trigger('next.owl.carousel');
})
$('.customPrevBtn').click(function() {
    owl.trigger('prev.owl.carousel', [300]);
})
