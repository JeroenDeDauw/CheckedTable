<?php

namespace CheckedTable\Tests;

use CheckedTable\CheckedTableCreator;
use SMW\Query\Result\ResultCell;
use SMW\Query\Result\ResultEntity;
use SMW\Query\Result\SimpleResult;

/**
 * @covers CheckedTable\CheckedTableCreator
 * @group CheckedTable
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CheckedTableCreatorTest extends \PHPUnit_Framework_TestCase {

	const PRINT_REQUEST_LABEL = 'Has talk type';
	const EXPECTED_VALUE = 'Technical talk';

	public function testGetHtmlForEmptyResult() {
		$this->assertResultTurnsIntoHtml(
			new SimpleResult( array() ),
			''
		);
	}

	protected function assertResultTurnsIntoHtml( SimpleResult $result, $expectedHtml ) {
		$tableCreator = new CheckedTableCreator();

		$resultHtml = $tableCreator->getHtmlFor( $result );

		$this->assertInternalType( 'string', $resultHtml );
		$this->assertEquals(
			$expectedHtml,
			$resultHtml
		);
	}

	/**
	 * @dataProvider nonMatchingEntityProvider
	 */
	public function testGetHtmlForResultWithNonMatchingEntity( ResultEntity $entity, $titleText ) {
		$this->assertResultTurnsIntoHtml(
			new SimpleResult( array(
				$entity
			) ),
			'<ul><li><span style="color:darkgray">' . $titleText . '</span></li></ul>'
		);
	}

	public function nonMatchingEntityProvider() {
		return array(
			array(
				new ResultEntity( $this->getMockSubject( 'WritingTestsIsAwesome' ), array() ),
				'WritingTestsIsAwesome'
			),

			array(
				new ResultEntity( $this->getMockSubject( 'WritingTestsIsAwesome' ), array(
					new ResultCell( $this->newMatchingPrintRequest(), array() )
				) ),
				'WritingTestsIsAwesome'
			),

			array(
				new ResultEntity( $this->getMockSubject( 'abc' ), array(
					new ResultCell( $this->newMatchingPrintRequest(), array(
						new \SMWDIBlob( 'foo' ),
						new \SMWDIBlob( 'bar' ),
						new \SMWDIBlob( 'baz' ),
						new \SMWDINumber( 42 ),
					) )
				) ),
				'abc'
			),

			array(
				new ResultEntity( $this->getMockSubject( 'foo' ), array(
					new ResultCell( $this->newMatchingPrintRequest(), array(
						new \SMWDIBlob( 'not_' . self::EXPECTED_VALUE ),
					) )
				) ),
				'foo'
			),

			array(
				new ResultEntity( $this->getMockSubject( 'bar' ), array(
					new ResultCell( $this->newNonMatchingPrintRequest(), array(
						$this->newMatchingValue(),
					) )
				) ),
				'bar'
			),
		);
	}

	protected function getMockSubject( $titleText ) {
		$title = $this->getMockBuilder( 'Title' )->disableOriginalConstructor()->getMock();
		$subject = $this->getMockBuilder( 'SMW\DIWikiPage' )->disableOriginalConstructor()->getMock();

		$title->expects( $this->any() )
			->method( 'getFullText' )
			->will( $this->returnValue( $titleText ) );

		$subject->expects( $this->any() )
			->method( 'getTitle' )
			->will( $this->returnValue( $title ) );

		return $subject;
	}

	protected function newMatchingPrintRequest() {
		$matchingPrintRequest = $this->getMockBuilder( 'SMWPrintRequest' )->disableOriginalConstructor()->getMock();
		$matchingPrintRequest->expects( $this->any() )
			->method( 'getLabel' )
			->will( $this->returnValue( self::PRINT_REQUEST_LABEL ) );

		return $matchingPrintRequest;
	}

	protected function newMatchingValue() {
		return new \SMWDIBlob( self::EXPECTED_VALUE );
	}

	protected function newNonMatchingPrintRequest() {
		$nonMatchingPrintRequest = $this->getMockBuilder( 'SMWPrintRequest' )->disableOriginalConstructor()->getMock();
		$nonMatchingPrintRequest->expects( $this->any() )
			->method( 'getLabel' )
			->will( $this->returnValue( 'not_' . self::PRINT_REQUEST_LABEL ) );

		return $nonMatchingPrintRequest;
	}

	public function testGetHtmlForResultWithMatchingEntity() {
		$titleText = 'WritingTestsIsAwesome';
		$subject = $this->getMockSubject( $titleText );

		$this->assertResultTurnsIntoHtml(
			new SimpleResult( array(
				new ResultEntity(
					$subject,
					array(
						new ResultCell(
							$this->newMatchingPrintRequest(),
							array(
								$this->newMatchingValue(),
							)
						)
					)
				)
			) ),
			'<ul><li><span style="color:darkgreen; font-weight: bold">' . $titleText . '</span></li></ul>'
		);
	}

	public function testGetHtmlForResultWithSomeMatchingAndSomeNot() {
		$this->assertResultTurnsIntoHtml(
			new SimpleResult( array(
				new ResultEntity(
					$this->getMockSubject( 'firstMatch' ),
					array(
						new ResultCell(
							$this->newMatchingPrintRequest(),
							array(
								$this->newMatchingValue(),
							)
						),
					)
				),
				new ResultEntity(
					$this->getMockSubject( 'firstMiss' ),
					array(
						new ResultCell(
							$this->newNonMatchingPrintRequest(),
							array(
								$this->newMatchingValue(),
							)
						),
					)
				),
				new ResultEntity(
					$this->getMockSubject( 'secondMatch' ),
					array(
						new ResultCell(
							$this->newMatchingPrintRequest(),
							array(
								$this->newMatchingValue(),
							)
						),
					)
				)
			) ),
			'<ul><li><span style="color:darkgreen; font-weight: bold">firstMatch</span></li>'
				. '<li><span style="color:darkgray">firstMiss</span></li>'
				. '<li><span style="color:darkgreen; font-weight: bold">secondMatch</span></li></ul>'
		);
	}

}
