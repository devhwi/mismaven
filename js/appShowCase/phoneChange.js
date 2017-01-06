$(document).ready(function() {
    var currentImg = $(".ac-device img");
    var list;
    var imgCheckNum = 1;
    var dWidth = $(window).width();

    function checkImg() {
        imgCheckNum++;

        if (imgCheckNum === 5) {
            imgCheckNum = 1;
        }

        list = "imgs/screen" + imgCheckNum + ".jpg";

        currentImg.removeAttr("src").hide().attr("src", list).fadeIn(1000);
    }

    autoPlay = setInterval(function() {
        checkImg();
   }, 5000);
   
    if (dWidth < 600) {
        $(".box svg").hide();
        $(".ac-device").css({
            "background" : "url(imgs/m_iPhone.png)",
            "background-repeat" : "no-repeat"
        });
        $('.info p').hide();
        $(".info header").css({
            'background-size' : "cover",
            'height' : "100%"
        })
    } else {
        $(".ac-device").css({
            "background" : "url(imgs/iPhone.png)",
            "background-repeat" : "no-repeat"
        });
    }

})
