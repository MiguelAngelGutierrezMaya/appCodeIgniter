(function($){
	$("#loginForm").submit(function(event){

		function hide_components(key)
		{
			$("#origin_place").attr('class', 'form-group col-lg-12');
			$("#origin_place > span").css("display", "none");
			$("#destination_place").attr('class', 'form-group col-lg-12');
			$("#destination_place > span").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		$.ajax({
			'url': '../transfers/validate_create',
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

					var json = JSON.parse(xhr.responseText);

					if(json.origin_place.length != 0)
					{
						$("#origin_place").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#origin_place > span").html(json.origin_place).removeAttr("style");
					}
					if(json.destination_place.length != 0)
					{
						$("#destination_place").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#destination_place > span").html(json.destination_place).removeAttr("style");
					}
				},
				401: function(xhr)
				{
					hide_components();

					var json = JSON.parse(xhr.responseText);
					
					if(json.msj.length != 0)
					{
						$("#error").
							html(
								'<div class="alert alert-danger" role="alert"><button id="button-error" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span>'+ json.msj +'</span></div>'
							);
					}
				},
			} 
		});
	});
})(jQuery)