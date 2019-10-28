(function($){

})(jQuery);


	function logout_usr() {
		$.ajax({
				url: './subs/login/logout.php',
				type: 'post',
				success: function(data){
					location.href = "index.php";
				},
			});		
	}


	function usuarios_admin() {
		// var parametros = {};
		$.ajax({
			//data: parametros,
			url: './subs/usuarios/usarios_admin.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function crear_new_user(op, usr) {
		var parametros = {"op":op,"usr":usr};
		$.ajax({
			data: parametros,
			url: './subs/usuarios/crear_nuevo_usr.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function guardar_new_usr(op) {
		var usuario 		= $("#usuario").val();
		var clave 			= $("#clave").val();
		var clave_confir 	= $("#clave_confir").val();
		var role 			= $("input:radio[name=role]:checked").val()

		var parametros = {"usuario":usuario,"clave":clave,"clave_confir":clave_confir,"role":role,"op":op};
		$.ajax({
			data: parametros,
			url: './subs/usuarios/guarda_nuevo_usr.php',
			type: 'post',
			beforesend: function(){
				$("#info_usr").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				if($.trim(data)=="ok"){
					$("#info_usr").html("<b>Usuario Guardado</b><img src='./images/loader1.gif'>");
					setTimeout(function(){
						usuarios_admin();
					}, 1000);
				} else if($.trim(data)=="ac") {
					$("#info_usr").html("<b>Usuario Actualizado</b><img src='./images/loader1.gif'>");
					setTimeout(function(){
						usuarios_admin();
					}, 1000);
				}
				else {
					$("#info_usr").html(data);
				}
			},
			error: function(jqXHR,estado,error){
				$("#info_usr").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function enable_deseable_usr(op, usuario) {
		if(op == 1) {
			if(!confirm('Desea Activar al Usuario ' + usuario + "?")){return 0};
		} else {
			if(!confirm('Desea Bloquear al Usuario ' + usuario + "?")){return 0};
		}

		var parametros = {"op":op,"usuario":usuario};
		$.ajax({
			data: parametros,
			url: './subs/usuarios/activa_bloquea_usr.php',
			type: 'post',
			beforesend: function(){
				$("#info_usr").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				//$("#info_usr").html(data);
				if($.trim(data)=="1"){
					alert("Usuario Activado");
				} else  {
					alert("Usuario Bloqueado");
				}
				usuarios_admin();
			},
			error: function(jqXHR,estado,error){
				$("#info_usr").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function empleados_admin() {
		var op = $('input:checkbox[name=todos]:checked').val();
		var parametros = {"op":op};
		$.ajax({
			data: parametros,
			url: './subs/empleados/empleados_admin.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function ver_detalle_empleado(id,cc,name,op) {
		if(op == 'si') {
			var desde = $("#desde").val();
			var hasta = $("#hasta").val();

			if(hasta < desde) { alert("Fecha Final no puede ser Mayor a Inicial"); return 0; }

			if($.trim(desde)=='' || $.trim(hasta)==''){ alert("Fechas no pueden estar Vacias"); return 0; }

			var parametros = {"id":id,"cc":cc,"name":name,"op":op,"desde":desde,"hasta":hasta};
		} else { 
			var parametros = {"id":id,"cc":cc,"name":name,"op":op};
		}
		$.ajax({
			data: parametros,
			url: './subs/empleados/ver_detalle_empleado.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function marcaciones_admin() {
		// var parametros = {};
		$.ajax({
			//data: parametros,
			url: './subs/marcaciones/marcaciones_admin.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function descansos_admin() {
		// var parametros = {};
		$.ajax({
			//data: parametros,
			url: './subs/descansos/descansos_admin.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function filtra_marcaiones_days(op) {
		if(op == 'si') {
			var desde = $("#desde").val();
			var hasta = $("#hasta").val();

			if(hasta < desde) { alert("Fecha Final no puede ser Mayor a Inicial"); return 0; }

			if($.trim(desde)=='' || $.trim(hasta)==''){ alert("Fechas no pueden estar Vacias"); return 0; }

			var parametros = {"op":op,"desde":desde,"hasta":hasta};
		} else {
			var parametros = {};
		}
		$.ajax({
			data: parametros,
			url: './subs/marcaciones/marcaciones_admin.php',
			type: 'post',
			beforesend: function(){
				$("#principal").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				$("#principal").html(data);
			},
			error: function(jqXHR,estado,error){
				$("#principal").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}


	function enabale_diseable_empleado(op,userid,name) {
		if(op == 1) {
			if(!confirm('Desea Activar al Empleado ' + name + "?")){return 0};
		} else {
			if(!confirm('Desea Desactivar al Empleado ' + name + "?")){return 0};
		}

		var parametros = {"op":op,"userid":userid};
		$.ajax({
			data: parametros,
			url: './subs/empleados/activa_bloquea_empleado.php',
			type: 'post',
			beforesend: function(){
				$("#info_usr").html('Cargando... <img src="./images/loader1.gif">');
			},
			success: function(data){
				//$("#info_usr").html(data);
				if($.trim(data)=="1"){
					alert("Empleado Activado");
				} else  {
					alert("Empleado Desactivado");
				}
				empleados_admin();
			},
			error: function(jqXHR,estado,error){
				$("#info_usr").html("<p class=\"msg error\">"+error+"</p>");
			}
		});		
	}