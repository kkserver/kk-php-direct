<?php

namespace kk;

interface IContext {

	/**
	 * @return void
	 */
	function begin();

	/**
	 * @return void
	 */
	function end();

	/**
	 * @param  string|array $keys
	 * @return any
	 */
	function get($keys);

	/**
	 * @param string|array 	$keys
	 * @param any 			$value
	 */
	function set($keys, $value);

}

class Context extends IContext {

	private $_values = array();

	/**
	 * @return void
	 */
	public function begin() {
		array_push($_values, new \stdClass());
	}

	/**
	 * @return void
	 */
	public function end() {
		array_pop($_values);
	}

}

