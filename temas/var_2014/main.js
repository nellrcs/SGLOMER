// Offer Offset Animatons
$('#offer-one').waypoint(function(direction) {
  if (direction === 'down') {
    if ($(this).hasClass('inview')) {
    } else {
      $(this).addClass('inview');
    }
  } if (direction === 'up') {
    if ($(this).hasClass('inview')) {
      $(this).removeClass('inview');
    }
  }
}, { offset: '50%' });

$('#offer-two').waypoint(function(direction) {
  if (direction === 'down') {
    if ($(this).hasClass('inview')) {
    } else {
      $(this).addClass('inview');
    }
  } if (direction === 'up') {
    if ($(this).hasClass('inview')) {
      $(this).removeClass('inview');
    }
  }
}, { offset: '50%' });

$('#offer-three').waypoint(function(direction) {
  if (direction === 'down') {
    if ($(this).hasClass('inview')) {
    } else {
      $(this).addClass('inview');
    }
  } if (direction === 'up') {
    if ($(this).hasClass('inview')) {
      $(this).removeClass('inview');
    }
  }
}, { offset: '50%' });

// Parallax
$('#moto').waypoint(function(direction) {
  if (direction === 'down') {
    if ($(this).hasClass('doParallax')) {
    } else {
      // $(this).addClass('doParallax');
      $(window).scroll(function(){
        parallax();
      });
    }
  }
}, { offset: '100%' });

function parallax(){
  var scrolled = $(window).scrollTop();
  $('#moto').css('background-position','center ' + (scrolled*0.15) + 'px');
  $('#moto-hand').css('-webkit-transform','translate3d(0,-' + (scrolled*0.096) + 'px,0)');
}

// Presentation Background
function presentation(){
  var presBgContainer = $('.pres-bgs');

  function setpresBackground(bgNumber) {
    var prev = presBgContainer.find('.bg');

    setTimeout(function() {
      prev.remove();
    }, 4100);

    var el = document.createElement('div');
    el.className += 'bg bg' + bgNumber;

    presBgContainer.append(el);

    setTimeout(function() {
      el.className += ' show';
    }, 20);
  }

  function presBgRotating(interval) {
    var current = 1;

    setInterval(function() {
      setpresBackground((current % 3) + 1);
      current++;
    }, interval);
  }

  presBgRotating(4000);
}

// Menu Groups
function menuGroup(){
  $('html').click(function() {
    if ($(".menu-trigger").hasClass("active")){
      $(".menu-trigger").removeClass("active");
    }
    if ($(".menu-dropdown").hasClass("open")){
      $(".menu-dropdown").removeClass("open").addClass("closed");
    }
  });
  // Open menu
  $(".menu-trigger").click(function(event) {
    event.preventDefault();
    event.stopPropagation();
    $(this).toggleClass("active");
    if($(this).next('.menu-dropdown').hasClass("closed")){
      $(this).next(".menu-dropdown").removeClass("closed").addClass("open");
    }
    $("input[name*=radio-set").change(function(){
      var parent = $(this).parent(".radio-colors");
      var selected = $(" input[type=radio]:checked", parent);
      $(".radio-display", parent).attr("data-color", selected.attr("class"));
    });
  });
}

// Carrier
function radioSizes(){
  $('[data-set*="radio-carrier-set"]').click(function(){ // Just use a data-attribute
    var parent = $(this).closest(".set-parent");
    var selected = $(this);
    $(".radio-display", parent).attr("data-carrier", selected.attr("class"));
    $(".radio-display .carrier-label", parent).html(selected.attr("data-carrier-name"));
    $(".radio-display .carrier-img", parent).attr("src", selected.attr("data-carrier-img"));
    $(".radio-display .carrier-img").addClass("show");
    $(".radio-display .icon-mobile").addClass("hidden");
  });
}

// Locations (Flags)
function radioLoc(){
  $('[data-set*="radio-loc-set"]').click(function(){ // Just use a data-attribute
    var parent = $(this).closest(".set-parent");
    var selected = $(this);
    $(".radio-display", parent).attr("data-loc", selected.attr("class"));
    $(".radio-display .loc-label", parent).html(selected.attr("data-loc-name"));
    $(".radio-display .loc-img", parent).attr("src", selected.attr("data-loc-img"));
  });
}

// Topup Amount
function radioAmount(){
  $('[data-set*="radio-amount-set"]').click(function(){ // Just use a data-attribute
    var parent = $(this).closest(".set-parent");
    var selected = $(this);
    $(".radio-display", parent).attr("data-amount", selected.attr("class"));
    $(".radio-display .amount-label", parent).html(selected.attr("data-amount-name"));
  });
}

