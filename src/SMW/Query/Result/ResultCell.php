<?php

namespace SMW\Query\Result;

use InvalidArgumentException;
use SMWPrintRequest;
use SMWDataItem;

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
