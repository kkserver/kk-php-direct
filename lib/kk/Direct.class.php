<?php

namespace kk;

interface IDirect {

	/**
	 * @return \kk\IApp
	 */
	function app();

	/**
	 * @param \kk\IApp
	 */
	function setApp($app);

	/**
	 * @return \stdClass
	 */
	function options();

	/**
	 * @param \stdClass
	 */
	function setOptions($options);

	/**
	 * @param  \kk\IContext $ctx
	 * @throws \Exception
	 * @return void
	 */
	function exec($ctx);

	/**
	 * @param  \kk\IContext   	$ctx
	 * @param  string   		$name
	 * @return void
	 */
	function done($ctx, $name);

	/**
	 * @param  \kk\IContext 	$ctx
	 * @param  \Exception 		$error
	 * @return void
	 */
	function fail($ctx, $error);

	/**
	 * @param  string  $name
	 * @return boolean
	 */
	function has($name);

}
