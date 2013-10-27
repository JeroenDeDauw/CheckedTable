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
		$tableCreator = new CheckedTableCreator(
			$this->params['property'],
			$this->params['value'],
			$this->params['negate']
		);

		$resultSimplifier = new ResultSimplifier();

		return $tableCreator->getHtmlFor( $resultSimplifier->getSimplified( $queryResult ) );
	}

	public function getParamDefinitions( array $definitions ) {
		$definitions['property'] = array(
			'type' => 'string',
			'default' => 'Has talk type',
			'message' => 'todo', // TODO
		);

		$definitions['value'] = array(
			'type' => 'string',
			'default' => 'Technical talk',
			'message' => 'todo', // TODO
		);

		$definitions['negate'] = array(
			'type' => 'boolean',
			'default' => false,
			'message' => 'todo', // TODO
		);

		return $definitions;

	}

}
