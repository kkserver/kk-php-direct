<?php

namespace kk;

interface IApp {

	/**
	 * @param  \kk\IContext $ctx
	 * @throws \Exception
	 * @return void
	 */
	function exec($ctx);

	/**
	 * @param  \stdClass $options
	 * @throws \Exception
	 * @return \kk\IDirect
	 */
	function open($options);

	/**
	 * @param  function $fn
	 * @return void
	 */
	function each($fn);

}
