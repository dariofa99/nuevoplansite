$(document).ready(function() {
	$(document).on('click keyup','.valorCreditoClass',function() {
		calcular();
		
	});
	var tot = $('#total');
	tot.val(0);
	if(tot.val()>0  && tot.val()<21){
		document.getElementById('enviar').removeAttribute("disabled","");
	} else {
			jAlert("Créditos seleccionados => " + tot.val() + " Créditos.","Preinscripción de créditos");
			document.getElementById('enviar').setAttribute("disabled","");
	}
function calcular() {
	$('input[type=checkbox]').on('change', function() {
	// Comprobar cuando cambia un checkbox
	
		for (var i=1;i<36;i++){
			$("#ch"+i).mouseenter(function(e){
				$("#tip1").css("left", e.pageX + 5);
				$("#tip1").css("top", e.pageY + 5);
				$("#tip1").css("display", "block");
			});
			$("#ch"+i).mouseleave(function(e){
				$("#tip1").css("display", "none");
			});
		}
	});
	var tot = $('#total');
	tot.val(0);
	$('.valorCreditoClass').each(function() {
		if($(this).hasClass('valorCreditoClass')) {
			  tot.val(($(this).is(':checked') ? parseFloat($(this).attr('valor-credito')) : 0) + parseFloat(tot.val()));  
		}
			
	});
		  
	if(tot.val()>0  && tot.val()<21){
		document.getElementById('enviar').removeAttribute("disabled","");
	} else {
			jAlert("Créditos seleccionados => " + tot.val() + " Créditos.","Preinscripción de créditos");
			document.getElementById('enviar').setAttribute("disabled","");
	}
			
	$("#tip1").text(tot.val());
	$('#cancelar').on('click', function() {
		location.reload();
	});
}
});

		
	
