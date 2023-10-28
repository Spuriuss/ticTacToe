<?php
function spawnField($fieldSize) {
	$numberOfCells = $fieldSize * $fieldSize;
	
	$thisCellX = 1;
	$thisCellY = $fieldSize;
	
	$cells = '';
	for ($i = 0; $i < $numberOfCells; $i++) {
		$cells .= 
		"--><div class=cell id=" . $thisCellX . "_" . $thisCellY . 
		" style='width: calc(100% / " . $fieldSize . "); height: calc(100% / " . $fieldSize . ")' " . 
		"data-content=none>" . 
		"</div><!--";
		
		$thisCellX++;
		if ($thisCellX > $fieldSize) {
			$thisCellY--;
			$thisCellX = 1;
		}
	}
	$cells = substr($cells, 3, -4);
	
	return $cells;
}
?>