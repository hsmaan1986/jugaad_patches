var currentTab = 0;
var allFormSteps;
var allStepIndicators;
var navBtns;
var currentFormId;  // 1. BMI Calculator: bmicalc-form
                    // 2. NRS-2002: nrscalc-form
                    // 3. MNA Calculator: mnacalc-form
                    // 4. Harris Benedict: harrisbenedict-form
                    // 5. Pocket Formula: pocketformula-form
var BMIValue;
var NRSValue;
var MNAValue;
var HRValue;
var PFValue;
var NRSFlag;
var BmiFlag;



// Create Element.remove() function if not exist (IE Fix)
if (!('remove' in Element.prototype)) {
    Element.prototype.remove = function() {
        if (this.parentNode) {
            this.parentNode.removeChild(this);
        }
    };
}

window.addEventListener('load', function () {
    allFormSteps = document.getElementsByClassName('js-calculator-tab');
    allStepIndicators = document.getElementsByClassName('js-calculator-step');
    navBtns = document.getElementById('js-navigation-buttons');
    currentFormId = document.querySelector('.calculator-form').id;
    NRSFlag = true;
    BmiFlag = true;

    if (allFormSteps.length > 0) {
        showTab(currentTab);
    }
})

function nextPrev(n) {

    // If this is the NRS form then do the initial assessment
    if (currentFormId == 'nrscalc-form' && currentTab == 0) {
        NRSInitialAssessment();
    }

    if (NRSFlag) {
        if (n == 1 && !validateForm()) {
            return false;
        }

        allFormSteps[currentTab].style.display = 'none';
        currentTab = currentTab + n;

        if (currentTab >= allFormSteps.length) {
            return false;
        }

        // If we are on the last tab before results, do calculations for specific forms
        if (currentTab == (allFormSteps.length - 1)) {
            if (currentFormId == 'nrscalc-form') { // NRS-2002
                calculateNRS();
            } else if (currentFormId == 'mnacalc-form') { // MNA Calculator
                calculateMNA();
            } else if (currentFormId == 'harrisbenedict-form') { // Harris Benedict Calculator
                calculateHR();
            } else if (currentFormId == 'pocketformula-form') { // Pocket Formula
                calculatePF();
            }
        }

        showTab(currentTab);
    }

}

function showTab(n) {
    navBtns = document.getElementById('js-navigation-buttons');

    allFormSteps[n].style.display = 'block';
    if (n == 0) {
        document.getElementById('prevBtn').style.display = 'none';
    } else {
        document.getElementById('prevBtn').style.display = 'inline';
    }
    if (n == (allFormSteps.length - 1)) {
        navBtns.style.display = 'none';
    } else {
        navBtns.style.display = 'block';
    }
    fixStepIndicator(n);
}

function fixStepIndicator(n) {
    for (var i = 0; i < allStepIndicators.length; i++) {
        allStepIndicators[i].className = allStepIndicators[i].className.replace(' active', '');
    }
    allStepIndicators[n].className += ' active';
}

function validateForm() {
    var valid = true;
    var currentTabInputs = allFormSteps[currentTab].getElementsByClassName('js-input');

    for (var i = 0; i < currentTabInputs.length; i++) {
        if (currentTabInputs[i].value == '') {
            currentTabInputs[i].className += ' invalid';
            valid = false;
        }
    }
    if (valid) {
        allStepIndicators[currentTab].className += ' finish';
    }
    return valid;
}

function showCalculator(calcname) {

    if (calcname == 'hr') {
        document.getElementById('harrisbenedict-form').style.display = 'block';
        document.getElementById('pocketformula-form').remove();
        currentFormId = 'harrisbenedict-form';
    } else if (calcname == 'pocket') {
        document.getElementById('pocketformula-form').style.display = 'block';
        document.getElementById('harrisbenedict-form').remove();
        currentFormId = 'pocketformula-form';
        document.getElementById('js-reference-table').style.display = 'block';
        document.getElementById('defaultOpen').click();
    }

    document.getElementById('js-calc-type').style.display = 'none';

    allFormSteps = document.getElementsByClassName('js-calculator-tab');
    currentTab = 0;

    showTab(currentTab);
}

