<?php

namespace SMW\Tests\Query\Result;

use SMW\Query\Result\ResultEntity;

/**
 * @covers SMW\Query\Result\ResultEntity
 * @group CheckedTable
 * @group ResultEntity
 * @group SMWExtension
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ResultEntityTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider constructorArgumentsProvider
	 */
	public function testConstructor( $wikiPage, array $resultCells ) {
		$entity = new ResultEntity( $wikiPage, $resultCells );

		$this->assertEquals( $wikiPage, $entity->getSubject() );
		$this->assertEquals( $resultCells, $entity->getResultCells() );
	}

	public function constructorArgumentsProvider() {
		$wikiPage = $this->getMockBuilder( 'SMW\DIWikiPage' )->disableOriginalConstructor()->getMock();
		$resultCell = $this->getMockBuilder( 'SMW\Query\Result\ResultCell' )->disableOriginalConstructor()->getMock();

		return array(
			array(
				$wikiPage,
				array()
			),

			array(
				$wikiPage,
				array(
					$resultCell,
					$resultCell
				)
			),
		);
	}

}
