$('#loginButton').click(function() {
if (checkFields($('#main')) == 'nothingIsEmpty') {
	var thisButton = $(this);
	
	startLoading(thisButton);
	$.ajax({
		type: "POST",
		url: 'requestHandlers/login.php',
		data: 'username=' + $('#username').val(),
		success: function(data) {
			finishLoading(thisButton);
			//alert(data);
			if (data == 'loggedIn') {
				location.replace('play.php');
			} 
			if (data == 'userAlreadyOnline') {
				alert('Этот игрок уже играет');
			}
			if (data == 'wrongName') {
				alert('Такого игрока нет');
			}
		}
	});
}
});