<?php

namespace CheckedTable\Tests;

use CheckedTable\CheckedTablePrinter;

/**
 * @covers CheckedTable\CheckedTablePrinter
 * @group CheckedTable
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

//	public function testReturnsString() {
//		$queryResult = $this->getMock( 'SMWQueryResult' );
//
//		$queryResult->expects( '' )
//
//		$result = $this->newInstance()->getResult(
//
//			array(),
//			SMW_OUTPUT_WIKI
//		);
//
//		$this->assertInternalType( 'string', $result );
//	}

}
