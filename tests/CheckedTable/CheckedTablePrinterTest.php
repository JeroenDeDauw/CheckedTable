<?php

namespace CheckedTable\Tests;

use CheckedTable\CheckedTablePrinter;

/**
 * @covers CheckedTable\CheckedTablePrinter
 * @group CheckedTable
 * @group SMWExtension
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CheckedTablePrinterTest extends \PHPUnit_Framework_TestCase {

	const FORMAT_NAME = 'checkedtable';

	public function testCanConstruct() {
		$this->newInstance();
		$this->assertTrue( true );
	}

	protected function newInstance() {
		return new CheckedTablePrinter( self::FORMAT_NAME );
	}

}
