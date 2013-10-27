<?php

namespace CheckedTable;

use SMW\Query\Result\ResultCell;
use SMW\Query\Result\ResultEntity;
use SMW\Query\Result\SimpleResult;

/**
 * This class does the actual work for determining which values match the desired one,
 * and creates the output to visualize this.
 *
 * @licence GNU GPL v2+
 */
class CheckedTableCreator {

	protected $printRequestLabel;
	protected $expectedValue;

	public function __construct() {
		$this->printRequestLabel = 'Has talk type';
		$this->expectedValue = 'Technical talk';
	}

	public function getHtmlFor( SimpleResult $result ) {
		return 'You will need to write some code here';
		// TODO
	}

}