// Progress Shizzle
function progressShizzle() {
  $('#formloc-tel').keyup(function(){
    var len = this.value.match(/\d/g).length;
    if (len >= 4) {
      // Expand Part 1
      $(".progress").addClass("part2");
      $(".progress-points li:nth-child(2) .label").addClass("on"); 
      $(".msg1").removeClass("show");
      $(".msg2").addClass("show");
      $(".menu-group2 .menu-group-disabled").remove();
      $(".menu-group2").removeClass("tu-inactive");
      // Fire Up Part 2
      radioA();
      function radioA() {
        $('input:radio[name="radio-carrier"]').change(function(){
          $(".progress").addClass("part3"); 
          $(".progress-points li:nth-child(3) .label").addClass("on");  
          $(".msg2").removeClass("show");
          $(".msg3").addClass("show"); 
          $(".menu-group3 .menu-group-disabled").remove();
          $(".menu-group3").removeClass("tu-inactive");
          // Fire Up Part 3    
          radioB(); 
          function radioB() {
            $('input:radio[name="radio-amount"]').change(function(){
              $(".progress").addClass("part4"); 
              $(".progress-points li:nth-child(3) .label-last").addClass("on");  
              $(".msg3").removeClass("show");
              $(".msg4").addClass("show"); 
              $(".btn-wrap .menu-group-disabled").remove();
              $(".topup-button").removeClass("tu-inactive");
              $("#svg-container").removeClass("tu-inactive");        
            });
            // Fire Up Part 4
            submitForm();
            function submitForm() {
              // Do Something
              $('button').click(function(){
                // $("#progress-d .bar").addClass("build"); 
                // $("#progress-d .label-last").addClass("on");
                // $(".msg4").removeClass("show"); 
              });
            }
          }
        });
      }
    }
    else {
      // Remove Progression
    }     
  });
}


// SVG Stuff
jQuery(document).ready(function(){
      
  // ---------
  // SVG 
  var snapC = Snap("#svgC");

  // SVG C - "Squiggly" Path
  var myPathC = snapC.path("M0.187,212.029c0,0,171.558,14.581,210.322-86.775S330.927-7.397,439.467,18.564").attr({
    id: "squiggle",
    fill: "none",
    strokeWidth: "4",
    stroke: "#ffffff",
    strokeMiterLimit: "10",
    strokeDasharray: "12 6",
    strokeDashOffset: "180"
  });
  
  // SVG C - Triangle (As Polyline)
  var Triangle = snapC.polyline("0, 30, 15, 0, 30, 30");
  Triangle.attr({
    id: "plane",
    fill: "#fff"
  }); 
  
  initTriangle();
  
  // Initialize Triangle on Path
  function initTriangle(){
    var triangleGroup = snapC.g( Triangle ); // Group polyline 
    movePoint = myPathC.getPointAtLength(length);
    triangleGroup.transform( 't' + parseInt(movePoint.x - 15) + ',' + parseInt( movePoint.y - 15) + 'r' + (movePoint.alpha - 90));
  }
  
  // SVG C - Draw Path
  var lenC = myPathC.getTotalLength();

  // SVG C - Animate Path
  function animateSVG() {
    
    myPathC.attr({
      stroke: '#fff',
      strokeWidth: 4,
      fill: 'none',
      // Draw Path
      "stroke-dasharray": "12 6",
      "stroke-dashoffset": "180"
    }).animate({"stroke-dashoffset": 10}, 1500,mina.easein);
    
    var triangleGroup = snapC.g( Triangle ); // Group polyline

    setTimeout( function() {
      Snap.animate(0, lenC, function( value ) {
   
        movePoint = myPathC.getPointAtLength( value );
      
        triangleGroup.transform( 't' + parseInt(movePoint.x - 15) + ',' + parseInt( movePoint.y - 15) + 'r' + (movePoint.alpha - 90));
    
      }, 1500,mina.easein, function(){
        alertEnd();
      });
    });
    
  } 
  
  // Callback Function
  function alertEnd(){
    // Do Animation
    $('#mobile').addClass('powpow');  
    $("#notification").addClass("sayhi");
    $("#screen .dollar").addClass("bling");
    // Enable Button
    $('#topupnow').removeAttr('disabled');
  }
  
  // Animate Button
  function kapow(){
    $("#topupnow").click(function(event){
      
      // Disable Button
      $(this).attr('disabled','disabled');    
      // Animate Ball
      if ($('#mobile').hasClass('powpow')){
        $('#mobile').removeClass('powpow');
      }    
      if ($('#notification').hasClass('sayhi')){
        $('#notification').removeClass('sayhi');
      }
      if ($('#screen').hasClass('bling')){
        $('#screen').removeClass('bling');
      }
      // Run SVG
      animateSVG();
      
    });
  }

  kapow();

  // Call in those awesome Functions!
  presentation();
  menuGroup();
  radioSizes();
  radioLoc();
  radioAmount();
  progressShizzle();
});