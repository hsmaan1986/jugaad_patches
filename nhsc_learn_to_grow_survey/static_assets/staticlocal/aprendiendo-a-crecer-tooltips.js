jQuery(document).ready(function () {
    var TooltipTexts = {
        Milk: {"Text": "Una ración de leche equivale a un vaso (100-200 ml)."},
        Yogurt: {"Text": "Una ración de yogurt equivale a 2 vasitos comerciales (125 g cada uno) o 1 vaso de yogurt líquido."},
        Cheese: {"Text": "Una ración de queso equivale a una porción de igual tamaño que 2 dedos del niño (30-60 g)."},
        SourCream: {"Text": "Una ración de queso fresco equivale a una tarrina mediana (80-125 g)."},
        Meat: {"Text": "Una ración de carne equivale a un trozo del tamaño de la palma de la mano del niño (60-90 g)."},
        Sausage: {"Text": "Una ración de embutido magro equivale a la cantidad de trozos o lonchas que ocupan  el tamaño de la palma de la mano del niño (60-90 g)."},
        Fish: {"Text": "Una ración de pescado equivale a un trozo del tamaño de la palma de la mano del niño (70-120 g)."},
        Eggs: {"Text": "Una ración de huevo equivale a 1 huevo grande (tipo L o XL) o 2 pequeños (tipo S o M)."},
        Vegetables: {"Text": "Una ración de legumbres cocidas equivale a unas 10 cucharadas soperas."},
        Seafood: {"Text": "Una ración de marisco equivale la cantidad que cabe en la palma de la mano del niño (70-120 g)."},
        Nuts: {"Text": "Una ración de frutos secos equivale a un pequeño puñado o la cantidad que cabe en el hueco de la palma de la mano del niño (10-20 g)."},
        Salad: {"Text": "Una ración de ensalada equivale a la cantidad que llenaría las dos manos del niño si las pone formando un cuenco (100-150 g)."},
        RawVegetables: {"Text": "Una ración de hortalizas crudas equivale a una pieza entera la cantidad troceada que llenaría las dos manos del niño (100-150 g)."},
        BoiledVegetables: {"Text": "Una ración de verduras cocinadas equivale a medio plato mediano."},
        CookedVegetables: {"Text": "Una ración de hortalizas cocinadas equivale a medio plato mediano."},
        CreamedVegetables: {"Text": "Una ración de crema de verduras equivale a un plato o tazón."},
        PureeSoups: {"Text": "Una ración de puré o sopa de hortalizas y verduras equivale a un plato o tazón."},
        RedBerries: {"Text": "Una ración de fresas o frutos rojos equivale a un puñado."},
        FruitGroup1: {"Text": "Una ración de frutas de tamaño pequeño equivale a 2 o 3 piezas."},
        FruitGroup2: {"Text": "Una ración de frutas de tamaño mediano equivale a 1 pieza."},
        FruitGroup3: {"Text": "Una ración de melón, sandía, papaya o piña equivale a 1 tajada de 2 dedos de ancho."},
        PureeFruits: {"Text": "Una ración de compota, puré o fruta asada equivale a una pieza entera o una taza."},
        DriedFruits: {"Text": "Una ración de frutas desecadas equivale a la cantidad que ocupa la palma de la mano del niño."},
        FruitSmoothies: {"Text": "Una ración batido de frutas equivale a un vaso mediano."},
        Rice: {"Text": "Una ración de arroz hervido equivale a la cantidad que llenaría las dos manos del niño si las pone formando un cuenco."},
        Bread: {"Text": "Una ración de pan equivale a una rebanada de pan de barra de 3 dedos de ancho."},
        Pasta: {"Text": "Una ración de pasta cocinada equivale a la cantidad que llenaría las dos manos del niño si las pone formando un cuenco."},
        Potatoes: {"Text": "Una ración de tubérculos equivale a una pieza de tamaño mediano."},
        Cereal: {"Text": "Una ración de cereales inflados equivale a la cantidad que llenaría las dos manos del niño si las pone formando un cuenco."},
        Biscuits: {"Text": "Una ración de galletas equivale a la cantidad que ocupa la palma de la mano del niño."},
        OtherCereal: {"Text": "Una ración de otros cereales cocidos equivale a la cantidad que llenaría las dos manos del niño si las pone formando un cuenco."}
    }
    jQuery('.tooltip-button').each(function () {
        var id = jQuery(this).attr('id');
        jQuery(this).attr('name', TooltipTexts[id].Text);
    });
});