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
			'url': 'http://localhost/appCodeIgniter/users/validate',
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

					if(user.username.length != 0)
					{
						$("#username").attr('class', 'form-group-inner input-with-error');
						$("#username > span").html(user.username).removeAttr("style");
					}
					if(user.password.length != 0)
					{
						$("#password").attr('class', 'form-group-inner input-with-error');
						$("#password > span").html(user.password).removeAttr("style");
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
		});
	});
})(jQuery)

var wow = new WOW(
    {
        boxClass: 'wowload', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: true, // trigger animations on mobile devices (default is true)
        live: true        // act on asynchronously loaded content (default is true)
    }
);
wow.init();