function switchIndexType(type) {
    if (type == 'bmi') {
        document.getElementById('js-bmi-question').style.display = 'block';
        document.getElementById('js-cc-question').style.display = 'none';
        BmiFlag = true;
    } else if (type == 'cc') {
        document.getElementById('js-cc-question').style.display = 'block';
        document.getElementById('js-bmi-question').style.display = 'none';
        BmiFlag = false;
    }
}

// NRS-2002 Calculator Logic
function NRSInitialAssessment() {
    var currentTabInputs = allFormSteps[0].getElementsByClassName('js-input');
    var flag = false;

    for (var i = 0; i < currentTabInputs.length; i++) {
        if (currentTabInputs[i].checked == true) {
            flag = true;
        }
    }

    if (!flag) {
        for (var a = 0; a < allFormSteps.length; a++) {
            allFormSteps[a].style.display = 'none';
        }
        document.getElementById('js-navigation-buttons').style.display = 'none';
        document.getElementById('nrs-alternative-result').style.display = 'block';
        NRSFlag = false;
    } else {
        NRSFlag = true;
    }
}

function calculateNRS() {
    var step1 = document.querySelectorAll('[name="nrs-question1"], [name="nrs-question2"], [name="nrs-question3"], [name="nrs-question4"]');
    var step2 = document.getElementsByName('nrs-question5');
    var step3 = document.getElementsByName('nrs-question6');
    var step4 = document.getElementsByName('nrs-question7')[0];
    var step1value = 0;
    var step2value = 0;
    var step3value = 0;
    var step4value = 0;
    var total = 0;

    // Removed addition of points for step 1 because client doc does not specify whether or not points should be added
    // for (let i = 0; i < step1.length; i++) {
    //     if (step1[i].checked == true) {
    //         step1value += 1;
    //     }
    // }

    for (let a = 0; a < step2.length; a++) {
        if (step2[a].checked == true) {
            step2value = (+step2[a].value);
        }
    }
    for (let b = 0; b < step3.length; b++) {
        if (step3[b].checked == true) {
            step3value = (+step3[b].value);
        }
    }

    if (step4.checked == true) {
        step4value = 1;
    }

    total = step1value + step2value + step3value + step4value;

    document.getElementById('js-nrs-result').innerHTML = total.toString();

    displayNrsClassification(total);
}

function displayNrsClassification(nrs) {
    switch (true) {
        case (nrs < 3): // severe low weight
            document.getElementById('js-nrs-norisk').style.display = 'block';
            break;
        case (nrs >= 3): // mild low weight
            document.getElementById('js-nrs-atrisk').style.display = 'block';
    }
}

// MNA Calculator Logic
function calculateMNA() {
    var step1 = document.getElementsByName('mna-question1');
    var step2 = document.getElementsByName('mna-question2');
    var step3 = document.getElementsByName('mna-question3');
    var step4 = document.getElementsByName('mna-question4');
    var step5 = document.getElementsByName('mna-question5');
    var step6 = document.getElementsByName('mna-question6');

    var step1value, step2value, step3value, step4value, step5value, step6value = 0;
    var total = 0;

    for (var a = 0; a < step1.length; a++) {
        if (step1[a].checked) {
          step1value = (+step1[a].value);
        }
    }

    for (var b = 0; b < step2.length; b++) {
        if (step2[b].checked) {
            step2value = (+step2[b].value);
        }
    }

    for (var c = 0; c < step3.length; c++) {
        if (step3[c].checked) {
            step3value = (+step3[c].value);
        }
    }

    for (var d = 0; d < step4.length; d++) {
        if (step4[d].checked) {
            step4value = (+step4[d].value);
        }
    }

    for (var e = 0; e < step5.length; e++) {
        if (step5[e].checked) {
            step5value = (+step5[e].value);
        }
    }

    for (var f = 0; f < step6.length; f++) {
        if (step6[f].checked) {
            step6value = (+step6[f].value);
        }
    }

    total = step1value + step2value + step3value + step4value + step5value + step6value;

    document.getElementById('js-mna-result').innerHTML = total.toString();

    displayMnaClassification(total);

}

