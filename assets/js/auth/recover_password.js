(function($){
	$("#loginForm").submit(function(event){

		$('#WarningModalhdbgcl').modal('show');

		function hide_components(key)
		{

			if(key == 0)
			{
				$('#WarningModalhdbgcl').modal('hide');
			}

			$("#password").attr('class', 'form-group col-lg-12');
			$("#password > span").css("display", "none");
			$("#confirm_password").attr('class', 'form-group col-lg-12');
			$("#confirm_password > span").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		$.ajax({
			'url': '/appCodeIgniter/auth/validate_recover_password',
			'type': 'POST',
			'data': $(this).serialize(),
			success: function(data)
			{
				hide_components(1);
				var json = JSON.parse(data);
				window.location.replace(json.url);
			},
			statusCode: 
			{
				409: function(xhr)
				{
					hide_components(0);

					var json = JSON.parse(xhr.responseText);

					if(json.key == 1)
					{
						if(json.password.length != 0)
						{
							$("#password").attr('class', 'form-group-inner input-with-error col-lg-12');
							$("#password > span").html(json.password).removeAttr("style");
						}
						if(json.confirm_password.length != 0)
						{
							$("#confirm_password").attr('class', 'form-group-inner input-with-error col-lg-12');
							$("#confirm_password > span").html(json.confirm_password).removeAttr("style");
						}
					}

					if(json.key == 2)
					{
						$("#error").
							html(
								'<div class="alert alert-danger" role="alert"><button id="button-error" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span>'+ json.msj +'</span></div>'
							);
					}
				}
			} 
		});
	});
})(jQuery)