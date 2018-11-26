(function($){
	$("#loginForm").submit(function(event){

		$('#WarningModalhdbgcl').modal('show');

		function hide_components(key)
		{
			if(key == 0)
			{
				$('#WarningModalhdbgcl').modal('hide');
			}

			$("#file_date").attr('class', 'form-group col-lg-12');
			$("#file_date > span").css("display", "none");
			$("#type_file").attr('class', 'form-group col-lg-12');
			$("#type_file > span").css("display", "none");
			$("#alert").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		var form_data = new FormData($("#loginForm")[0]);

		$.ajax({
			'url': '../files/file_massive_upload',
			'type': 'POST',
			'data': form_data,
			'cache': false,
			'contentType': false,
			'processData': false,
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

					var user = JSON.parse(xhr.responseText);

					if(user.file_date.length != 0)
					{
						$("#file_date").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#file_date > span").html(user.file_date).removeAttr("style");
					}
					if(user.type_file.length != 0)
					{
						$("#type_file").attr('class', 'form-group-inner input-with-error col-lg-12');
						$("#type_file > span").html(user.type_file).removeAttr("style");
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
					}
				},
			} 
		});
	});
})(jQuery)