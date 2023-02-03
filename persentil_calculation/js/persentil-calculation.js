$ = jQuery;

$(document).ready(function () {
  $form = $("#persentil-calculator").find("#form");
  $result = $("#persentil-calculator").find("#result");

  $fullname = $form.find("#fullname");
  $birthday = $form.find("#birthday");
  $height = $form.find("#height");
  $bcevre = $form.find("#bcevre");
  $vki = $result.find(".vki");
  $kilo = $form.find("#kilo");
  $notes = $form.find("#notes");
  $activity = $form.find("#activity");
  $gender = $form.find("#gender-selector");

  var kcal_bebek_erkek = ["384","458","523","525","640","744","840","898","948","997","1062","1112","1154","1195","1180"];
  var kcal_cocuk_erkek = ["1267","1290","1359","1386","1460","1501","1636","1774","1918","2080","2359","2667","2883","3125","3316","3416","3481","3611"];
  var kcal_bebek_kız = ["353","414","479","487","577","679","753","809","857","905","959","1008","1056","1104","1086"];
  var kcal_cocuk_kız = ["1155","1190","1278","1316","1394","1428","1527","1640","1757","1884","2093","2345","2465","2505","2505","2500","2523","2562"];
  var height_z_score_erkek_L = ["1"];
  var height_z_score_kız_L = ["1"];
  var height_z_score_erkek_M = ["50.0","54.0","57.9","61.3","68.0","72.8","76.9","80.2","83.1","85.7","88.2","90.5","92.6","94.8","96.8","100.5","104.0","107.3","110.4","113.3","116.1","121.5","126.9","132.1","137.6","143.8","150.6","157.7","164.9","170.3","173.4","175.0","176.2"];
  var height_z_score_kız_M = ["49.4","53.1","56.8","59.9","66.4","71.2","75.1","78.5","81.5","84.3","86.8","89.1","91.2","93.4","95.4","99.0","102.5","105.9","109.1","112.1","115.1","121.1","126.7","132.1","137.9","145.4","153.1","157.8","160.4","161.7","162.4","162.7","163.1"];
  var height_z_score_erkek_S = ["0.044","0.050","0.048","0.044","0.041","0.039","0.042","0.042","0.043","0.044","0.044","0.043","0.042","0.041","0.041","0.041","0.041","0.041","0.041","0.041","0.041","0.041","0.042","0.042","0.043","0.045","0.048","0.050","0.047","0.042","0.038","0.037","0.035"];
  var height_z_score_kız_S = ["0.043","0.043","0.042","0.041","0.039","0.038","0.038","0.039","0.040","0.040","0.041","0.041","0.042","0.042","0.042","0.043","0.043","0.042","0.042","0.042","0.041","0.041","0.042","0.044","0.047","0.047","0.042","0.038","0.037","0.036","0.036","0.036","0.036"];

  var weight_z_score_erkek_L = ["1.09","1.00","0.90","0.80","0.54","0.35","0.19","0.06","-0.05","-0.16","-0.26","-0.37","-0.47","-0.56","-0.66","-0.47","-0.51","-0.55","-0.59","-0.63","-0.67","-0.74","-0.78","-0.78","-0.69","-0.46","-0.13","0.08","0.06","-0.09","-0.23","-0.34","-0.43"];
  var weight_z_score_kız_L = ["0.83","1.22","1.17","0.76","0.08","0.25","0.25","0.21","0.22","0.23","0.15","0.00","0.17","0.27","0.30","-0.16","-0.20","-0.24","-0.28","-0.33","-0.36","-0.42","-0.44","-0.40","-0.26","-0.07","0.06","0.04","-0.06","-0.13","-0.17","-0.20","-0.24"];
  var weight_z_score_erkek_M = ["3.4","4.4","5.5","6.4","8.1","9.3","10.2","10.9","11.5","12.1","12.7","13.3","13.8","14.3","14.8","15.9","16.8","17.7","18.6","19.6","20.7","23.2","23.9","28.8","32.2","37.8","44.3","49.8","56.2","62.1","66.2","69.2","71.8"];
  var weight_z_score_kız_M = ["3.3","4.1","5.1","5.8","7.4","8.6","9.4","10.1","10.7","11.3","11.9","12.5","13.1","13.7","14.2","15.1","16.1","17.3","18.4","19.5","20.6","22.9","25.7","28.9","32.6","38.2","45.1","50.0","53.3","55.3","56.3","57.2","58.1"];
  var weight_z_score_erkek_S = ["0.131","0.154","0.145","0.140","0.132","0.124","0.127","0.124","0.123","0.122","0.122","0.124","0.124","0.126","0.131","0.131","0.133","0.135","0.137","0.139","0.141","0.147","0.155","0.167","0.183","0.204","0.215","0.209","0.191","0.170","0.155","0.146","0.139"];
  var weight_z_score_kız_S = ["0.128","0.134","0.132","0.126","0.120","0.121","0.121","0.120","0.122","0.123","0.124","0.124","0.123","0.123","0.122","0.13","0.13","0.14","0.14","0.15","0.15","0.16","0.17","0.18","0.20","0.20","0.18","0.15","0.13","0.12","0.12","0.12","0.11"];


  var today = new Date();
  var birthDate = new Date($birthday.val());
  var personage = today.getFullYear() - birthDate.getFullYear();
  var personmonth = today.getMonth() - birthDate.getMonth();
  var sumofmonth = personmonth + (personage*12);
  if (sumofmonth < 36 ) {
    $(".vki-wrapper").css("display","none");
    $(".bcevre-wrapper").css("display","flex");
  }
  if (sumofmonth >= 36 ) {
    $(".bcevre-wrapper").css("display","none");
    $(".vki-wrapper").css("display","flex");
  }

  // $form.find(".gender-selector li").click(function (e) {
  //   $(this).parent().find("li").toggleClass("active");
  //   $form.find('input[name=gender]').not(':checked').prop("checked", true);
  //
  //   $("body").get(0).style.setProperty("--persentil-calculator-color",
  //     $("body").get(0).style.getPropertyValue("--persentil-calculator-color") !== "#ff69b4" ? "#ff69b4" : "#4186f3");
  //
  //   $activity.find("option").each((i, v) => {
  //     let tmp = $(v).attr("value");
  //     $(v).attr("value", $(v).attr("o-value"));
  //     $(v).attr("o-value", tmp);
  //   });
  //
  //   calculate();
  // })

  $fullname.keyup(() => calculate());
  $fullname.change(() => calculate());
  $birthday.keyup(() => calculate());
  $birthday.change(() => calculate());
  $height.keyup(() => calculate());
  $height.change(() => calculate());
  $kilo.keyup(() => calculate());
  $kilo.change(() => calculate());
  $bcevre.keyup(() => calculate());
  $bcevre.change(() => calculate());
  $vki.keyup(() => calculate());
  $vki.change(() => calculate());
  $notes.keyup(() => calculate());
  $notes.change(() => calculate());
  $activity.change(() => calculate());
  $gender.change(() => calculate());

  function calculate() {
    let current_datetime = new Date()
    let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear() + " " + current_datetime.getHours() + ":" + current_datetime.getMinutes() + ":" + current_datetime.getSeconds()

    if ($height.val()) $("#height-z").show();
    else $("#height-z").hide();

    if ($kilo.val()) $("#kilo-z").show();
    else $("#kilo-z").hide();

    $result.find("span.fullname").text($fullname.val());
    $result.find("span.gender").text($form.find("#gender-selector").val());
    $result.find("span.height").text($height.val() ? $height.val() + " cm" : "");
    $result.find("span.kilo").text($kilo.val() ? $kilo.val() + " kg" : "");
    $result.find("span.age").text(getAge($birthday.val()));
    $result.find("span.kcal").text("NaN kcal");
    $result.find("span.vki").text(($kilo.val() / $height.val() / $height.val() * 10000).toFixed(2));
    // $result.find("svg").replaceWith($form.find(".gender-selector li.active").html());
    $result.find("#head span").html(formatted_date);

    var today = new Date();
    var birthDate = new Date($birthday.val());
    var personage = today.getFullYear() - birthDate.getFullYear();
    var personmonth = today.getMonth() - birthDate.getMonth();
    var sumofmonth = personmonth + (personage*12);
    if (sumofmonth < 36 ) {
      $(".vki-wrapper").css("display","none");
      $(".bcevre-wrapper").css("display","flex");
    }
    if (sumofmonth >= 36 ) {
      $(".bcevre-wrapper").css("display","none");
      $(".vki-wrapper").css("display","flex");
    }


    ///// Z-SCORE
    var height_z_score_erkek = [Math.pow(($kilo.val()/height_z_score_erkek_M),height_z_score_erkek_L)-1]/(height_z_score_erkek_L*height_z_score_erkek_S);
    ///// Z-SCORE END

    if (sumofmonth < 37 && $gender.val() == "Erkek") {
      if (sumofmonth < 1) {
        $result.find("span.kcal").text(kcal_bebek_erkek[0]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[0]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[0]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[0]),weight_z_score_erkek_L[0])-1]/(weight_z_score_erkek_L[0]*weight_z_score_erkek_S[0]));

      }
      else if (sumofmonth < 2) {
        $result.find("span.kcal").text(kcal_bebek_erkek[1]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[1]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[1]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[1]),weight_z_score_erkek_L[1])-1]/(weight_z_score_erkek_L[1]*weight_z_score_erkek_S[1]));

      }
      else if (sumofmonth < 3) {
        $result.find("span.kcal").text(kcal_bebek_erkek[2]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[2]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[2]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[2]),weight_z_score_erkek_L[2])-1]/(weight_z_score_erkek_L[2]*weight_z_score_erkek_S[2]));

      }
      else if (sumofmonth < 4) {
        $result.find("span.kcal").text(kcal_bebek_erkek[3]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[3]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[3]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[3]),weight_z_score_erkek_L[3])-1]/(weight_z_score_erkek_L[3]*weight_z_score_erkek_S[3]));

      }
      else if (sumofmonth < 7) {
        $result.find("span.kcal").text(kcal_bebek_erkek[4]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[4]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[4]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[4]),weight_z_score_erkek_L[4])-1]/(weight_z_score_erkek_L[4]*weight_z_score_erkek_S[4]));


      }
      else if (sumofmonth < 10) {
        $result.find("span.kcal").text(kcal_bebek_erkek[5]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[5]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[5]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[5]),weight_z_score_erkek_L[5])-1]/(weight_z_score_erkek_L[5]*weight_z_score_erkek_S[5]));


      }
      else if (sumofmonth < 13) {
        $result.find("span.kcal").text(kcal_bebek_erkek[6]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[6]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[6]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[6]),weight_z_score_erkek_L[6])-1]/(weight_z_score_erkek_L[6]*weight_z_score_erkek_S[6]));

      }
      else if (sumofmonth < 16) {
        $result.find("span.kcal").text(kcal_bebek_erkek[7]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[7]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[7]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[7]),weight_z_score_erkek_L[7])-1]/(weight_z_score_erkek_L[7]*weight_z_score_erkek_S[7]));

      }
      else if (sumofmonth < 19) {
        $result.find("span.kcal").text(kcal_bebek_erkek[8]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[8]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[8]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[8]),weight_z_score_erkek_L[8])-1]/(weight_z_score_erkek_L[8]*weight_z_score_erkek_S[8]));

      }
      else if (sumofmonth < 22) {
        $result.find("span.kcal").text(kcal_bebek_erkek[9]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[9]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[9]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[9]),weight_z_score_erkek_L[9])-1]/(weight_z_score_erkek_L[9]*weight_z_score_erkek_S[9]));

      }
      else if (sumofmonth < 25) {
        $result.find("span.kcal").text(kcal_bebek_erkek[10]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[10]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[10]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[10]),weight_z_score_erkek_L[10])-1]/(weight_z_score_erkek_L[10]*weight_z_score_erkek_S[10]));

      }
      else if (sumofmonth < 28) {
        $result.find("span.kcal").text(kcal_bebek_erkek[11]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[11]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[11]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[11]),weight_z_score_erkek_L[11])-1]/(weight_z_score_erkek_L[11]*weight_z_score_erkek_S[11]));

      }
      else if (sumofmonth < 31) {
        $result.find("span.kcal").text(kcal_bebek_erkek[12]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[12]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[12]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[12]),weight_z_score_erkek_L[12])-1]/(weight_z_score_erkek_L[12]*weight_z_score_erkek_S[12]));

      }
      else if (sumofmonth < 34) {
        $result.find("span.kcal").text(kcal_bebek_erkek[13]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[13]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[13]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[13]),weight_z_score_erkek_L[13])-1]/(weight_z_score_erkek_L[13]*weight_z_score_erkek_S[13]));

      }
      else if (sumofmonth < 37) {
        $result.find("span.kcal").text(kcal_bebek_erkek[14]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[14]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[14]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[14]),weight_z_score_erkek_L[14])-1]/(weight_z_score_erkek_L[14]*weight_z_score_erkek_S[14]));

      }
    }

    if (sumofmonth < 37 && $gender.val() == "Kız") {
      if (sumofmonth < 1) {
        $result.find("span.kcal").text(kcal_bebek_kız[0]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[0]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[0]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[0]),weight_z_score_kız_L[0])-1]/(weight_z_score_kız_L[0]*weight_z_score_kız_S[0]));

      }
      else if (sumofmonth < 2) {
        $result.find("span.kcal").text(kcal_bebek_kız[1]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[1]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[1]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[1]),weight_z_score_kız_L[1])-1]/(weight_z_score_kız_L[1]*weight_z_score_kız_S[1]));

      }
      else if (sumofmonth < 3) {
        $result.find("span.kcal").text(kcal_bebek_kız[2]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[2]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[2]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[2]),weight_z_score_kız_L[2])-1]/(weight_z_score_kız_L[2]*weight_z_score_kız_S[2]));

      }
      else if (sumofmonth < 4) {
        $result.find("span.kcal").text(kcal_bebek_kız[3]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[3]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[3]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[3]),weight_z_score_kız_L[3])-1]/(weight_z_score_kız_L[3]*weight_z_score_kız_S[3]));

      }
      else if (sumofmonth < 7) {
        $result.find("span.kcal").text(kcal_bebek_kız[4]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[4]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[4]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[4]),weight_z_score_kız_L[4])-1]/(weight_z_score_kız_L[4]*weight_z_score_kız_S[4]));

      }
      else if (sumofmonth < 10) {
        $result.find("span.kcal").text(kcal_bebek_kız[5]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[5]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[5]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[5]),weight_z_score_kız_L[5])-1]/(weight_z_score_kız_L[5]*weight_z_score_kız_S[5]));

      }
      else if (sumofmonth < 13) {
        $result.find("span.kcal").text(kcal_bebek_kız[6]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[6]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[6]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[6]),weight_z_score_kız_L[6])-1]/(weight_z_score_kız_L[6]*weight_z_score_kız_S[6]));

      }
      else if (sumofmonth < 16) {
        $result.find("span.kcal").text(kcal_bebek_kız[7]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[7]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[7]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[7]),weight_z_score_kız_L[7])-1]/(weight_z_score_kız_L[7]*weight_z_score_kız_S[7]));

      }
      else if (sumofmonth < 19) {
        $result.find("span.kcal").text(kcal_bebek_kız[8]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[8]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[8]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[8]),weight_z_score_kız_L[8])-1]/(weight_z_score_kız_L[8]*weight_z_score_kız_S[8]));

      }
      else if (sumofmonth < 22) {
        $result.find("span.kcal").text(kcal_bebek_kız[9]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[9]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[9]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[9]),weight_z_score_kız_L[9])-1]/(weight_z_score_kız_L[9]*weight_z_score_kız_S[9]));

      }
      else if (sumofmonth < 25) {
        $result.find("span.kcal").text(kcal_bebek_kız[10]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[10]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[10]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[10]),weight_z_score_kız_L[10])-1]/(weight_z_score_kız_L[10]*weight_z_score_kız_S[10]));

      }
      else if (sumofmonth < 28) {
        $result.find("span.kcal").text(kcal_bebek_kız[11]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[11]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[11]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[11]),weight_z_score_kız_L[11])-1]/(weight_z_score_kız_L[11]*weight_z_score_kız_S[11]));

      }
      else if (sumofmonth < 31) {
        $result.find("span.kcal").text(kcal_bebek_kız[12]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[12]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[12]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[12]),weight_z_score_kız_L[12])-1]/(weight_z_score_kız_L[12]*weight_z_score_kız_S[12]));

      }
      else if (sumofmonth < 34) {
        $result.find("span.kcal").text(kcal_bebek_kız[13]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[13]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[13]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[13]),weight_z_score_kız_L[13])-1]/(weight_z_score_kız_L[13]*weight_z_score_kız_S[13]));

      }
      else if (sumofmonth < 37) {
        $result.find("span.kcal").text(kcal_bebek_kız[14]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[14]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[14]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[14]),weight_z_score_kız_L[14])-1]/(weight_z_score_kız_L[14]*weight_z_score_kız_S[14]));

      }
    }

    if (sumofmonth > 36 && $gender.val() == "Erkek") {
      if (sumofmonth < 43) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[0]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[15]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[15]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[15]),weight_z_score_erkek_L[15])-1]/(weight_z_score_erkek_L[15]*weight_z_score_erkek_S[15]));

      }
      else if (sumofmonth < 49) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[1]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[16]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[16]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[16]),weight_z_score_erkek_L[16])-1]/(weight_z_score_erkek_L[16]*weight_z_score_erkek_S[16]));

      }
      else if (sumofmonth < 55) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[2]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[17]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[17]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[17]),weight_z_score_erkek_L[17])-1]/(weight_z_score_erkek_L[17]*weight_z_score_erkek_S[17]));

      }
      else if (sumofmonth < 61) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[3]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[18]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[18]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[18]),weight_z_score_erkek_L[18])-1]/(weight_z_score_erkek_L[18]*weight_z_score_erkek_S[18]));

      }
      else if (sumofmonth < 67) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[4]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[19]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[19]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[19]),weight_z_score_erkek_L[19])-1]/(weight_z_score_erkek_L[19]*weight_z_score_erkek_S[19]));

      }
      else if (sumofmonth < 73) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[5]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[20]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[20]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[20]),weight_z_score_erkek_L[20])-1]/(weight_z_score_erkek_L[20]*weight_z_score_erkek_S[20]));

      }
      else if (sumofmonth < 85) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[6]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[21]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[21]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[21]),weight_z_score_erkek_L[21])-1]/(weight_z_score_erkek_L[21]*weight_z_score_erkek_S[21]));

      }
      else if (sumofmonth < 97) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[7]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[22]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[22]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[22]),weight_z_score_erkek_L[22])-1]/(weight_z_score_erkek_L[22]*weight_z_score_erkek_S[22]));


      }
      else if (sumofmonth < 109) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[8]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[23]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[23]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[23]),weight_z_score_erkek_L[23])-1]/(weight_z_score_erkek_L[23]*weight_z_score_erkek_S[23]));

      }
      else if (sumofmonth < 121) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[9]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[24]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[24]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[24]),weight_z_score_erkek_L[24])-1]/(weight_z_score_erkek_L[24]*weight_z_score_erkek_S[24]));

      }
      else if (sumofmonth < 133) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[10]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[25]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[25]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[25]),weight_z_score_erkek_L[25])-1]/(weight_z_score_erkek_L[25]*weight_z_score_erkek_S[25]));

      }
      else if (sumofmonth < 145) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[11]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[26]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[26]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[26]),weight_z_score_erkek_L[26])-1]/(weight_z_score_erkek_L[26]*weight_z_score_erkek_S[26]));

      }
      else if (sumofmonth < 157) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[12]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[27]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[27]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[27]),weight_z_score_erkek_L[27])-1]/(weight_z_score_erkek_L[27]*weight_z_score_erkek_S[27]));

      }
      else if (sumofmonth < 169) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[13]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[28]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[28]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[28]),weight_z_score_erkek_L[28])-1]/(weight_z_score_erkek_L[28]*weight_z_score_erkek_S[28]));

      }
      else if (sumofmonth < 181) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[14]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[29]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[29]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[29]),weight_z_score_erkek_L[29])-1]/(weight_z_score_erkek_L[29]*weight_z_score_erkek_S[29]));

      }
      else if (sumofmonth < 193) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[15]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[30]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[30]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[30]),weight_z_score_erkek_L[30])-1]/(weight_z_score_erkek_L[30]*weight_z_score_erkek_S[30]));

      }
      else if (sumofmonth < 205) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[16]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[31]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[31]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[31]),weight_z_score_erkek_L[31])-1]/(weight_z_score_erkek_L[31]*weight_z_score_erkek_S[31]));

      }
      else if (sumofmonth < 217) {
        $result.find("span.kcal").text(kcal_cocuk_erkek[17]);
        $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_erkek_M[32]),height_z_score_erkek_L[0])-1]/(height_z_score_erkek_L[0]*height_z_score_erkek_S[32]));
        $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_erkek_M[32]),weight_z_score_erkek_L[32])-1]/(weight_z_score_erkek_L[32]*weight_z_score_erkek_S[32]));

      }
    }

