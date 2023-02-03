
 var sheet = document.createElement('style'),  
  $rangeInput = $('.range input'),
  prefs = ['webkit-slider-runnable-track', 'moz-range-track', 'ms-track'];

document.body.appendChild(sheet);

var getTrackStyle = function (el) {  
  var curVal = el.value,
      val = (curVal) * 16.666666667,
      style = '';
  
  // Set active label
  $('.range-labels li').removeClass('active selected');
  
  var curLabel = $('.range-labels').find('li:nth-child(' + curVal + ')');
  
  //curLabel.addClass('active selected');
  //curLabel.prevAll().addClass('selected');
  
  // Change background gradient
  for (var i = 0; i < prefs.length; i++) {
    style += '.range {background: linear-gradient(to right, #37adbf 0%, #37adbf ' + val + '%, #fff ' + val + '%, #fff 100%)}';
    style += '.range input::-' + prefs[i] + '{background: linear-gradient(to right, #37adbf 0%, #37adbf ' + val + '%, #b2b2b2 ' + val + '%, #b2b2b2 100%)}';
  }

  return style;
}

$rangeInput.on('input change', function () {
  sheet.textContent = getTrackStyle(this);
});

  $('.range-labels li').removeClass('active selected');

// Change input value on label click
$('.range-labels li').on('click', function () {
  var index = $(this).index();
  
  $rangeInput.val(index).trigger('input');
  
});





function computeScore(points, results) {
  var score=0;

  results.forEach(
      function (answer, index) { 
        score+=points[index][answer];
      }
  );
  return score;
}


