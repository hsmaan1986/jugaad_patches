
function calcIMC(weight,height){
	if (!isNaN(weight) && !isNaN(height)){
		height = height/100;
		return weight/(height*height)
	}
	return false;
}

function getErrorMessage(){
        var _content = '';
        _content += '<div class="ErrorMessage" style="width:'+wsize+'px;">';
        _content += '<div>'
        _content += '<p>Debe rellenar todos los campos</p>';
        _content += '<a href="#" class="button">ACEPTAR</a>'
		_content += '</div>';
        _content += '</div>';
		return _content; 
    }

var wsize=screen.width;
var hsize=screen.height;
var wsize = Math.min(screen.width,screen.height);
if (wsize > 400){wsize=400;}


$( "#imc-calc" ).click(function() {

	var weight = parseFloat($("#imc-peso").val());
	var height = parseFloat($("#imc-altura").val());
	var imcResult = calcIMC(weight,height);
	if (isNaN(weight) || isNaN(height)){
        $.fancybox.open([{ content: getErrorMessage() }], { wrapCSS: 'nhs-fancybox', padding: 0, margin: 0, scrolling: 'no', closeBtn: false, minHeight: 100, modal: false });
        $(document).on("click", ".ErrorMessage .button", function () {
        $.fancybox.close();
        return false;
        });
    }
    
	if(imcResult && imcResult>0){
		var status;
			switch(true) {
			
		    case (imcResult < 18.5):
		        status="Peso insuficiente";
		        break;
		    case (imcResult >=18.5 && imcResult < 25):
		        status="Normopeso";
		        break;
		    case (imcResult >=25 && imcResult < 30):
		        status="Sobrepeso";
		        break;
		    case (imcResult >=30 && imcResult < 35):
		        status="Obesidad grado I";
		        break;
		    case (imcResult >=35 && imcResult < 40):
		        status="Obesidad grado II";
		        break;
		    case (imcResult >=40):
		        status="Obesidad grado III";
		        break;
		    default:
		        status="Not available";
			}
		$("#imc-result").html("Para un peso de "+weight+" kilogramos y una talla de "+height+" metros, su IMC es: "+imcResult.toFixed(2)+". Usted se encuentra en el grupo: "+status+".");
		$("#imc-result-block").show();
	}
	
/*if(weight == undefined){
		       // $("#imc-nov") .show();
		           alert("fill all columns");
				    return false;
}*/
});



function calcKal(weight, height, age, gender){
	if (!isNaN(weight) && !isNaN(height) && !isNaN(age) && gender){
		if(gender=="hombre"){
			return 655 + ((9.56 * weight) + (1.85 * height)) - ((4.7 * age));
		}
		else{
			return 66.47 + ((13.75 * weight) + (5 * height)) - ((6.76 * age));
		}
	}
	return false;
}


$( "#kal-calc" ).click(function() {

	var weight = parseFloat($("#kal-peso").val());
	var height = parseFloat($("#kal-altura").val());
	var age = parseFloat($("#kal-anos").val());
	var gender = $('input[name=kal-sexo]:checked').val();

	var kalResult = calcKal(weight,height,age,gender);
	if(kalResult && kalResult>0){

		$("#kal-result").html("El valor es de: "+kalResult.toFixed(3)+" Kcal/d");
		$("#kal-result-block").show();
	}
});




$( "#kal-hombre" ).attr( "name", "kal-sexo" );
$( "#kal-mujer" ).attr( "name", "kal-sexo" );