function displayMnaClassification(mna) {

    switch (true) {
        case (mna >= 12 && mna <= 14): // normal
            document.getElementById('js-mna-normal').style.display = 'block';
            break;
        case (mna >= 8 && mna <= 11): // at risk
            document.getElementById('js-mna-atrisk').style.display = 'block';
            break;
        case (mna >= 0 && mna <= 7): // malnourished
            document.getElementById('js-mna-malnourished').style.display = 'block';
    }

}

// Harris Benedict Calculator Logic
function calculateHR() {
  var step1 = document.getElementsByName('hr-question1');
  var bmr, eer;
  var gender;
  var height, weight, age;
  var activity, injury, temperature;

  for (var i = 0; i < step1.length; i++) {
      if (step1[i].checked) {
          gender = step1[i].value;
      }
  }

  height = document.getElementById('hr-question2').value;
  weight = document.getElementById('hr-question3').value;
  age = document.getElementById('hr-question4').value;

  activity = document.getElementById('hr-question5').value;
  injury = document.getElementById('js-injury-range').value;
  temperature = document.getElementById('hr-question7').value;

  if (gender == 'male') {
      bmr = 66.47 + (13.75 * weight) + (5 * height) - (6.76 * age);
  } else if (gender == 'female') {
      bmr = 65.51 + (9.56 * weight) + (1.85 * height) - (4.68 * age);
  }

  eer = bmr + activity * injury * temperature;

  document.getElementById('js-hr-result').innerHTML = (eer.toFixed(2)).toString() + ' kcal';
}

function selectInjuryFactor() {
  var selectedOption;
  selectedOption = document.getElementById('hr-question6').value;

  document.getElementById('js-range-label').style.display = 'block';
  document.getElementById('js-range-container').style.display = 'block';

  updateInjuryFactorRange((selectedOption.toLowerCase()).trim());
}

function updateInjuryFactorRange(selectedInjuryFactor) {
  var injuryRangeObj = document.getElementById('js-injury-range');
  var startLabel = document.getElementById('js-range-start-label');
  var endLabel = document.getElementById('js-range-end-label');
  var valueLabel = document.getElementById('js-range-value');

  document.getElementById('js-range-label').style.display = 'block';
  document.getElementById('js-range-container').style.display = 'block';

  injuryRangeObj.disabled = false;

  switch (selectedInjuryFactor) {
    case ('uncomplicated patient'):
        injuryRangeObj.min = 1.0;
        injuryRangeObj.max = 1.0;
        injuryRangeObj.value = 1.0;
        document.getElementById('js-range-label').style.display = 'none';
        document.getElementById('js-range-container').style.display = 'none';
        break;
    case ('minor surgery'):
        injuryRangeObj.min = 1.0;
        injuryRangeObj.max = 1.2;
        injuryRangeObj.value = 1.1; // Set slider in middle
        break;
    case ('major surgery'):
        injuryRangeObj.min = 1.1;
        injuryRangeObj.max = 1.3;
        injuryRangeObj.value = 1.2; // Set slider in middle
        break;
    case ('major skeletal or blunt trauma'):
        injuryRangeObj.min = 1.35;
        injuryRangeObj.max = 1.35;
        injuryRangeObj.value = 1.35;
        document.getElementById('js-range-label').style.display = 'none';
        document.getElementById('js-range-container').style.display = 'none';
        break;
    case ('head trauma'):
        injuryRangeObj.min = 1.6;
        injuryRangeObj.max = 1.8;
        injuryRangeObj.value = 1.7; // Set slider in middle
        break;
    case ('mild infection'):
        injuryRangeObj.min = 1.0;
        injuryRangeObj.max = 1.2;
        injuryRangeObj.value = 1.1; // Set slider in middle
        break;
    case ('moderate infection'):
        injuryRangeObj.min = 1.2;
        injuryRangeObj.max = 1.4;
        injuryRangeObj.value = 1.3; // Set slider in middle
        break;
    case ('severe infection'):
        injuryRangeObj.min = 1.4;
        injuryRangeObj.max = 1.8;
        injuryRangeObj.value = 1.6; // Set slider in middle
        break;
    case ('sepsis'):
        injuryRangeObj.min = 1.6;
        injuryRangeObj.max = 1.8;
        injuryRangeObj.value = 1.7; // Set slider in middle
        break;
    case ('burn (< 20% bsa)'):
        injuryRangeObj.min = 1.2;
        injuryRangeObj.max = 1.5;
        injuryRangeObj.value = 1.3; // Set slider in middle
        break;
    case ('burn (20% - 40% bsa)'):
        injuryRangeObj.min = 1.5;
        injuryRangeObj.max = 1.8;
        injuryRangeObj.value = 1.6; // Set slider in middle
        break;
    case ('burn (> 40% bsa)'):
        injuryRangeObj.min = 1.8;
        injuryRangeObj.max = 2.0;
        injuryRangeObj.value = 1.9; // Set slider in middle
        break;
    default:
        injuryRangeObj.min = 1.0;
        injuryRangeObj.max = 2.0;
        injuryRangeObj.value = 1.5; // Set slider in middle
  }

  // Set label values
  startLabel.innerHTML = (injuryRangeObj.min).toString();
  endLabel.innerHTML = (injuryRangeObj.max).toString();
  valueLabel.innerHTML = (injuryRangeObj.value).toString();

}

