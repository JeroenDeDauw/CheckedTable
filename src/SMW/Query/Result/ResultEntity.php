<?php

namespace SMW\Query\Result;

use SMW\DIWikiPage;

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
