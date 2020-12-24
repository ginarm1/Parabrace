
$(document).ready(function(){

    var card = $(".card");

    var cardEven = $(".card:even");
    var cardEvenImg = $(".card:even img");
    var cardEvenP = $(".card:even p");
    var cardEvenBtn = $(".card:even a");

    var cardOdd= $(".card:odd");
    var cardOddImg= $(".card:odd img");
    var cardOddP = $(".card:odd p");
    var cardOddBtn = $(".card:odd a");

    cardOddBtn.hide();
    cardEvenBtn.hide();

    card.animate({
        transition: '0.7s',
        opacity: 1
    });


    cardEven.mouseenter(function(){
        cardEvenImg.fadeOut( function(){
            cardEvenP.show();
            cardEvenBtn.show();
            cardEven.css({"background-color":"#4c4848", "color":"white", "transition": "0.4s"});
        });
    });
    cardEven.mouseleave(function(){
        cardEvenImg.css({"display":"block"});
        cardEvenP.css({"display":"none"});
        cardEvenBtn.hide();
        cardEven.css({"background-color":"white", "color":"black", "transition":"0.4s"});
    });
    cardOdd.mouseenter(function(){

        cardOddImg.fadeOut( function(){
            cardOddP.show();
            cardOddBtn.show();
            cardOdd.css({"background-color":"#359E81", "color":"white", "transition": "0.4s"});

        });
    });
    cardOdd.mouseleave(function(){
        cardOddImg.css({"display":"block"});
        cardOddP.css({"display":"none"});
        cardOddBtn.hide();
        cardOdd.css({"background-color":"white", "color":"black", "transition":"0.4s"});
    });

});