var results = [0,0,0,0,0,0,0,0,0,0];
var points = [
  [0,1,2,3,4,5,6],
  [0,1,2,3,4,5,6],
  [0,0.25,0.5,0.75,1,1.25,1.5],
  [0,0.8,1.6,2.4,3.2,4,4.8],
  [0,0.8,1.6,2.4,3.2,4,4.8],
  [0,1,2,3,4,5,6],
  [0,0.6,1.2,1.8,2.4,3,3.6],
  [0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0]
];


  $("#start").click(
    function() {
      $(".intro").addClass("hide");
      $(".intro").removeClass("show");
      $(".q1").addClass("show");
      $(".q1").removeClass("hide");
      $(".HomeClaimBlock").addClass("hide");
    }
  );

  $(".q1 #next").click(
    function() {
      $(".q1").addClass("hide");
      $(".q1").removeClass("show");
      $(".q2").addClass("show");
      $(".q2").removeClass("hide");
      results[0]=$rangeInput.val();
      $rangeInput.val(results[1]).trigger('input');
    }
  );

  $(".q2 #next").click(
    function() {
      $(".q2").addClass("hide");
      $(".q2").removeClass("show");
      $(".q3").addClass("show");
      $(".q3").removeClass("hide");
      results[1]=$rangeInput.val();
      $rangeInput.val(results[2]).trigger('input');
    }
  );

  $(".q3 #next").click(
    function() {
      $(".q3").addClass("hide");
      $(".q3").removeClass("show");
      $(".q4").addClass("show");
      $(".q4").removeClass("hide");
      results[2]=$rangeInput.val();
      $rangeInput.val(results[3]).trigger('input');
    }
  );

  $(".q4 #next").click(
    function() {
      $(".q4").addClass("hide");
      $(".q4").removeClass("show");
      $(".q5").addClass("show");
      $(".q5").removeClass("hide");
      results[3]=$rangeInput.val();
      $rangeInput.val(results[4]).trigger('input');
    }
  );

    $(".q5 #next").click(
    function() {
      $(".q5").addClass("hide");
      $(".q5").removeClass("show");
      $(".q6").addClass("show");
      $(".q6").removeClass("hide");
      results[4]=$rangeInput.val();
      $rangeInput.val(results[5]).trigger('input');
    }
  );


  $(".q6 #next").click(
    function() {
      $(".q6").addClass("hide");
      $(".q6").removeClass("show");
      $(".q7").addClass("show");
      $(".q7").removeClass("hide");
      results[5]=$rangeInput.val();
      $rangeInput.val(results[6]).trigger('input');
    }
  );

  $(".q7 #next").click(
    function() {
      $(".q7").addClass("hide");
      $(".q7").removeClass("show");
      $(".q8").addClass("show");
      $(".q8").removeClass("hide");
      results[6]=$rangeInput.val();
      $rangeInput.val(results[7]).trigger('input');
    }
  );

  $(".q8 #next").click(
    function() {
      $(".q8").addClass("hide");
      $(".q8").removeClass("show");
      $(".q9").addClass("show");
      $(".q9").removeClass("hide");
      results[7]=$rangeInput.val();
      $rangeInput.val(results[8]).trigger('input');
    }
  );

  $(".q9 #next").click(
    function() {
      $(".q9").addClass("hide");
      $(".q9").removeClass("show");
      $(".q10").addClass("show");
      $(".q10").removeClass("hide");
      results[8]=$rangeInput.val();
      $rangeInput.val(results[9]).trigger('input');
    }
  );

    $(".q10 #next").click(
    function() {
      $(".q10").addClass("hide");
      $(".q10").removeClass("show");
      results[9]=$rangeInput.val();
      var finalScore = computeScore(points, results)
      if(finalScore>9.5){
        $(".resultOK").addClass("show");
        $(".resultOK").removeClass("hide");
      }
      else{
        $(".resultKO").addClass("show");
        $(".resultKO").removeClass("hide");
      }
    }
  );




  $(".q2 #previous").click(
    function() {
      $(".q1").addClass("show");
      $(".q1").removeClass("hide");
      $(".q2").addClass("hide");
      $(".q2").removeClass("show");
      results[1]=$rangeInput.val();
      $rangeInput.val(results[0]*1).trigger('input');
    }
  );
      $(".q3 #previous").click(
    function() {
      $(".q2").addClass("show");
      $(".q2").removeClass("hide");
      $(".q3").addClass("hide");
      $(".q3").removeClass("show");
      results[2]=$rangeInput.val();
      $rangeInput.val(results[1]*1).trigger('input');
    }
  );
    $(".q4 #previous").click(
    function() {
      $(".q3").addClass("show");
      $(".q3").removeClass("hide");
      $(".q4").addClass("hide");
      $(".q4").removeClass("show");
      results[3]=$rangeInput.val();
      $rangeInput.val(results[2]*1).trigger('input');
    }
  );
    $(".q5 #previous").click(
    function() {
      $(".q4").addClass("show");
      $(".q4").removeClass("hide");
      $(".q5").addClass("hide");
      $(".q5").removeClass("show");
      results[4]=$rangeInput.val();
      $rangeInput.val(results[3]*1).trigger('input');
    }
  );
    $(".q6 #previous").click(
    function() {
      $(".q5").addClass("show");
      $(".q5").removeClass("hide");
      $(".q6").addClass("hide");
      $(".q6").removeClass("show");
      results[5]=$rangeInput.val();
      $rangeInput.val(results[4]*1).trigger('input');
    }
  );
    $(".q7 #previous").click(
    function() {
      $(".q6").addClass("show");
      $(".q6").removeClass("hide");
      $(".q7").addClass("hide");
      $(".q7").removeClass("show");
      results[6]=$rangeInput.val();
      $rangeInput.val(results[5]*1).trigger('input');
    }
  );
    $(".q8 #previous").click(
    function() {
      $(".q7").addClass("show");
      $(".q7").removeClass("hide");
      $(".q8").addClass("hide");
      $(".q8").removeClass("show");
      results[7]=$rangeInput.val();
      $rangeInput.val(results[6]*1).trigger('input');
    }
  );
   $(".q9 #previous").click(
    function() {
      $(".q8").addClass("show");
      $(".q8").removeClass("hide");
      $(".q9").addClass("hide");
      $(".q9").removeClass("show");
      results[8]=$rangeInput.val();
      $rangeInput.val(results[7]*1).trigger('input');
    }
  );

$(".q10 #previous").click(
    function() {
      $(".q9").addClass("show");
      $(".q9").removeClass("hide");
      $(".q10").addClass("hide");
      $(".q10").removeClass("show");
      results[9]=$rangeInput.val();
      $rangeInput.val(results[8]*1).trigger('input');
    }
  );