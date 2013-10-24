<?php

namespace CheckedTable;

use SMW\ResultPrinter;
use SMWQueryResult;

class CheckedTablePrinter extends ResultPrinter {

	protected function getResultText( SMWQueryResult $res, $outputmode ) {
		return 'foobar'; // TODO
	}

}