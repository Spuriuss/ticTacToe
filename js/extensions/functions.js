function mapCardinalDirection(x, xChange, y, yChange) {
	var currentMapCounter = linesMap.length;
	linesMap[currentMapCounter] = new Array();
	
	var mapX = x;
	var mapY = y;

	for (var i = 0; i < lineLength; i++) {
		linesMap[currentMapCounter][i] = new Array();
		linesMap[currentMapCounter][i]['x'] = mapX;
		linesMap[currentMapCounter][i]['y'] = mapY;
		
		if (xChange == 'increase') {
			mapX++;
		}
		if (xChange == 'decrease') {
			mapX--;
		}
		
		if (yChange == 'increase') {
			mapY++;
		}
		if (yChange == 'decrease') {
			mapY--;
		}
	}
}


// -----------------------------------------------------------------------------------------------


function expandCardinalDirection(directionKey) {
	var cardinalDirection = linesMap[directionKey];
	
	var xChange = cardinalDirection[1]['x'] - cardinalDirection[0]['x'];
	var yChange = cardinalDirection[1]['y'] - cardinalDirection[0]['y'];
	
	for (var i = 0; i < (lineLength-1); i++) {
		var currentLinesMapCounter = linesMap.length;
		linesMap[currentLinesMapCounter] = new Array();
		
		for (var l = 0; l < lineLength; l++) {
			linesMap[currentLinesMapCounter][l] = new Array();
			linesMap[currentLinesMapCounter][l]['x'] = cardinalDirection[l]['x'] - xChange*(i+1);
			linesMap[currentLinesMapCounter][l]['y'] = cardinalDirection[l]['y'] - yChange*(i+1);
		}
	}
}


// -----------------------------------------------------------------------------------------------


function mapAllPossibleLines(x, y) {
	delete linesMap;
	linesMap = new Array();
	
	mapCardinalDirection(x, 'decrease', y, 'increase');
	mapCardinalDirection(x, 'noChange', y, 'increase');
	mapCardinalDirection(x, 'increase', y, 'increase');
	mapCardinalDirection(x, 'increase', y, 'noChange');
	
	for (var i = 0; i < 4; i++) {
		expandCardinalDirection(i);
	}
}


// -----------------------------------------------------------------------------------------------


function checkAllPossibleLines() {
	var linesCounter = linesMap.length;
	gameOver = 'no';
	
	for (var i = 0; i < linesCounter; i++) {
		var somethingIsEmpty = 'no';
		
		for (var l = 0; l < lineLength; l++) {
			var cellX = linesMap[i][l]['x'];
			var cellY = linesMap[i][l]['y'];
			var cellID = cellX + '_' + cellY;

			if ($('#' + cellID).attr('data-content') !== youArePlaying) {
				somethingIsEmpty = 'yes';
			}
		}
		
		if (somethingIsEmpty == 'no') {
			for (var l = 0; l < lineLength; l++) {
				var cellX = linesMap[i][l]['x'];
				var cellY = linesMap[i][l]['y'];
				var cellID = cellX + '_' + cellY;
				
				$('#' + cellID + ' > div').each(function() {
					$(this).css({'background': 'red'});
				});
			}
			
			gameOver = 'yes';
			var currentWins = parseInt($('#wins .targetText').text());
			var newWins = currentWins + 1;
			$('#wins .targetText').text(newWins);
		}
	}
}
	
	
// -----------------------------------------------------------------------------------------------


sending = 'no';
function synchronise() {
	$.ajax({
		type: 'POST',
		url: 'requestHandlers/synchronise.php',
		data: 'userID=' + userID,
		success: function(data) {
			if (sending == 'no') {
				var dataArray = postStringToArray(data);
				var correctField = atob(dataArray['field']);
				var wins = dataArray['wins'];
				var losses = dataArray['losses'];
				yourTurn = dataArray['turn'];
				
				var currentField = $('#field').html();
				
				console.log(correctField, '-------------', currentField);
				if (correctField !== currentField) {
					$('#field').html(correctField);
					$('#wins .targetText').text(wins);
					$('#losses .targetText').text(losses);
				}
				
				//synchronise();
			} else {
				send();
			}
			
		}
	});
	
}


// -----------------------------------------------------------------------------------------------


function send() {
	$.ajax({
		type: 'POST',
		url: 'requestHandlers/send.php',
		data:  
		'field=' + encodeURIComponent(btoa($('#field').html())) + '&' + 
		'gameOver=' + gameOver,
		success: function(data) {
			//console.log(data);
			sending = 'no';
			synchronise();
		}
	});
}