function updateValueLabel() {
  document.getElementById('js-range-value').innerHTML = document.getElementById('js-injury-range').value;
}

// Pocket Formula Calculator Logic
function calculatePF() {

    var weight, calories, proteins;
    var eer, epr; // estimated energy requirement and estimated protein requirement

    weight = document.getElementById('pf-question1').value;
    calories = document.getElementById('pf-question2').value;
    proteins = document.getElementById('pf-question3').value;

    eer = calories * weight;
    epr = proteins * weight;

    document.getElementById('js-pf-result-1').innerHTML = eer.toString() + ' kcal';
    document.getElementById('js-pf-result-2').innerHTML = epr.toString() + ' g';
    return false;
}

// BMI Calculator logic
var calculateBMI = function (event) {
    var heightValue = (document.getElementById('js-bmicalc-height').value) / 100;
    var weightValue = document.getElementById('js-bmicalc-weight').value;
    var allClassifications = document.getElementsByClassName('bmi-results');
    var allInputs = document.getElementsByClassName('js-input');
    var valid;

    for (var i = 0; i < allClassifications.length; i++) {
        allClassifications[i].style.display = 'none';
    }

    for (var z = 0; z < allInputs.length; z++) {
        allInputs[z].className = allInputs[z].className.replace(' invalid', '');
        valid = true;
    }

    // check inputs are valid
    for (var a = 0; a < allInputs.length; a++) {
        if (allInputs[a].value === '' || allInputs[a].value <= 0 || allInputs[a].value > 999) {
            allInputs[a].className += ' invalid';
            valid = false;
        }
    }

    if (valid) {
        BMIValue = weightValue / (Math.pow(heightValue, 2));

        document.getElementById('js-bmi-novalue').style.display = 'none';
        document.getElementById('js-bmi-hasvalue').style.display = 'block';
        document.getElementById('bmi-resetcontainer').style.display = 'block';
        document.getElementById('js-bmi-result').innerHTML = (BMIValue.toFixed(2)).toString();

        displayBmiClassification(BMIValue.toFixed(2));
    }
    event.preventDefault();
};

var bmi_form = document.getElementById("bmicalc-form");

if (bmi_form !== null) {
    // attach event listener
    bmi_form.addEventListener("submit", calculateBMI, true);
}

