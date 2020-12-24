
$(document).ready(function(){
    // Main page articles animation

    var card1 = $(".card:nth-child(1)");
    var card1img = $(".card:nth-child(1) img");
    var card1p = $(".card:nth-child(1) p");
    var card1btn = $(".card:nth-child(1) a");

    var card2 = $(".card:nth-child(2)");
    var card2img = $(".card:nth-child(2) img");
    var card2p = $(".card:nth-child(2) p");
    var card2btn = $(".card:nth-child(2) a");

    var card3 = $(".card:nth-child(3)");
    var card3img = $(".card:nth-child(3) img");
    var card3p = $(".card:nth-child(3) p");
    var card3btn = $(".card:nth-child(3) a");

    $('.content').scrollTop(function(){
        card3.animate({
            left: '3%',
            transition: '2s',
            opacity: '1'
        });
        card2.animate({
            left: '3%',
            transition: '2.5s',
            opacity: '1'
        });
        card1.animate({
            left: '3%',
            transition: '3s',
            opacity: '1'
        });
        card1btn.hide();
        card2btn.hide();
        card3btn.hide();
    });

    //Individual cards
    card1.mouseenter(function(){
        if (card1img.length > 0) {
            card1img.fadeOut(function () {
                card1p.show();
                card1btn.show();
                card1.css({"background-color": "#9E4B35", "color": "white", "transition": "0.4s"});

            });
        }else{
            card1p.show();
            card1btn.show();
            card1.css({"background-color": "#9E4B35", "color": "white", "transition": "0.4s"});
        }
    });
    card1.mouseleave(function(){
        card1img.css({"display":"block"});
        card1p.css({"display":"none"});
        card1btn.hide();
        card1.css({"background-color":"white", "color":"black", "transition":"0.4s"});
    });

    card2.mouseenter(function(){
        if (card2img.length > 0) {
            card2img.fadeOut(function(){
                card2p.show();
                card2btn.show();
                card2.css({"background-color":"#359E81", "color":"white", "transition": "0.4s"});
            });
        }else{
            card2p.show();
            card2btn.show();
            card2.css({"background-color":"#359E81", "color":"white", "transition": "0.4s"});
        }

    });
    card2.mouseleave(function(){
        card2img.css({"display":"block"});
        card2p.css({"display":"none"});
        card2btn.hide();
        card2.css({"background-color":"white", "color":"black", "transition":"0.4s"});
    });


    card3.mouseenter(function(){
        if (card3img.length > 0) {
            card3img.fadeOut(function () {
                card3p.show();
                card3btn.show();
                card3.css({"background-color": "#35889E", "color": "white", "transition": "0.4s"});
            });
        }else{
            card3p.show();
            card3btn.show();
            card3.css({"background-color":"#35889E", "color":"white", "transition": "0.4s"});
        }
    });
    card3.mouseleave(function(){
        card3img.css({"display":"block"});
        card3p.css({"display":"none"});
        card3btn.hide();
        card3.css({"background-color":"white", "color":"black", "transition":"0.4s"});
    });

//    ---------------------------------------

});

