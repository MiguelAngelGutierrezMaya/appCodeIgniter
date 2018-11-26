(function($){
	$("#loginForm").submit(function(event){

		$('#WarningModalhdbgcl').modal('show');

		function hide_components(key)
		{
			if(key == 0)
			{
				$('#WarningModalhdbgcl').modal('hide');
			}

			$("#quote_date").attr('class', 'form-group col-lg-12');
			$("#quote_date > span").css("display", "none");
			$("#type_quote").attr('class', 'form-group col-lg-12');
			$("#type_quote > span").css("display", "none");
			$("#state_quote").attr('class', 'form-group col-lg-12');
			$("#state_quote > span").css("display", "none");
			$("#description").attr('class', 'form-group col-lg-12');
			$("#description > span").css("display", "none");
			$("#container_password").attr('class', 'form-group col-lg-12');
			$("#password > span").css("display", "none");
			$("#id_user").css('class', 'form-group col-lg-12');
			$("#id_user > span").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		$.ajax({
			'url': '../quotes/store',
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
				400: function(xhr)
				{
					hide_components(0);

					var quote = JSON.parse(xhr.responseText);

					if(quote.quote_date.length != 0)
					{
						$("#quote_date").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#quote_date > span").html(quote.quote_date).removeAttr("style");
					}
					if(quote.type_quote.length != 0)
					{
						$("#type_quote").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#type_quote > span").html(quote.type_quote).removeAttr("style");
					}
					if(quote.state_quote.length != 0)
					{
						$("#state_quote").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#state_quote > span").html(quote.state_quote).removeAttr("style");
					}
					if(quote.description.length != 0)
					{
						$("#description").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#description > span").html(quote.description).removeAttr("style");
					}
					if(quote.password.length != 0)
					{
						$("#container_password").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#password > span").html(quote.password).removeAttr("style");
					}
					if(quote.confirm_password.length != 0)
					{
						$("#container_password").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#confirm_password > span").html(quote.confirm_password).removeAttr("style");
					}
					if(quote.id_user.length != 0)
					{
						$("#id_user").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#id_user > span").html(quote.id_user).removeAttr("style");
					}
				},
				401: function(xhr)
				{
					hide_components(0);

					var user = JSON.parse(xhr.responseText);
					
					if(quote.msj.length != 0)
					{
						$("#error").
							html(
								'<div class="alert alert-danger" role="alert"><button id="button-error" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span>'+ quote.msj +'</span></div>'
							);
					}
				},
			} 
		});
	});
})(jQuery)