function displayBmiClassification(bmi) {
    switch (true) {
        case (bmi < 16.0): // severe low weight
            document.getElementById('js-bmi-severelowweight').style.display = 'block';
            break;
        case (bmi >= 16.0 && bmi <= 16.99): // mild low weight
            document.getElementById('js-bmi-mildlowweight').style.display = 'block';
            break;
        case (bmi >= 17.0 && bmi <= 18.49): // light low weight
            document.getElementById('js-bmi-lightlowweight').style.display = 'block';
            break;
        case (bmi >= 18.5 && bmi <= 24.99): // normal
            document.getElementById('js-bmi-normal').style.display = 'block';
            break;
        case (bmi >= 25.0 && bmi <= 29.99): // overweight
            document.getElementById('js-bmi-overweight').style.display = 'block';
            break;
        case (bmi >= 30.0 && bmi <= 34.99): // obesity grade 1
            document.getElementById('js-bmi-obesity1').style.display = 'block';
            break;
        case (bmi >= 35.0 && bmi <= 39.99): // obesity grade 2
            document.getElementById('js-bmi-obesity2').style.display = 'block';
            break;
        case (bmi >= 40.0): // obesity grade 3
            document.getElementById('js-bmi-obesity3').style.display = 'block';

    }
}

function resetForm() {

    var indicators = document.getElementsByClassName('js-calculator-step');

    for (var z = 0; z < indicators.length; z++) {
        indicators[z].classList.remove('finish');
        indicators[z].classList.remove('active');
    }

    if (currentFormId == 'bmicalc-form') { // BMI
        document.getElementById('bmicalc-form').reset();
        document.getElementById('js-bmi-result').innerHTML = '';
        document.getElementById('js-bmi-novalue').style.display = 'block';
        var allBmiResluts = document.getElementsByClassName('bmi-results');
        for (var b = 0; b < allBmiResluts.length; b++) {
            allBmiResluts[b].style.display = 'none';
        }
        document.getElementById('bmi-resetcontainer').style.display = 'none';
    } else if (currentFormId == 'nrscalc-form') { // NRS-2002
        document.getElementById('nrscalc-form').reset();
        document.getElementById('js-nrs-result').innerHTML = '';
        document.getElementById('nrs-alternative-result').style.display = 'none';
        var allNrsResluts = document.getElementsByClassName('nrs-results');
        for (var n = 0; n < allNrsResluts.length; n++) {
            allNrsResluts[n].style.display = 'none';
            document.getElementById('nrs-alternative-result').style.display = 'none';
        }
    } else if (currentFormId == 'mnacalc-form') { // MNA Calculator
        document.getElementById('mnacalc-form').reset();
        document.getElementById('js-mna-result').innerHTML = '';
        var allMnaResluts = document.getElementsByClassName('mna-results');
        for (var m = 0; m < allMnaResluts.length; m++) {
            allMnaResluts[m].style.display = 'none';
        }
    } else if (currentFormId == 'harrisbenedict-form') { // Harris Benedict Calculator
        document.getElementById('harrisbenedict-form').reset();
        document.getElementById('js-hr-result').innerHTML = '';
    } else if (currentFormId == 'pocketformula-form') { // Pocket Formula
        document.getElementById('pocketformula-form').reset();
        document.getElementById('js-pf-result-1').innerHTML = '';
        document.getElementById('js-pf-result-2').innerHTML = '';
    }

    if (currentFormId == 'nrscalc-form' || currentFormId == 'mnacalc-form') {
        currentTab = 0;
        showTab(currentTab);
        document.getElementById('js-results').style.display = 'none';
    } else if (currentFormId == 'harrisbenedict-form') {
        currentTab = 0;
        showTab(currentTab);
        document.getElementById('js-results').style.display = 'none';
    } else if (currentFormId == 'pocketformula-form') {
        currentTab = 0;
        showTab(currentTab);
        document.getElementById('js-results').style.display = 'none';
    }
}

// Tabs
function openTab(evt, tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
