//Initialiseringsscript slick.js carrousel, voor documentatie van de configuratieopties zie http://kenwheeler.github.io/slick/ 
// In deze demo voor het gemak dezelfde settings voor de 3 carrousels, maar je kunt uiteraard variëren
function InitCarrousel(){
        $('#contentCarrousel, #contentCarrouselSmall, #contentCarrouselFullScreen').slick({
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay:true,
            autoplaySpeed: 3000,
            variableWidth: true,
            responsive: [
                {breakpoint: 1024,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 1
                    }
                },
                {breakpoint: 800,
                  settings: {
                    slidesToShow: 5,
                    slidesToScroll: 2
                  }
                },
                {breakpoint: 600,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                  }
                }]
        });
}