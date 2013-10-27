<?php

namespace CheckedTable;

use SMW\Query\Result\ResultCell;
use SMW\Query\Result\ResultEntity;
use SMW\Query\Result\SimpleResult;

/**
 * This class does the actual work for determining which values match the desired one,
 * and creates the output to visualize this.
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CheckedTableCreator {

	protected $printRequestLabel;
	protected $expectedValue;
	protected $negate;

	public function __construct( $printRequestLabel, $expectedValue, $negate = false ) {
		$this->printRequestLabel = $printRequestLabel;
		$this->expectedValue = $expectedValue;
		$this->negate = $negate;
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
		return in_array( $this->expectedValue, $talkTypes ) xor $this->negate;
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
