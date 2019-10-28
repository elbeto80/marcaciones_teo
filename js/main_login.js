(function($){

})(jQuery);


	function validar_login_usr() {
		$("#info_div").html('');
		var usuario = $("#usuario").val();
		var clave = $("#clave").val();

		var parametros = {"usuario":usuario,"clave":clave};
			$.ajax({
				data: parametros,
				url: './subs/login/validar_login_usr.php',
				type: 'post',
				beforesend: function(){
					$("#info_div").html('Cargando... <img src="./images/loader1.gif">');
				},
				success: function(data){
					if($.trim(data)=="ok"){
						$("#info_div").html('Cargando... <img src="./images/loader1.gif">');
						setTimeout(function(){
							location.href = "panel.php";
						}, 1000);
					} else {
						$("#info_div").html(data);
						 $("#usuario").focus();
					}
				},
				error: function(jqXHR,estado,error){
					$("#info_div").html("<p class=\"msg error\">"+error+"</p>");
				}
			});		
	}


	$('#usuario').keyup(function (e) {
	    if (e.keyCode === 13) {
	       $("#clave").focus();
	    }
  	});

	$('#clave').keyup(function (e) {
	    if (e.keyCode === 13) {
	       validar_login_usr();
	    }
  	});