<?php

namespace SMW\Query\Result;

use SMW\DIWikiPage;

class ResultEntity {

	protected $subject;
	protected $resultCells;

	/**
	 * @param DIWikiPage $page
	 * @param ResultCell[] $resultCells
	 */
	public function __construct( DIWikiPage $page, array $resultCells ) {
		$this->subject = $page;
		$this->resultCells = $resultCells;
	}

	/**
	 * @return DIWikiPage
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * @return ResultCell[]
	 */
	public function getResultCells() {
		return $this->resultCells;
	}

}
