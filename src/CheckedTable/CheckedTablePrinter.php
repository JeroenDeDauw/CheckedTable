<?php

namespace CheckedTable;

use InvalidArgumentException;
use SMW\DIWikiPage;
use SMW\ResultPrinter;
use SMWQueryResult;
use SMWResultArray;
use SMWDataItem;
use SMWPrintRequest;

class CheckedTablePrinter extends ResultPrinter {

	protected function getResultText( SMWQueryResult $queryResult, $outputMode ) {
		$tableCreator = new CheckedTableCreator();
		$resultSimplifier = new ResultSimplifier();

		return $tableCreator->getHtmlFor( $resultSimplifier->getSimplified( $queryResult ) );
	}

}

class CheckedTableCreator {

	protected $printRequestLabel = 'Has talk type';
	protected $expectedValue = 'Technical talk';

	public function __construct() {
	}

	public function getHtmlFor( SimpleResult $result ) {
		$texts = array();

		foreach ( $result->getResultEntities() as $resultEntity ) {
			$texts[] = $this->getTextForEntity( $resultEntity );
		}

		return $this->arrayToHtmlList( $texts );
	}

	protected function arrayToHtmlList( array $lines ) {
		if ( $lines === array() ) {
			return '';
		}

		return
			'<ul><li>' .
				implode( '</li><li>', $lines ) .
			'<\li></ul>';
	}

	protected function getTextForEntity( ResultEntity $entity ) {
		$titleText = $entity->getPage()->getTitle()->getFullText();

		$style = $this->hasDesiredTalkType( $entity ) ? 'color:darkgreen; font-weight: bold' : 'color:darkgray';

		return
			'<span style="' . $style . '">' .
				htmlspecialchars( $titleText ) .
			'</span>';
	}

	protected function hasDesiredTalkType( ResultEntity $entity ) {
		$talkTypes = $this->getTalkTypes( $entity );
		return in_array( $this->expectedValue, $talkTypes );
	}

	protected function getTalkTypes( ResultEntity $entity ) {
		foreach( $entity->getResultCells() as $resultCell ) {
			if ( $this->isForTheRightPrintRequest( $resultCell ) ) {
				return $this->getStringValuesForCell( $resultCell );
			}
		}

		return array();
	}

	protected function getStringValuesForCell( ResultCell $resultCell ) {
		$values = array();

		foreach ( $resultCell->getCellValues() as $dataItem ) {
			if ( $dataItem instanceof \SMWDIBlob ) {
				$values[] = $dataItem->getString();
			}
		}

		return $values;
	}

	protected function isForTheRightPrintRequest( ResultCell $resultCell ) {
		return $resultCell->getPrintRequest()->getLabel() === $this->printRequestLabel;
	}

}

class ResultSimplifier {

	/**
	 * @var SMWQueryResult
	 */
	protected $queryResult;

	public function getSimplified( SMWQueryResult $queryResult ) {
		$this->queryResult = $queryResult;
		return $this->constructSimplifiedResult();
	}

	protected function constructSimplifiedResult() {
		$entities = array();

		foreach ( $this->queryResult->getResults() as $diWikiPage ) {
			$entities[] = $this->constructResultEntity(
				$diWikiPage,
				$this->queryResult->getPrintRequests()
			);
		}

		return new SimpleResult( $entities );
	}

	/**
	 * @param DIWikiPage $diWikiPage
	 * @return ResultEntity
	 */
	protected function constructResultEntity( DIWikiPage $diWikiPage ) {
		$cells = array();

		foreach ( $this->queryResult->getPrintRequests() as $printRequest ) {
			$cells[] = $this->constructResultCell( $diWikiPage, $printRequest );
		}

		return new ResultEntity( $diWikiPage, $cells );
	}

	/**
	 * @param DIWikiPage $diWikiPage
	 * @param SMWPrintRequest $printRequest
	 * @return ResultCell
	 */
	protected function constructResultCell( DIWikiPage $diWikiPage, SMWPrintRequest $printRequest ) {
		$resultArray = new SMWResultArray( $diWikiPage, $printRequest, $this->queryResult->getStore() );

		$dataItems = $resultArray->getContent();

		if ( $dataItems === false ) {
			$dataItems = array();
		}

		return new ResultCell( $printRequest, $dataItems );
	}

}

class SimpleResult {

	protected $resultEntities;

	/**
	 * @param ResultEntity[] $resultEntities
	 */
	public function __construct( array $resultEntities ) {
		$this->resultEntities = $resultEntities;
	}

	/**
	 * @return ResultEntity[]
	 */
	public function getResultEntities() {
		return $this->resultEntities;
	}

}


class ResultEntity {

	protected $page;
	protected $resultCells;

	/**
	 * @param DIWikiPage $page
	 * @param ResultCell[] $resultCells
	 */
	public function __construct( DIWikiPage $page, array $resultCells ) {
		$this->page = $page;
		$this->resultCells = $resultCells;
	}

	/**
	 * @return DIWikiPage
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * @return ResultCell[]
	 */
	public function getResultCells() {
		return $this->resultCells;
	}

}

class ResultCell {

	protected $printRequest;
	protected $callValues;

	/**
	 * @param SMWPrintRequest $printRequest
	 * @param SMWDataItem[] $cellValues
	 * @throws InvalidArgumentException
	 */
	public function __construct( SMWPrintRequest $printRequest, array $cellValues ) {
		$this->printRequest = $printRequest;
		$this->setCellValues( $cellValues );
	}

	protected function setCellValues( array $callValues ) {
		foreach ( $callValues as $callValue ) {
			if ( !( $callValue instanceof SMWDataItem ) ) {
				throw new InvalidArgumentException( '$callValues can only contain SMWDataItem instances' );
			}
		}

		$this->callValues = $callValues;
	}

	/**
	 * @return SMWPrintRequest
	 */
	public function getPrintRequest() {
		return $this->printRequest;
	}

	/**
	 * @return SMWDataItem[]
	 */
	public function getCellValues() {
		return $this->callValues;
	}

}