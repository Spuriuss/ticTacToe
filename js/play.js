$('#field').on('click', '.cell', function() {
if (yourTurn == true && $(this).attr('data-content') == 'none') {
	var thisCell = $(this);
	var thisCellID = thisCell.attr('id');
	var thisCellX = parseInt(thisCellID.split('_')[0]);
	var thisCellY = parseInt(thisCellID.split('_')[1]);
	
	if (youArePlaying == 'crosses') {
		var cellContent = '<div class=crossOne></div> <div class=crossTwo></div>';
	}
	if (youArePlaying == 'nulls') {
		var cellContent = '<div class=nullOne><div class=nullTwo></div></div>';
	}
	thisCell.html(cellContent).attr('data-content', youArePlaying).css({'cursor': 'default'});
	
	mapAllPossibleLines(thisCellX, thisCellY);
	checkAllPossibleLines();
	
	yourTurn = false;
	sending = 'yes';
}
});



$('#newGameButton').click(function() {
	$.ajax({
		type: 'POST',
		url: 'requestHandlers/newGame.php',
		success: function(data) {
			//alert(data);
			location.reload();
		}
	});
});



synchronise();