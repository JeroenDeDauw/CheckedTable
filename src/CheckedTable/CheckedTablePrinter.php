<?php

namespace CheckedTable;

use SMW\Query\Result\ResultSimplifier;
use SMW\ResultPrinter;
use SMWQueryResult;

/**
 * The "CheckedTable" result printer.
 * 
 * Work is delegated to CheckedTableCreator which gets a simplified version of the SMWQueryResult.
 * This makes the handling code simpler, it makes it testable and gives us control over its
 * instantiation.
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CheckedTablePrinter extends ResultPrinter {

	protected function getResultText( SMWQueryResult $queryResult, $outputMode ) {
		$tableCreator = new CheckedTableCreator();
		$resultSimplifier = new ResultSimplifier();

		return $tableCreator->getHtmlFor( $resultSimplifier->getSimplified( $queryResult ) );
	}

}
