<?php

namespace SMW\Query\Result;

use SMW\DIWikiPage;

class ResultEntity {

	protected $subject;
	protected $resultCells;

	/**
	 * @param DIWikiPage $subject
	 * @param ResultCell[] $resultCells
	 */
	public function __construct( DIWikiPage $subject, array $resultCells ) {
		$this->subject = $subject;
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
