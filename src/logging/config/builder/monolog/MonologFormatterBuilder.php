<?php

namespace cygnus\logging\config\builder\monolog;

use cygnus\logging\config\builder\Builder;

abstract class MonologFormatterBuilder implements Builder {

	/**
	 * This returns \Monolog\Formatter\XXXFormatter
	 */
	public abstract function build($builderContext = null);

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \cygnus\logging\config\builder\Builder::initFromJson()
	 * @return \cygnus\logging\config\builder\MonologFormatterBuilder
	 */
	public function initFromJson($jsonObj, $envVars) {
		// we have nothing to do here - yet
		return $this;
	}

}