if (sumofmonth > 36 && $gender.val() == "Kız") {
  if (sumofmonth < 43) {
    $result.find("span.kcal").text(kcal_cocuk_kız[0]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[15]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[15]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[15]),weight_z_score_kız_L[15])-1]/(weight_z_score_kız_L[15]*weight_z_score_kız_S[15]));

  }
  else if (sumofmonth < 49) {
    $result.find("span.kcal").text(kcal_cocuk_kız[1]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[16]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[16]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[16]),weight_z_score_kız_L[16])-1]/(weight_z_score_kız_L[16]*weight_z_score_kız_S[16]));

  }
  else if (sumofmonth < 55) {
    $result.find("span.kcal").text(kcal_cocuk_kız[2]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[17]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[17]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[17]),weight_z_score_kız_L[17])-1]/(weight_z_score_kız_L[17]*weight_z_score_kız_S[17]));

  }
  else if (sumofmonth < 61) {
    $result.find("span.kcal").text(kcal_cocuk_kız[3]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[18]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[18]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[18]),weight_z_score_kız_L[18])-1]/(weight_z_score_kız_L[18]*weight_z_score_kız_S[18]));

  }
  else if (sumofmonth < 67) {
    $result.find("span.kcal").text(kcal_cocuk_kız[4]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[19]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[19]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[19]),weight_z_score_kız_L[19])-1]/(weight_z_score_kız_L[19]*weight_z_score_kız_S[19]));

  }
  else if (sumofmonth < 73) {
    $result.find("span.kcal").text(kcal_cocuk_kız[5]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[20]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[20]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[20]),weight_z_score_kız_L[20])-1]/(weight_z_score_kız_L[20]*weight_z_score_kız_S[20]));

  }
  else if (sumofmonth < 85) {
    $result.find("span.kcal").text(kcal_cocuk_kız[6]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[21]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[21]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[21]),weight_z_score_kız_L[21])-1]/(weight_z_score_kız_L[21]*weight_z_score_kız_S[21]));

  }
  else if (sumofmonth < 97) {
    $result.find("span.kcal").text(kcal_cocuk_kız[7]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[22]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[22]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[22]),weight_z_score_kız_L[22])-1]/(weight_z_score_kız_L[22]*weight_z_score_kız_S[22]));

  }
  else if (sumofmonth < 109) {
    $result.find("span.kcal").text(kcal_cocuk_kız[8]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[23]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[23]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[23]),weight_z_score_kız_L[23])-1]/(weight_z_score_kız_L[23]*weight_z_score_kız_S[23]));

  }
  else if (sumofmonth < 121) {
    $result.find("span.kcal").text(kcal_cocuk_kız[9]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[24]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[24]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[24]),weight_z_score_kız_L[24])-1]/(weight_z_score_kız_L[24]*weight_z_score_kız_S[24]));

  }
  else if (sumofmonth < 133) {
    $result.find("span.kcal").text(kcal_cocuk_kız[10]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[25]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[25]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[25]),weight_z_score_kız_L[25])-1]/(weight_z_score_kız_L[25]*weight_z_score_kız_S[25]));

  }
  else if (sumofmonth < 145) {
    $result.find("span.kcal").text(kcal_cocuk_kız[11]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[26]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[26]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[26]),weight_z_score_kız_L[26])-1]/(weight_z_score_kız_L[26]*weight_z_score_kız_S[26]));

  }
  else if (sumofmonth < 157) {
    $result.find("span.kcal").text(kcal_cocuk_kız[12]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[27]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[27]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[27]),weight_z_score_kız_L[27])-1]/(weight_z_score_kız_L[27]*weight_z_score_kız_S[27]));

  }
  else if (sumofmonth < 169) {
    $result.find("span.kcal").text(kcal_cocuk_kız[13]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[28]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[28]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[28]),weight_z_score_kız_L[28])-1]/(weight_z_score_kız_L[28]*weight_z_score_kız_S[28]));

  }
  else if (sumofmonth < 181) {
    $result.find("span.kcal").text(kcal_cocuk_kız[14]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[29]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[29]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[29]),weight_z_score_kız_L[29])-1]/(weight_z_score_kız_L[29]*weight_z_score_kız_S[29]));

  }
  else if (sumofmonth < 193) {
    $result.find("span.kcal").text(kcal_cocuk_kız[15]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[30]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[30]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[30]),weight_z_score_kız_L[30])-1]/(weight_z_score_kız_L[30]*weight_z_score_kız_S[30]));

  }
  else if (sumofmonth < 205) {
    $result.find("span.kcal").text(kcal_cocuk_kız[16]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[31]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[31]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[31]),weight_z_score_kız_L[31])-1]/(weight_z_score_kız_L[31]*weight_z_score_kız_S[31]));

  }
  else if (sumofmonth < 217) {
    $result.find("span.kcal").text(kcal_cocuk_kız[17]);
    $result.find("span.z-score").text([Math.pow(($height.val()/height_z_score_kız_M[32]),height_z_score_kız_L[0])-1]/(height_z_score_kız_L[0]*height_z_score_kız_S[32]));
    $result.find("span.z-score-kilo").text([Math.pow(($kilo.val()/weight_z_score_kız_M[32]),weight_z_score_kız_L[32])-1]/(weight_z_score_kız_L[32]*weight_z_score_kız_S[32]));

  }
}

    var num_boy = parseFloat(jQuery(".z-score").text()); // Read Value from DOM
    var num_kilo = parseFloat(jQuery(".z-score-kilo").text()); // Read Value from DOM
    var rounded_boy = num_boy.toFixed(2); // Round Number
    var rounded_kilo = num_kilo.toFixed(2); // Round Number
    $result.find("span.z-score").text(rounded_boy);
    $result.find("span.z-score-kilo").text(rounded_kilo);
  }

  $( ".graph-button").click(function() {
    $( ".boy-dot" ).remove();
    $( ".kilo-dot" ).remove();
    $( ".vki-dot" ).remove();
    $( ".bcevre-dot" ).remove();
    var today = new Date();
    var birthDate = new Date($birthday.val());
    var personage = today.getFullYear() - birthDate.getFullYear();
    var personmonth = today.getMonth() - birthDate.getMonth();
    var sumofmonth = personmonth + (personage*12);
    console.log(sumofmonth);
    if ($gender.val() == "Erkek" && sumofmonth >= 36 ) {
      $("#persentil-graph .modal-body").append("<div class='boy-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(84px + (1.62px* "+sumofmonth+"));top: calc(730px - ("+$height.val()/10+"px*30));'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='kilo-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(84px + (1.62px* "+sumofmonth+"));bottom: calc(120px + ("+$kilo.val()+"px* 3.5))'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='vki-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(507px + (1.07px* "+sumofmonth+"));bottom: calc(("+$vki.text()+"px * 7 * 5) - 295px)'>&nbsp;</div>");
    }
    else if ($gender.val() == "Kız" && sumofmonth >= 36 ){
      $("#persentil-graph .modal-body").append("<div class='boy-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(86px + (1.62px* "+sumofmonth+"));top: calc(730px - ("+$height.val()/10+"px*32));'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='kilo-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(86px + (1.62px* "+sumofmonth+"));bottom: calc(120px + ("+$kilo.val()+"px* 4.5))'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='vki-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(506px + (1.07px* "+sumofmonth+"));bottom: calc(("+$vki.text()+"px * 9 * 5) - 420px)'>&nbsp;</div>");
    }
    else if ($gender.val() == "Erkek" && sumofmonth < 36 ){
      $("#persentil-graph .modal-body").append("<div class='boy-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(100px + (10px* "+sumofmonth+"));top: calc(730px - ("+$height.val()/10+"px*54.5));'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='kilo-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(100px + (10px* "+sumofmonth+"));bottom: calc(100px + ("+$kilo.val()+"px* 17))'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='bcevre-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(529px + (6.5px* "+sumofmonth+"));bottom: calc(("+$bcevre.val()+" * 6 * 5px) - 822px)'>&nbsp;</div>");
    }
    else if ($gender.val() == "Kız" && sumofmonth < 36 ){
      $("#persentil-graph .modal-body").append("<div class='boy-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(100px + (10px* "+sumofmonth+"));top: calc(730px - ("+$height.val()/10+"px*54.5));'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='kilo-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(100px + (10px* "+sumofmonth+"));bottom: calc(100px + ("+$kilo.val()+"px* 18.7))'>&nbsp;</div>");
      $("#persentil-graph .modal-body").append("<div class='bcevre-dot' style='position: absolute;width: 10px;height: 10px;border-radius: 50%;background: black;left: calc(529px + (6.5px* "+sumofmonth+"));bottom: calc(("+$bcevre.val()+" * 6 * 5px) - 800px)'>&nbsp;</div>");
    }


              if ($gender.val() == "Erkek" && sumofmonth < 36 ) {
                $("#persentil-graph img").attr("src","/modules/custom/persentil_calculation/images/0-36ay-erkek.png");
              }
              else if ($gender.val() == "Erkek" && sumofmonth >= 36 ) {
                $("#persentil-graph img").attr("src","/modules/custom/persentil_calculation/images/2-18ay-erkek.png");
              }
              else if ($gender.val() == "Kız" && sumofmonth < 36 ) {
                $("#persentil-graph img").attr("src","/modules/custom/persentil_calculation/images/0-36-kiz.png");
              }
              else if ($gender.val() == "Kız" && sumofmonth >= 36 ) {
                $("#persentil-graph img").attr("src","/modules/custom/persentil_calculation/images/2-18-kiz.png");
              }

  });



  // $form.submit(function (event) {
  //   event.preventDefault();
  // });

  function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
    if (m < 0) m = 12 + m;
    if (age < 0) return "";
    return age == 0 ? m + " ay" : age + " yıl " + m + " ay";
  }
});
