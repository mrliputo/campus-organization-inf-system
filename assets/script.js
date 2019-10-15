/**
 * Description of script.js
 *
 * @author Norman Syarif
 */

 $(".menu-list ul span").click(function() {
  $(this).find("ul").slideToggle(300);
});

 $(".bold").click(function(){
  $box = $(this).parent().find("#setengah");
  minimumHeight = 58;

    // get current height
    currentHeight = $box.height();

    // get height with auto applied
    autoHeight = $box.css('height', 'auto').height();

    // reset height and revert to original if current and auto are equal
    $box.css('height', currentHeight).animate({
      height: (currentHeight === autoHeight ? minimumHeight : autoHeight)
    });
    
  });

 $(".profil-bio").hover(function(){
  $(this).find(".float-text").stop().animate({
    top: 81
  },200);
},
function(){
  $(this).find(".float-text").stop().animate({
    top: 103
  },200);
});

 $(".profil-bio").hover(function(){
  $(this).find(".float-text-org").stop().animate({
    top: 40
  },200);
},
function(){
  $(this).find(".float-text-org").stop().animate({
    top: 81
  },200);
});

 $("#notif").click(function() {
  $(".notif-box").slideToggle(150);
});

