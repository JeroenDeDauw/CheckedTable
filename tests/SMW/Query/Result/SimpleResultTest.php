<?php

namespace SMW\Tests\Query\Result;

use SMW\Query\Result\SimpleResult;

/**
 * @covers SMW\Query\Result\SimpleResult
 * @group CheckedTable
 * @group ResultEntity
 * @group SMWExtension
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleResultTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider constructorArgumentsProvider
	 */
	public function testConstructor( array $resultEntities ) {
		$entity = new SimpleResult( $resultEntities );

		$this->assertEquals( $resultEntities, $entity->getResultEntities() );
	}

	public function constructorArgumentsProvider() {
		$entity = $this->getMockBuilder( 'SMW\Query\Result\ResultEntity' )->disableOriginalConstructor()->getMock();

		return array(
			array(
				array()
			),

			array(
				array(
					$entity
				)
			),

			array(
				array(
					$entity,
					$entity,
					$entity,
				)
			),
		);
	}

}
