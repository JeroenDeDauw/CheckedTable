<?php

namespace SMW\Query\Result;

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
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
