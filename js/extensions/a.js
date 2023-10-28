lineLength = 3;


buttonCounter = 1;
function startLoading(container) {
	buttonCounter = 2;
	container.find('.centerText').fadeOut(0);
	container.find('.loadingAnimation').fadeIn(0);
	container.find('.blanket').fadeIn(0);
	
	if (container.css('cursor') == 'pointer') {
		container.css({'cursor': 'default'});
	}
}

function finishLoading(container) {
	buttonCounter = 1;
	container.find('.centerText').fadeIn(0);
	container.find('.loadingAnimation').fadeOut(0);
	container.find('.blanket').fadeOut(0);

	if (container.css('cursor') == 'default') {
		container.css({'cursor': 'pointer'});
	}
}

function checkFields(fieldsParent) {
	var somethingIsEmpty = 'no';
	fieldsParent.find('input, textarea').each(function() {
		if ($(this).val() == '') {
			$(this).css({'border': '2px solid red'});
			somethingIsEmpty = 'yes';
		}
	});
	
	if (somethingIsEmpty == 'no') {
		return 'nothingIsEmpty';
	} else {
		return 'somethingIsEmpty';
	}
}


function postStringToArray(postString) {
	var stringMap = postString.split('&');
	var stringMapCounter = stringMap.length;
	
	for (var i = 0; i < stringMapCounter; i++) {
		stringMap[i] = stringMap[i].split('=');
	}
	
	var array = new Array();
	for (var i = 0; i < stringMapCounter; i++) {
		array[stringMap[i][0]] = stringMap[i][1];
	}
	
	return array;
}

$('input, textarea').focusin(function() {
	$(this).css({'border': '1px solid black'});
});
$('input, textarea').keydown(function() {
	$(this).css({'border': '1px solid black'});
});