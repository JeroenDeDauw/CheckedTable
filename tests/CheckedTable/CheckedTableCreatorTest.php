<?php

namespace CheckedTable\Tests;

use CheckedTable\CheckedTableCreator;
use SMW\Query\Result\ResultCell;
use SMW\Query\Result\ResultEntity;
use SMW\Query\Result\SimpleResult;

/**
 * @covers CheckedTable\CheckedTableCreator
 * @group CheckedTable
 * @group SMWExtension
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CheckedTableCreatorTest extends \PHPUnit_Framework_TestCase {

	const PRINT_REQUEST_LABEL = 'Has talk type';
	const EXPECTED_VALUE = 'Technical talk';

//	public function testGetHtmlForEmptyResult() {
//		$this->assertResultTurnsIntoHtml(
//			new SimpleResult( array() ),
//			''
//		);
//	}
//
//	protected function assertResultTurnsIntoHtml( SimpleResult $result, $expectedHtml ) {
//		$tableCreator = new CheckedTableCreator();
//
//		$resultHtml = $tableCreator->getHtmlFor( $result );
//
//		$this->assertInternalType( 'string', $resultHtml );
//		$this->assertEquals(
//			$expectedHtml,
//			$resultHtml
//		);
//	}

//	/**
//	 * @dataProvider nonMatchingEntityProvider
//	 */
//	public function testGetHtmlForResultWithNonMatchingEntity( ResultEntity $entity, $titleText ) {
//		$this->assertResultTurnsIntoHtml(
//			new SimpleResult( array(
//				$entity
//			) ),
//			'<ul><li><span style="color:darkgray">' . $titleText . '</span></li></ul>'
//		);
//	}
//
//	public function nonMatchingEntityProvider() {
//		return array(
//			array(
//				new ResultEntity( $this->getMockSubject( 'WritingTestsIsAwesome' ), array() ),
//				'WritingTestsIsAwesome'
//			),
//		);
//	}
//
//	protected function getMockSubject( $titleText ) {
//		$title = $this->getMockBuilder( 'Title' )->disableOriginalConstructor()->getMock();
//		$subject = $this->getMockBuilder( 'SMW\DIWikiPage' )->disableOriginalConstructor()->getMock();
//
//		$title->expects( $this->any() )
//			->method( 'getFullText' )
//			->will( $this->returnValue( $titleText ) );
//
//		$subject->expects( $this->any() )
//			->method( 'getTitle' )
//			->will( $this->returnValue( $title ) );
//
//		return $subject;
//	}

}
