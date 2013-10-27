<?php

namespace SMW\Tests\Query\Result;

use SMW\Query\Result\ResultCell;
use SMWPrintRequest;

/**
 * @covers SMW\Query\Result\ResultCell
 * @group CheckedTable
 * @group ResultEntity
 */
class ResultCellTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider constructorArgumentsProvider
	 */
	public function testConstructor( SMWPrintRequest $printRequest, array $cellValues ) {
		$entity = new ResultCell( $printRequest, $cellValues );

		$this->assertEquals( $printRequest, $entity->getPrintRequest() );
		$this->assertEquals( $cellValues, $entity->getCellValues() );
	}

	public function constructorArgumentsProvider() {
		$printRequest = $this->getMockBuilder( 'SMWPrintRequest' )->disableOriginalConstructor()->getMock();
		$dataItem = $this->getMockBuilder( 'SMWDataItem' )->disableOriginalConstructor()->getMock();

		return array(
			array(
				$printRequest,
				array()
			),

			array(
				$printRequest,
				array(
					$dataItem,
					$dataItem
				)
			),
		);
	}

}
