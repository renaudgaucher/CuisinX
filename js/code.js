
$(document).ready(function(){
    $("#nouvel_ingredient").click(function(){
        console.log("coucou");
        $.post("scripts/add_ingredient.php",{},function(rep){
            $("#add_ingredient").append(rep);
            console.log(rep);
            event.preventDefault();
        })
    });
    $('.range').on('input', function() {
                    var $set = $(".range").val();
                    $("#disp_nb_personne").html("Nombre de personnes :  "+ $set );
    });
    $("#btn_create_ingredient").click(function(){
        
        var nvlIngredient = $("#create_ingredient").val();
        $.post("scripts/newIngredient.php",{nom_ingredient:nvlIngredient},function(rep){
            console.log(nvlIngredient);
        });
    });
});


