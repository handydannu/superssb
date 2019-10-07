$(document).ready(function(){

  //Navbar Click and Hover
  if( $(window).width() > 1000){
    $('.dropdown-submenu.firstlevel a.test').hover(function(e){
      $(this).next('ul').show();
    }, function(e){
      $(this).next('ul').hide();
    });

    $('.dropdown-menu.secondlevel').hover(function(e){
      $(this).show();
    }, function(e){
      $(this).hide();
    });

    $('.dropdown-submenu.secondlevel a.test').hover(function(e){
      $(this).next('ul').show();
    }, function(e){
      $(this).next('ul').hide();
    });

    $('.dropdown-menu.thirdlevel').hover(function(e){
      $(this).show();
    }, function(e){
      $(this).hide();
    });
  }else if( $(window).width() <= 1000){
    $('.dropdown-submenu.firstlevel a.test').click(function(e){
      $(this).next('ul').toggle();
    });

    /*$('.dropdown-menu.secondlevel').click(function(e){
      $(this).toggle();
    });

    $('.dropdown-submenu.secondlevel a.test').click(function(e){
      $(this).next('ul').toggle();
    });

    $('.dropdown-menu.thirdlevel').click(function(e){
      $(this).toggle();
    });*/
  };

  //Navbar Informasi
  if( $(window).width() < 1900){
    $('a#informasi-nav').attr("href", "javascript:void(0)");
  }

  //Ticker
  $('#webTicker').webTicker();

  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $( ".highlight-read-more" ).mouseenter(function() {
    $(".arrow").css({'transform' : 'translateX(60px)'});
    $(".text").css({'transform' : 'translateX(30px)'});
  });

  $( ".highlight-read-more" ).mouseleave(function() {
    $(".arrow").css({'transform' : 'translateX(0px)'});
    $(".text").css({'transform' : 'translateX(0px)'});
  });

  var lebar = $(window).width();


  /* Anim search for desktop only */
  if($(window).width() >= 991){
    $('a.search-btn').click(function(event) {

      $('#search').css({
        'width' : $(window).width() +'px'
      });

      /*$('#search').css({
        'transform' : 'translateX(-' + ($(window).width()-100) +'px)'
      });*/

      if($('#search').hasClass("search-muncul")){

        $('.search').removeClass('search-muncul');
        $('.search-input').css({
          'opacity' : '0'
        });
/*        $('#search').css({
        'transform' : 'translateX(-15px)'
        });*/

        $('#search').css({
          'width' : '105px'
        });

      }else{

        if( $(window).width() < 1500){

          $('.search').addClass('search-muncul');
          $('.search-input').css({
            'width' : '83.33%'
          });

        }else{

          $('.search').addClass('search-muncul');
          $('.search-input').css({
            'width' : '83.33%'
          });

        }
        $('.search-input').css({
          'opacity' : '1'
        });

        $('.search-input input').focus();

      };

      event.stopPropagation();

    });
  }

  $('.search-input input').blur(function() {

    $('.search').removeClass('search-muncul');
    $('.search-input').css({
      'width' : '100%'
    });
    $('.search-input').css({
      'opacity' : '0'
    });
/*    $('#search').css({
    'transform' : 'translateX(-25px)'
    });*/
    $('#search').css({
      'width' : '105px'
    });

  });

  console.log($(window).width());

  if ( $(window).width() > 1000 ) {

    $('.simulasi-kredit').height( $('.highlight-galeri').height() );

  };

  //if($('.navbar-toggle').attr('aria-expanded') == 'true'){
    //alert($('.navbar-toggle').hasClass('collapsed'));
  //}else{
    //$('.navbar-toggle').click(function(){
      //$('.search').hide();
    //});
  //}


});

$(window).scroll(function(){

  var wScroll = $(this).scrollTop(); //ngebaca brapa kali nyekrol

  if(wScroll > 200){

    $('.up-btn').addClass('up-btn-muncul');

  };

  if(wScroll < 200){

    $('.up-btn').removeClass('up-btn-muncul');

  };

});

$('#search-btn').click(function() {
  $('.search-desktop').toggle();
  $('.search-desktop input').focus();
});

$('.search-desktop input').blur(function() {
  setTimeout(function(){
    $('.search-desktop').css({
      'display' : 'none'
    });
  },200);
});

$('table').not('.kredit-detail').addClass('table');
$('table').not('.kredit-detail').addClass('table-bordered');

$('.side-nav-single.dropdown a').click(function() {
  $(this).next('ul').toggle();
  $('.about-side-nav .anakan').not($(this).next('ul')).hide();
});

if( $('li').hasClass('active') ){
  $(this).next('ul').toggle();
};
