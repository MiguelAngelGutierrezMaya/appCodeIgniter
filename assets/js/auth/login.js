(function($){
	$("#loginForm").submit(function(event){

		function hide_components()
		{
			$("#username").attr('class', 'form-group');
			$("#username > span").css("display", "none");
			$("#password").attr('class', 'form-group');
			$("#password > span").css("display", "none");
			$("#alert").css("display", "none");
			$("#error > div").css("display", "none");
		}

		event.preventDefault();

		$.ajax({
			'url': 'auth_validate',
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
				409: function(xhr)
				{
					hide_components();

					var json = JSON.parse(xhr.responseText);

					if(json.key == 1)
					{
						if(json.username.length != 0)
						{
							$("#username").attr('class', 'form-group-inner input-with-error');
							$("#username > span").html(json.username).removeAttr("style");
						}
						if(json.password.length != 0)
						{
							$("#password").attr('class', 'form-group-inner input-with-error');
							$("#password > span").html(json.password).removeAttr("style");
						}
					}
					if(json.key == 2)
					{
						if(json.msj.length != 0)
						{
							$("#error").
								html(
									'<div class="alert alert-danger" role="alert"><button id="button-error" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span>'+ json.msj +'</span></div>'
								);
						}
					}
				}
			} 
		});
	});
})(jQuery)

/*var wow = new WOW(
    {
        boxClass: 'wowload', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: true, // trigger animations on mobile devices (default is true)
        live: true        // act on asynchronously loaded content (default is true)
    }
);
wow.init();*/