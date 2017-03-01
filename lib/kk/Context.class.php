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

	/**
	 * @param  string|array $keys
	 * @return any
	 */
	public function get($keys) {
		$i = count($_values) - 1;
		while($i >=0 ) {
			$v = dynamic_get_with_keys($_values[$i],$keys);
			if($v !== null) {
				return $v
			}
			$i = $i - 1;
		}
		return null;
	}

	/**
	 * @param string|array 	$keys
	 * @param any 			$value
	 */
	public function set($keys, $value) {
		if(count($_values) > 0) {
			dynamic_set_with_keys($_values[count($_values) - 1],$keys,$value);
		}
	}
}

