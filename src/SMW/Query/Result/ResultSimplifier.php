<?php

namespace SMW\Query\Result;

use SMW\DIWikiPage;
use SMWPrintRequest;
use SMWQueryResult;
use SMWResultArray;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ResultSimplifier {

	/**
	 * @var SMWQueryResult
	 */
	protected $queryResult;

	/**
	 * @param SMWQueryResult $queryResult
	 * @return SimpleResult
	 */
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
