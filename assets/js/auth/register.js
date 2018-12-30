(function($){
	$("#loginForm").submit(function(event){

		$('#WarningModalhdbgcl').modal('show');

		function hide_components(key)
		{
			if(key == 0)
			{
				$('#WarningModalhdbgcl').modal('hide');
			}
			
			$("#first_name").attr('class', 'form-group col-lg-12');
			$("#first_name > span").css("display", "none");
			$("#last_name").attr('class', 'form-group col-lg-12');
			$("#last_name > span").css("display", "none");
			$("#username").attr('class', 'form-group col-lg-12');
			$("#username > span").css("display", "none");
			$("#email").attr('class', 'form-group col-lg-12');
			$("#email > span").css("display", "none");
			$("#container_password").attr('class', 'form-group col-lg-12');
			$("#password > span").css("display", "none");
			$("#confirm_password > span").css("display", "none");
			$("#google-recaptcha > span").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		$.ajax({
			'url': 'validate_create',
			'type': 'POST',
			'data': $(this).serialize(),
			success: function(data)
			{
				hide_components(1);
				var json = JSON.parse(data);
				$(location).attr('href',json.url);
			},
			statusCode: 
			{
				400: function(xhr)
				{
					hide_components(0);

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
					if(user.password.length != 0)
					{
						$("#container_password").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#password > span").html(user.password).removeAttr("style");
					}
					if(user.confirm_password.length != 0)
					{
						$("#container_password").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#confirm_password > span").html(user.confirm_password).removeAttr("style");
					}
				},
				401: function(xhr)
				{
					hide_components(0);

					var user = JSON.parse(xhr.responseText);
					
					if(user.msj.length != 0)
					{
						$("#error").
							html(
								'<div class="alert alert-danger" role="alert"><button id="button-error" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span>'+ user.msj +'</span></div>'
							);

						$("#google-recaptcha").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#google-recaptcha > span").html(user.msj).removeAttr("style");
						$("#google-recaptcha > span").css("color", "red");
					}
				},
			} 
		});
	});
})(jQuery)