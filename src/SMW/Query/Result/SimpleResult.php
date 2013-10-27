<?php

namespace SMW\Query\Result;

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
