<?php

namespace CheckedTable;

use SMW\Query\Result\ResultSimplifier;
use SMW\ResultPrinter;
use SMWQueryResult;

class CheckedTablePrinter extends ResultPrinter {

	protected function getResultText( SMWQueryResult $queryResult, $outputMode ) {
		$tableCreator = new CheckedTableCreator();
		$resultSimplifier = new ResultSimplifier();

		return $tableCreator->getHtmlFor( $resultSimplifier->getSimplified( $queryResult ) );
	}

}
