<?php

namespace swf\slf4php\config\builder;

abstract class AppenderBuilder implements Builder {

	protected $name;

	/**
	 *
	 * @return \swf\slf4php\config\builder\AppenderBuilder
	 */
	public function name($name) {
		$this->name = $name;
		return $this;
	}

	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \swf\slf4php\config\builder\Builder::build()
	 * @return \swf\slf4php\Appender
	 */
	public abstract function build();

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \swf\slf4php\config\builder\Builder::initFromJson()
	 * @return \swf\slf4php\config\builder\AppenderBuilder
	 */
	public abstract function initFromJson($jsonObj, $envVars);

}