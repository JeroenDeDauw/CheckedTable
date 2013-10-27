<?php

namespace SMW\Tests\Query\Result;

use SMW\Query\Result\ResultSimplifier;

/**
 * @covers SMW\Query\Result\ResultSimplifier
 * @group CheckedTable
 * @group ResultEntity
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ResultSimplifierTest extends \PHPUnit_Framework_TestCase {

	public function testGetSimplifiedEmptyQueryResult() {
		$simplifier = new ResultSimplifier();

		$queryResult = $this->getMockBuilder( 'SMWQueryResult' )->disableOriginalConstructor()->getMock();

		$queryResult->expects( $this->once() )
			->method( 'getResults' )
			->will( $this->returnValue( array() ) );

		$simpleResult = $simplifier->getSimplified( $queryResult );

		$this->assertInstanceOf( 'SMW\Query\Result\SimpleResult', $simpleResult );
		$this->assertEmpty( $simpleResult->getResultEntities() );
	}

}
