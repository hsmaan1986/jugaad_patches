let data = [
  [117, 122, 6],
  [108, 110, 5],
  [101, 100, 5],
  [89, 86, 5],
  [87, 85, 5],
  [85, 83, 5],
  [81, 81, 4],
  [81, 81, 4],
  [81, 81, 4],
  [81, 82, 4],
  [81, 82, 4],
  [81, 82, 4],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3],
  [80, 80, 3]
];

$suffix = ["ı", "u", "si", "u", "ı", "si", "ı", "i", "i", "ı", "ü"];
$ = jQuery;

$(document).ready(function () {
  $form = $("#alfamino-calculator");
  $result = $("#alfamino-result, #result-modal");

  $resultModal = $("#result-modal");
  $buttonIcd = $(".button-icd");
  $closeIcd = $(".close-icd");

  $age = $form.find("#age");
  $kilo = $form.find("#kilo");
  $gender = $form.find("#gender");
  $calPerKilogram = $form.find("#cal-per-kilogram");
  $dailyCalorieNeeds = $form.find("#daily-calorie-needs");
  $percentageOfUseOfAlfaminoForDailyUse = $form.find("#percentage-of-use-of-alfamino-for-daily-use");
  $dailyCaloriesToBeMetWithAlfamino = $form.find("#daily-calories-to-be-met-with-alfamino");
  $alfaminoGrPerDay = $form.find("#alfamino-gr-per-day");
  $alfaminoScalePerDay = $form.find("#alfamino-scale-per-day");
  $alfaminoRecomendedMealScale = $form.find("#alfamino-recomended-meal-scale");
  $alfaminoBoxPerDay = $form.find("#alfamino-box-per-day");

  $age.change(() => calculate());
  $kilo.keyup(() => calculate());
  $kilo.change(() => calculate());
  $gender.keyup(() => calculate());
  $gender.change(() => calculate());
  $percentageOfUseOfAlfaminoForDailyUse.change(() => calculate());

  function calculate() {
    if (!($age.val() && $kilo.val() && $gender.val())) return;

    $calPerKilogram.val($gender.val() == "m" ? data[$age.val() - 1][1] : data[$age.val() - 1][0])
    $dailyCalorieNeeds.val($kilo.val() * $calPerKilogram.val());
    $dailyCaloriesToBeMetWithAlfamino.val(($dailyCalorieNeeds.val() * $percentageOfUseOfAlfaminoForDailyUse.val()).toFixed(1))
    $alfaminoGrPerDay.val(Math.round($dailyCaloriesToBeMetWithAlfamino.val() / 5.03));
    $alfaminoScalePerDay.val(Math.round($alfaminoGrPerDay.val() / 4.6));
    $alfaminoRecomendedMealScale.val(data[$age.val() - 1][2] + " x " + Math.ceil($alfaminoScalePerDay.val() / data[$age.val() - 1][2]));
    $alfaminoBoxPerDay.val(Math.ceil($dailyCaloriesToBeMetWithAlfamino.val() * 30 / 2012));
  }

  // $("body").click(() => {
  //   $resultModal.css("display", "none");
  // });

  $buttonIcd.click(function () {
    $("#result-modal").css("display", "block");

    $result.find(".age").text("2");
    $result.find(".kilo").text("40");
    $result.find(".gender").text("Erkek");
    $result.find(".cal-per-kilogram").text("200");
    $result.find(".daily-calorie-needs").text("700");
    $result.find(".percentage-of-use-of-alfamino-for-daily-use").text("100%'ü");
    $result.find(".daily-calories-to-be-met-with-alfamino").text("200");
    $result.find(".alfamino-gr-per-day").text("200");
    $result.find(".alfamino-scale-per-day").text("20");
    $result.find(".alfamino-recomended-meal-scale").text("6x5");
    $result.find(".alfamino-box-per-day").text("11");
  });

  $closeIcd.click(() => {
    $resultModal.css("display", "none");
  });

  $form.submit(function (event) {
    event.preventDefault();
    $resultModal.css("display", "block");

    $percentageOfUseOfAlfaminoForDailyUseValue = $percentageOfUseOfAlfaminoForDailyUse.val();

    $result.find(".age").text($age.val());
    $result.find(".kilo").text($kilo.val());
    $result.find(".gender").text($gender.val());
    $result.find(".cal-per-kilogram").text($calPerKilogram.val());
    $result.find(".daily-calorie-needs").text($dailyCalorieNeeds.val());
    $result.find(".percentage-of-use-of-alfamino-for-daily-use").text(
      $percentageOfUseOfAlfaminoForDailyUse.val() * 100 + "'" + $suffix[$percentageOfUseOfAlfaminoForDailyUseValue * 10]
    );
    $result.find(".daily-calories-to-be-met-with-alfamino").text($dailyCaloriesToBeMetWithAlfamino.val());
    $result.find(".alfamino-gr-per-day").text($alfaminoGrPerDay.val());
    $result.find(".alfamino-scale-per-day").text($alfaminoScalePerDay.val());
    $result.find(".alfamino-recomended-meal-scale").text($alfaminoRecomendedMealScale.val());
    $result.find(".alfamino-box-per-day").text($alfaminoBoxPerDay.val());
    //window.print();
  });
});
