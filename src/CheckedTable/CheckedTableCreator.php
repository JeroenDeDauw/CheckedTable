<?php

namespace CheckedTable;

use SMW\Query\Result\ResultCell;
use SMW\Query\Result\ResultEntity;
use SMW\Query\Result\SimpleResult;

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
			'</li></ul>';
	}

	protected function getTextForEntity( ResultEntity $entity ) {
		$titleText = $entity->getSubject()->getTitle()->getFullText();

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
