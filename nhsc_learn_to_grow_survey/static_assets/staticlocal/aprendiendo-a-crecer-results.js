jQuery(document).ready(function () {
    var wsize = screen.width;
    var hsize = screen.height;
    var wsize = Math.min(screen.width, screen.height);
    if (wsize > 800) {
        wsize = 800;
    }
    var Results = JSON.parse(unescape(DOMPurify.sanitize(nhs_getCookie("questionnaire-results"))));
    var deficienciesList = "";
    if (Results.Deficiencies.length == 1) {
        deficienciesList = Results.Deficiencies[0];
    } else if (Results.Deficiencies.length > 1) {
        deficienciesList = Results.Deficiencies.slice(0, Results.Deficiencies.length - 1).join(', ') + " y " + Results.Deficiencies.slice(-1);
    }
    if (deficienciesList == "") {
        jQuery('.recommendations-info-text-3').html("Parece que " + Results.GeneralInfo.Name + " no tiene deficiencias.");
    } else {
        jQuery('.recommendations-info-text-3').html("Parece que " + Results.GeneralInfo.Name + " no toma suficiente cantidad de " + deficienciesList + ".");
    }
    var score = 0;
    if (126 >= Results.Scores.OverallScore && Results.Scores.OverallScore > 84) {
        score = 1;
    } else if (84 >= Results.Scores.OverallScore && Results.Scores.OverallScore > 67) {
        score = 2;
    } else if (67 >= Results.Scores.OverallScore && Results.Scores.OverallScore > 50) {
        score = 3;
    } else if (Results.Scores.OverallScore < 50) {
        score = 4;
    }
    jQuery('.recommendations-pillar .pillar-img').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/recommendations/Jenga-Results-" + score + ".png");
    jQuery('.name-of-child').html(Results.GeneralInfo.Name);
    jQuery('.recommendations-block.lactose').find('.range').html((14 - Results.Scores.LactoseScore) + "-" + (28 - Results.Scores.LactoseScore));
    jQuery('.recommendations-block.protein').find('.range').html(14 - Results.Scores.ProteinScore);
    jQuery('.recommendations-block.vegetables').find('.range').html((14 - Results.Scores.VegetablesScore) + "-" + (21 - Results.Scores.VegetablesScore));
    jQuery('.recommendations-block.fruits').find('.range').html((14 - Results.Scores.FruitsScore) + "-" + (21 - Results.Scores.FruitsScore));
    jQuery('.recommendations-block.cereal').find('.range').html((28 - Results.Scores.CerealScore) + "-" + (42 - Results.Scores.CerealScore));
    if (28 >= Results.Scores.LactoseScore && Results.Scores.LactoseScore >= 14) {
        jQuery('.recommendations-block.lactose').find('.main-body').css("display", "none");
        jQuery('.recommendations-block.lactose').find('.alt-body').css("display", "block");
    }
    if (20 >= Results.Scores.ProteinScore && Results.Scores.ProteinScore >= 14) {
        jQuery('.recommendations-block.protein').find('.main-body').css("display", "none");
        jQuery('.recommendations-block.protein').find('.alt-body').css("display", "block");
    }
    if (Results.Scores.VegetablesScore >= 14) {
        jQuery('.recommendations-block.vegetables').find('.main-body').css("display", "none");
        jQuery('.recommendations-block.vegetables').find('.alt-body').css("display", "block");
    }
    if (Results.Scores.FruitsScore >= 21 || (Results.Scores.FruitsScore > 14 && (Results.Scores.FruitsScore + Results.Scores.VegetablesScore) >= 35)) {
        jQuery('.recommendations-block.fruits').find('.main-body').css("display", "none");
        jQuery('.recommendations-block.fruits').find('.alt-body').css("display", "block");
    }
    if (42 >= Results.Scores.CerealScore && Results.Scores.CerealScore >= 28) {
        jQuery('.recommendations-block.cereal').find('.main-body').css("display", "none");
        jQuery('.recommendations-block.cereal').find('.alt-body').css("display", "block");
    }
    jQuery('.recommendations-block.lactose .learn-more').click(function (event) {
        event.preventDefault();
        $.fancybox.open([{content: getLactoseTipsContent()}], {
            wrapCSS: 'nhs-fancybox',
            padding: 0,
            margin: 0,
            scrolling: 'yes',
            closeBtn: false,
            minHeight: 200,
            modal: false
        });
    });
    jQuery('.recommendations-block.protein .learn-more').click(function (event) {
        event.preventDefault();
        $.fancybox.open([{content: getProteinTipsContent()}], {
            wrapCSS: 'nhs-fancybox',
            padding: 0,
            margin: 0,
            scrolling: 'yes',
            closeBtn: false,
            minHeight: 200,
            modal: false
        });
    });
    jQuery('.recommendations-block.vegetables .learn-more').click(function (event) {
        event.preventDefault();
        $.fancybox.open([{content: getVegetablesTipsContent()}], {
            wrapCSS: 'nhs-fancybox',
            padding: 0,
            margin: 0,
            scrolling: 'yes',
            closeBtn: false,
            minHeight: 200,
            modal: false
        });
    });
    jQuery('.recommendations-block.fruits .learn-more').click(function (event) {
        event.preventDefault();
        $.fancybox.open([{content: getFruitsTipsContent()}], {
            wrapCSS: 'nhs-fancybox',
            padding: 0,
            margin: 0,
            scrolling: 'yes',
            closeBtn: false,
            minHeight: 200,
            modal: false
        });
    });
    jQuery('.recommendations-block.cereal .learn-more').click(function (event) {
        event.preventDefault();
        $.fancybox.open([{content: getCerealTipsContent()}], {
            wrapCSS: 'nhs-fancybox',
            padding: 0,
            margin: 0,
            scrolling: 'yes',
            closeBtn: false,
            minHeight: 200,
            modal: false
        });
    });
    jQuery(document).on("click", ".tips-close-button .close-button", function (event) {
        event.preventDefault();
        $.fancybox.close();
        return false;
    });

    function getLactoseTipsContent() {
        var _content = '';
        _content += '<div class="tips-outer-container" style="width:' + wsize + 'px;">';
        _content += '<div class="tips-inner-container">';
        _content += '<div class="tips-close-button">';
        _content += '<a class="close-button" href="#">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/close-button.png">';
        _content += '</a>';
        _content += '</div>';
        _content += '<div class="header">';
        _content += '<p class="title"><span class="bold-text">??Consejos para lograrlo!</span></p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/lactose-tip-1.png">';
        _content += '<p class="tip-text"><span class="bold-text">Asegurar la leche en el desayuno en casa, en la merienda, en el postre o incluso antes de ir a dormir</span>. Estos 3 momentos del d??a deber??an facilitarle tomar las 3 raciones diarias que necesita.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/lactose-tip-2.png">';
        _content += '<p class="tip-text">Si el ni??o rechaza la leche l??quida, ofr??cele como <span class="bold-text">alternativas yogur, queso fresco u otros quesos no grasos</span>. Es preferible ampliar las opciones a intentar forzarle a tomar un alimento en concreto.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/lactose-tip-3.png">';
        _content += '<p class="tip-text"><span class="bold-text">Busca formas de incluir los l??cteos en las recetas diarias</span>: batidos caseros, salsas de yogur para condimentar las ensaladas, platos en los que se incluya el queso o la leche como ingrediente, quesos untables (con especias o hierbas) en el bocadillo???</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/lactose-tip-4.png">';
        _content += '<p class="tip-text"><span class="bold-text">Las natillas, cremas o helados no pueden considerarse l??cteos</span> porque aportan mucha cantidad de az??car y grasas que empobrecen su calidad nutricional. Deben ser solo de <span class="bold-text">consumo ocasional</span>.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/lactose-tip-5.png">';
        _content += '<p class="tip-text">Si no toleran bien la leche de vaca, existen <span class="bold-text">m??ltiples opciones de leche sin lactosa en el mercado, o bien de leche de otras fuentes</span> (como la leche de cabra o de oveja) que pueden resultar m??s f??ciles de digerir.</p>';
        _content += '</div>';
        _content += '<div class="blue-section">';
        _content += '<div class="inner">';
        _content += '<p class="info"><span class="bold-text">Meritene Junior</span> contiene 210 mg de Calcio, 6 g de Prote??na de alta calidad biol??gica procedente de la leche, 4,2 mcg de Vitamina D, 180 mg de F??sforo y 4,6 mg de Hierro en cada porci??n.</p>';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/pillar/blue-circle-glass.png">';
        _content += '<p class="img-description">Disuelto en un vaso de leche, ??Meritene Junior ayudar?? a ' + Results.GeneralInfo.Name + ' a desarrollarse correctamente mientras aprende a comer bien!</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<div class="other-tips hidden">';
        _content += '<p class="title">Adem??s te ofrecemos los siguientes tips y consejos</p>';
        _content += '<div class="tip-blocks">';
        _content += '<div class="block">';
        _content += '<a href="#" class="alimentacion">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-1.png">';
        _content += '</a>';
        _content += '<p class="img-description"><span class="bold-text">Deporte y actividad f??sica</span> en los ni??os: algunos consejos.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="#" class="deporte">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-2.png">';
        _content += '</a>';
        _content += '<p class="img-description">Qu?? hacer <span class="bold-text">cuando no se quieren acabar el plato</span>.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips/obesidad">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-3.png">';
        _content += '</a>';
        _content += '<p class="img-description">Los h??bitos saludables en los ni??os.</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips-y-consejos" class="learn-more"><span class="bold-text">Ver todos los tips y consejos &gt;</span></a>';
        _content += '</div>';
        _content += '</div>';
        _content += '</div>';
        return _content;
    }

    function getProteinTipsContent() {
        var _content = '';
        _content += '<div class="tips-outer-container" style="width:' + wsize + 'px;">';
        _content += '<div class="tips-inner-container">';
        _content += '<div class="tips-close-button">';
        _content += '<a class="close-button" href="#">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/close-button.png">';
        _content += '</a>';
        _content += '</div>';
        _content += '<div class="header">';
        _content += '<p class="title"><span class="bold-text">??Consejos para lograrlo!</span></p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Proteinas_1.png">';
        _content += '<p class="tip-text"><span class="bold-text">Priorizar el consumo de pescado sobre el de carne</span>. Si el ni??o/a no acepta el pescado con facilidad, prueba con otras formas de preparaci??n: hamburguesas, varitas o pescado en salsa pueden ser buenas opciones. Tambi??n puedes a??adirlo en pur??s y sopas.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Proteinas_2.png">';
        _content += '<p class="tip-text"><span class="bold-text">P??nselo f??cil si le cuesta masticar</span> debido a ortodoncias u otros problemas bucales, o bien si tu hijo es de los que la carne se le hace bola. En su caso, las hamburguesas de carne magra, alb??ndigas, croquetas, jam??n o pavo cocido en lonchas finas, etc pueden ser buenas opciones.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Proteinas_3.png">';
        _content += '<p class="tip-text">Una forma de obtener prote??nas de origen vegetal es a trav??s de los frutos secos. Los puedes a??adir triturados en los pur??s, en el yogur o en una tarta casera</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Proteinas_4.png">';
        _content += '<p class="tip-text"><span class="bold-text">Si su problema son las legumbres</span>, puedes optar por prepararlas en forma de pur??, hamburguesas o pat??s (hummus).</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Proteinas_5.png">';
        _content += '<p class="tip-text"><span class="bold-text">Evita las frituras y las salsas</span>. Aunque pueden hacer m??s apetecibles las carnes y los pescados, no son la opci??n m??s recomendable. Opta mejor por las preparaciones a la plancha, asados, al horno, al microondas o con salsas no grasas.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Proteinas_6.png">';
        _content += '<p class="tip-text"><span class="bold-text">Evita los derivados de carne procesada y/o ahumada</span>, como las salchichas de frankfurt o embutidos, que solo deben consumirse ocasionalmente. El exceso de grasa reduce la calidad nutricional de estos alimentos.</p>';
        _content += '</div>';
        _content += '<div class="blue-section">';
        _content += '<div class="inner">';
        _content += '<p class="info"><span class="bold-text">Meritene Junior</span> contiene 210 mg de Calcio, 6 g de Prote??na de alta calidad biol??gica procedente de la leche, 4,2 mcg de Vitamina D, 180 mg de F??sforo y 4,6 mg de Hierro en cada porci??n.</p>';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/pillar/blue-circle-glass.png">';
        _content += '<p class="img-description">Disuelto en un vaso de leche, ??Meritene Junior ayudar?? a ' + Results.GeneralInfo.Name + ' a desarrollarse correctamente mientras aprende a comer bien!</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<div class="other-tips hidden">';
        _content += '<p class="title">Adem??s te ofrecemos los siguientes tips y consejos</p>';
        _content += '<div class="tip-blocks">';
        _content += '<div class="block">';
        _content += '<a href="#" class="alimentacion">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-1.png">';
        _content += '</a>';
        _content += '<p class="img-description"><span class="bold-text">Deporte y actividad f??sica</span> en los ni??os: algunos consejos.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="#" class="deporte">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-2.png">';
        _content += '</a>';
        _content += '<p class="img-description">Qu?? hacer <span class="bold-text">cuando no se quieren acabar el plato</span>.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips/obesidad">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-3.png">';
        _content += '</a>';
        _content += '<p class="img-description">Los h??bitos saludables en los ni??os.</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips-y-consejos" class="learn-more"><span class="bold-text">Ver todos los tips y consejos &gt;</span></a>';
        _content += '</div>';
        _content += '</div>';
        _content += '</div>';
        return _content;
    }

    function getVegetablesTipsContent() {
        var _content = '';
        _content += '<div class="tips-outer-container" style="width:' + wsize + 'px;">';
        _content += '<div class="tips-inner-container">';
        _content += '<div class="tips-close-button">';
        _content += '<a class="close-button" href="#">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/close-button.png">';
        _content += '</a>';
        _content += '</div>';
        _content += '<div class="header">';
        _content += '<p class="title"><span class="bold-text">??Consejos para lograrlo!</span></p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_1.png">';
        _content += '<p class="tip-text"><span class="bold-text">Incorpora verduras y hortalizas a las comidas que le gustan</span>. Por ejemplo: lasa??a de verduras, croquetas de espinacas, hamburguesas o alb??ndigas con calabaza picada, crema de br??coli, tortilla de calabac??n, bocadillos que incluyan tomate y lechuga, etc.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_2.png">';
        _content += '<p class="tip-text"><span class="bold-text">Incluye hortalizas, verduras o ensaladas como guarnici??n de todos los platos</span>. De este modo, evitar??s que otros alimentos desplacen a los vegetales y favorecer??s que los ni??os los coman de forma espont??nea.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_3.png">';
        _content += '<p class="tip-text"><span class="bold-text">Prueba variedades de verdura con diferentes formas de preparaci??n</span> para que los ni??os puedan encontrar la que les guste m??s.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_4.png">';
        _content += '<p class="tip-text"><span class="bold-text">Introduce en su alimentaci??n las verduras de una a una</span>, en lugar de mezclar varias. As?? ser?? m??s f??cil que pruebe y acepte los nuevos sabores y texturas.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_5.png">';
        _content += '<p class="tip-text"><span class="bold-text">A??ade paulatinamente m??s verduras al men??</span>. Se acostumbrar??n a comerlas de forma habitual sin darse cuenta.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_6.png">';
        _content += '<p class="tip-text"><span class="bold-text">Los platos divertidos son m??s f??ciles de comer</span>. Utiliza las verduras, hortalizas y ensaladas para conseguir platos coloridos, con dibujos o mensajes que les sorprendan.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Verduras_7.png">';
        _content += '<p class="tip-text"><span class="bold-text">Recuerda que el esfuerzo y ejemplo de toda la familia es fundamental</span>. para educar el paladar de los m??s peque??os.</p>';
        _content += '</div>';
        _content += '<div class="blue-section">';
        _content += '<div class="inner">';
        _content += '<p class="info"><span class="bold-text">Meritene Junior</span> contiene 210 mg de Calcio, 6 g de Prote??na de alta calidad biol??gica procedente de la leche, 4,2 mcg de Vitamina D, 180 mg de F??sforo y 4,6 mg de Hierro en cada porci??n.</p>';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/pillar/blue-circle-glass.png">';
        _content += '<p class="img-description">Disuelto en un vaso de leche, ??Meritene Junior ayudar?? a ' + Results.GeneralInfo.Name + ' a desarrollarse correctamente mientras aprende a comer bien!</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<div class="other-tips hidden">';
        _content += '<p class="title">Adem??s te ofrecemos los siguientes tips y consejos</p>';
        _content += '<div class="tip-blocks">';
        _content += '<div class="block">';
        _content += '<a href="#" class="alimentacion">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-1.png">';
        _content += '</a>';
        _content += '<p class="img-description"><span class="bold-text">Deporte y actividad f??sica</span> en los ni??os: algunos consejos.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="#" class="deporte">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-2.png">';
        _content += '</a>';
        _content += '<p class="img-description">Qu?? hacer <span class="bold-text">cuando no se quieren acabar el plato</span>.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips/obesidad">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-3.png">';
        _content += '</a>';
        _content += '<p class="img-description">Los h??bitos saludables en los ni??os.</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips-y-consejos" class="learn-more"><span class="bold-text">Ver todos los tips y consejos &gt;</span></a>';
        _content += '</div>';
        _content += '</div>';
        _content += '</div>';
        return _content;
    }

    function getFruitsTipsContent() {
        var _content = '';
        _content += '<div class="tips-outer-container" style="width:' + wsize + 'px;">';
        _content += '<div class="tips-inner-container">';
        _content += '<div class="tips-close-button">';
        _content += '<a class="close-button" href="#">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/close-button.png">';
        _content += '</a>';
        _content += '</div>';
        _content += '<div class="header">';
        _content += '<p class="title"><span class="bold-text">??Consejos para lograrlo!</span></p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_1.png">';
        _content += '<p class="tip-text"><span class="bold-text">Tened un frutero con frutas variadas de varios colores bien visible en la cocina o comedor</span>. Si los ni??os se sienten atra??dos a probarlas por s?? mismos, ser?? m??s f??cil que las incorporen a sus h??bitos de alimentaci??n.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_2.png">';
        _content += '<p class="tip-text"><span class="bold-text">Incluye una fruta en cada comida principal</span>: desayuno, almuerzo y cena. Siempre debe ser la primera opci??n en el postre.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_3.png">';
        _content += '<p class="tip-text"><span class="bold-text">Incluye la fruta en diferentes platos</span>: en ensaladas, mezclada a trozos con el yogurt, triturada con leche (batido casero), congelada a modo de helado, etc.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_4.png">';
        _content += '<p class="tip-text"><span class="bold-text">Si no quiere la fruta despu??s de comer porque ya no tiene hambre, ofr??cela entre comidas</span>. Por ejemplo, puedes sustituir la media ma??ana o merienda habitual por una fruta, un batido de fruta fresca o una macedonia.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_5.png">';
        _content += '<p class="tip-text"><span class="bold-text">Escoge siempre frutas de temporada y que est??n en su punto de maduraci??n</span>. para favorecer que el ni??o/a las encuentre dulces y ricas.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_6.png">';
        _content += '<p class="tip-text"><span class="bold-text">Las compotas, mermeladas y zumos no deben utilizarse como sustitutivos</span>. y su consumo debe ser ocasional. Aunque est??n hechos a base de fruta, necesitan un procesado, contienen mucho az??car y pierden parte de las propiedades de la fruta fresca.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Frutas_7.png">';
        _content += '<p class="tip-text"><span class="bold-text">Recuerda que t?? eres el mejor modelo para tus hijos</span>. Si t?? comes frutas con frecuencia, ellos te imitar??n.</p>';
        _content += '</div>';
        _content += '<div class="blue-section">';
        _content += '<div class="inner">';
        _content += '<p class="info"><span class="bold-text">Meritene Junior</span> contiene 210 mg de Calcio, 6 g de Prote??na de alta calidad biol??gica procedente de la leche, 4,2 mcg de Vitamina D, 180 mg de F??sforo y 4,6 mg de Hierro en cada porci??n.</p>';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/pillar/blue-circle-glass.png">';
        _content += '<p class="img-description">Disuelto en un vaso de leche, ??Meritene Junior ayudar?? a ' + Results.GeneralInfo.Name + ' a desarrollarse correctamente mientras aprende a comer bien!</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<div class="other-tips hidden">';
        _content += '<p class="title">Adem??s te ofrecemos los siguientes tips y consejos</p>';
        _content += '<div class="tip-blocks">';
        _content += '<div class="block">';
        _content += '<a href="#" class="alimentacion">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-1.png">';
        _content += '</a>';
        _content += '<p class="img-description"><span class="bold-text">Deporte y actividad f??sica</span> en los ni??os: algunos consejos.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="#" class="deporte">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-2.png">';
        _content += '</a>';
        _content += '<p class="img-description">Qu?? hacer <span class="bold-text">cuando no se quieren acabar el plato</span>.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips/obesidad">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-3.png">';
        _content += '</a>';
        _content += '<p class="img-description">Los h??bitos saludables en los ni??os.</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips-y-consejos" class="learn-more"><span class="bold-text">Ver todos los tips y consejos &gt;</span></a>';
        _content += '</div>';
        _content += '</div>';
        _content += '</div>';
        return _content;
    }

    function getCerealTipsContent() {
        var _content = '';
        _content += '<div class="tips-outer-container" style="width:' + wsize + 'px;">';
        _content += '<div class="tips-inner-container">';
        _content += '<div class="tips-close-button">';
        _content += '<a class="close-button" href="#">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/close-button.png">';
        _content += '</a>';
        _content += '</div>';
        _content += '<div class="header">';
        _content += '<p class="title"><span class="bold-text">??Consejos para lograrlo!</span></p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Cereales_1.png">';
        _content += '<p class="tip-text"><span class="bold-text">Adapta las raciones a las necesidades del ni??o o ni??a</span>. De lo contrario, estaremos exigi??ndole que coma m??s de lo que necesita y posiblemente dejar?? parte de la comida en el plato.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Cereales_2.png">';
        _content += '<p class="tip-text"><span class="bold-text">Aumenta la variedad de cereales y f??culas que se consumen en casa</span>. De esta forma, los m??s peque??os se habituar??n a diferentes sabores y texturas, encontrar??n variedad que impedir?? que se aburran en las comidas y podr??n beneficiarse de todos los nutrientes que pueden aportar estos alimentos.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Cereales_3.png">';
        _content += '<p class="tip-text"><span class="bold-text">Opta preferentemente por cereales y derivados integrales</span>.</p>';
        _content += '</div>';
        _content += '<div class="tip-wrapper">';
        _content += '<img class="tip-image" src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/Cereales_4.png">';
        _content += '<p class="tip-text"><span class="bold-text">Los bollos, galletas azucaradas y snacks salados no deben formar parte de la alimentaci??n habitual</span>. Aunque est??n hechos a base de cereales y f??culas, el proceso al que se los somete y los ingredientes a??adidos, como la sal y las grasas, reducen su valor nutricional.</p>';
        _content += '</div>';
        _content += '<div class="blue-section">';
        _content += '<div class="inner">';
        _content += '<p class="info"><span class="bold-text">Meritene Junior</span> contiene 210 mg de Calcio, 6 g de Prote??na de alta calidad biol??gica procedente de la leche, 4,2 mcg de Vitamina D, 180 mg de F??sforo y 4,6 mg de Hierro en cada porci??n.</p>';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/pillar/blue-circle-glass.png">';
        _content += '<p class="img-description">Disuelto en un vaso de leche, ??Meritene Junior ayudar?? a ' + Results.GeneralInfo.Name + ' a desarrollarse correctamente mientras aprende a comer bien!</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<div class="other-tips hidden">';
        _content += '<p class="title">Adem??s te ofrecemos los siguientes tips y consejos</p>';
        _content += '<div class="tip-blocks">';
        _content += '<div class="block">';
        _content += '<a href="#" class="alimentacion">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-1.png">';
        _content += '</a>';
        _content += '<p class="img-description"><span class="bold-text">Deporte y actividad f??sica</span> en los ni??os: algunos consejos.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="#" class="deporte">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-2.png">';
        _content += '</a>';
        _content += '<p class="img-description">Qu?? hacer <span class="bold-text">cuando no se quieren acabar el plato</span>.</p>';
        _content += '</div>';
        _content += '<div class="block">';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips/obesidad">';
        _content += '<img src="/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/tips/other-tip-3.png">';
        _content += '</a>';
        _content += '<p class="img-description">Los h??bitos saludables en los ni??os.</p>';
        _content += '</div>';
        _content += '</div>';
        _content += '<a href="/aprendiendo-a-crecer/Pages/tips-y-consejos" class="learn-more"><span class="bold-text">Ver todos los tips y consejos &gt;</span></a>';
        _content += '</div>';
        _content += '</div>';
        _content += '</div>';
        return _content;
    }

    jQuery(document).on("click", ".block .alimentacion", function (event) {
        var Results = JSON.parse(unescape(nhs_getCookie("questionnaire-results")));
        event.preventDefault();
        if (Results.GeneralInfo.AgeGroup == "3-6") {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/alimentacion-3-6';
        } else {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/alimentacion-7-12';
        }
    });
    jQuery(document).on("click", ".block .deporte", function (event) {
        var Results = JSON.parse(unescape(nhs_getCookie("questionnaire-results")));
        event.preventDefault();
        if (Results.GeneralInfo.AgeGroup == "3-6") {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/deporte-3-6';
        } else {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/deporte-7-12';
        }
    });
});