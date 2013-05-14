jQuery(document).ready(function($){

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $('.rollover').rollover();
  $("a.target_blank").attr("target","_blank");

  $(".header-menu ul li:has(ul)").addClass("parent-menu");
  $(".header-menu ul li").hover(function(){
   $(">ul:not(:animated)",this).slideDown("fast");
   $(this).addClass("active-menu");
   },
   function(){
   $(">ul",this).slideUp("fast");
   $(this).removeClass("active-menu");
  });

  $(".header-menu > ul > li:first-child").addClass("first");
  $(".header-menu > ul > li:last-child").addClass("last");

  $("#comment-area ol > li:even").addClass("even-comment");
  $("#comment-area ol > li:odd").addClass("odd-comment");
  $(".even-comment > .children > li").addClass("even-comment-children");
  $(".odd-comment > .children > li").addClass("odd-comment-children");
  $(".even-comment-children > .children > li").addClass("odd-comment-children");
  $(".odd-comment-children > .children > li").addClass("even-comment-children");
  $(".even-comment-children > .children > li").addClass("odd-comment-children");
  $(".odd-comment-children > .children > li").addClass("even-comment-children");

  $("#trackback-switch").click(function(){
    $("#comment-switch").removeClass("comment-switch-active");
    $(this).addClass("comment-switch-active");
    $("#comment-area").animate({opacity: 'hide'}, 0);
    $("#trackback-area").animate({opacity: 'show'}, 1000);
    return false;
  });

  $("#comment-switch").click(function(){
    $("#trackback-switch").removeClass("comment-switch-active");
    $(this).addClass("comment-switch-active");
    $("#trackback-area").animate({opacity: 'hide'}, 0);
    $("#comment-area").animate({opacity: 'show'}, 1000);
    return false;
  });

});