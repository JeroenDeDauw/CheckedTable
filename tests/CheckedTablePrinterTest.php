<?php

namespace CheckedTable\Tests;

use CheckedTable\CheckedTablePrinter;

/**
 * @covers CheckedTable\CheckedTablePrinter
 * @group CheckedTable
 */
class CheckedTablePrinterTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {
		$printer = new CheckedTablePrinter( 'checkedtable' );
		$this->assertTrue( true );
	}

}