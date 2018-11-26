function modify(id)
{
	$('#WarningModalhdbgcl').modal('show');

	id_user = id;

	(function($){
		$.ajax({
			'url': '../users/find/'+ id_user,
			'type': 'GET',
			'data': null,
			success: function(data)
			{
				var json = JSON.parse(data);

				if(json.id.length != 0)
				{
					$("#id_user > input").attr('value', json.id);
				}
				if(json.first_name.length != 0)
				{
					$("#first_name > input").attr('value', json.first_name);
				}
				if(json.last_name.length != 0)
				{
					$("#last_name > input").attr('value', json.last_name);
				}
				if(json.username.length != 0)
				{
					$("#username > input").attr('value', json.username);
				}
				if(json.email.length != 0)
				{
					$("#email > input").attr('value', json.email);
				}
				if(json.type.length != 0)
				{
					if(json.type == 0)
					{
						$("#type").html('<label for="type">Tipo Usuario</label><div class="chosen-select-single mg-b-20"><select name="type" class="form-control" tabindex="-1"><option value="0" selected>Usuario</option><option value="5">Administrador</option></select></div>');
					}
					else
					{
						$("#type").html('<label for="type">Tipo Usuario</label><div class="chosen-select-single mg-b-20"><select name="type" class="form-control" tabindex="-1"><option value="0">Usuario</option><option value="5" selected>Administrador</option></select></div>');
					}
				}
				if(json.state.length != 0)
				{
					if(json.state == 0)
					{
						$("#state").html('<label for="state">Estado</label><div class="chosen-select-single mg-b-20"><select name="state" class="form-control" tabindex="-1"><option value="0" selected>Inactivo</option><option value="1">Activo</option></select></div>');
					}
					else
					{
						$("#state").html('<label for="state">Estado</label><div class="chosen-select-single mg-b-20"><select name="state" class="form-control" tabindex="-1"><option value="0">Inactivo</option><option value="1" selected>Activo</option></select></div>');
					}
				}
			},
			statusCode: 
			{
				401: function(xhr)
				{
					var json = JSON.parse(data);
					console.log(json.msj);
				},
			} 
		});
	})(jQuery)
}

(function($){
	$("#loginFormEdit").submit(function(event){
		
		function hide_components()
		{
			$("#first_name").attr('class', 'form-group col-lg-12');
			$("#first_name > span").css("display", "none");
			$("#last_name").attr('class', 'form-group col-lg-12');
			$("#last_name > span").css("display", "none");
			$("#username").attr('class', 'form-group col-lg-12');
			$("#username > span").css("display", "none");
			$("#email").attr('class', 'form-group col-lg-12');
			$("#email > span").css("display", "none");
			$("#container_type_state").attr('class', 'form-group col-lg-12');
			$("#type > span").css("display", "none");
			$("#state > span").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		$.ajax({
			'url': '../users/edit',
			'type': 'POST',
			'data': $(this).serialize(),
			success: function(data)
			{
				hide_components();
				var json = JSON.parse(data);
				window.location.replace(json.url);
			},
			statusCode: 
			{
				400: function(xhr)
				{
					hide_components();

					var user = JSON.parse(xhr.responseText);

					if(user.first_name.length != 0)
					{
						$("#first_name").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#first_name > span").html(user.first_name).removeAttr("style");
					}
					if(user.last_name.length != 0)
					{
						$("#last_name").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#last_name > span").html(user.last_name).removeAttr("style");
					}
					if(user.username.length != 0)
					{
						$("#username").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#username > span").html(user.username).removeAttr("style");
					}
					if(user.email.length != 0)
					{
						$("#email").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#email > span").html(user.email).removeAttr("style");
					}
					if(user.type_user.length != 0)
					{
						$("#type").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#type > span").html(user.type_user).removeAttr("style");
					}
					if(user.state.length != 0)
					{
						$("#state").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#state > span").html(user.state).removeAttr("style");
					}
				},
				401: function(xhr)
				{
					hide_components();

					var user = JSON.parse(xhr.responseText);
					
					if(user.msj.length != 0)
					{
						$("#error").
							html(
								'<div class="alert alert-danger" role="alert"><button id="button-error" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span>'+ user.msj +'</span></div>'
							);
					}
				},
			} 
		})
	});
})(jQuery)

function delete_user(id)
{
	$('#DangerModalhdbgcl').modal('show');

	id_user = id;

	(function($){
		$("#loginFormDelete").submit(function(event){
			event.preventDefault();
			$.ajax({
				'url': '../users/delete/'+ id_user,
				'type': 'GET',
				'data': null,
				success: function(data)
				{
					var json = JSON.parse(data);
					window.location.replace(json.url);
				},
				statusCode: 
				{
					401: function(xhr)
					{
						var user = JSON.parse(xhr.responseText);
						window.location.replace(json.url);
					},
				} 
			})
		});
	})(jQuery)
}





