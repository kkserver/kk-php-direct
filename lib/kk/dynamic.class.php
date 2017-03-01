<?php

namespace kk;

interface IGetter {

	/**
	 * @param  string $key 
	 * @return any     
	 */
	function get($key);

}

interface ISetter {

	/**
	 * @param string 	$key   
	 * @param any 		&$value 
	 */
	function set($key,&$value);
}

/**
 * @param  \stdClass|array  &$object    
 * @param  string  			$key       
 * @param  boolean 			$autocreate 
 * @return any              
 */
function dynamic_get(&$object, $key, $autocreate = false) {

	if (is_array($object)) {
		if (isset($object[$key])) {
			return $object[$key];
		} else if ($autocreate) {
			$v = new \stdClass();
			$object[$key] = $v;
			return $v
		}
	} else if(is_object($object)) {
		if($object instanceof IGetter) {
			return $object->get($key);
		}
		else if(isset($object->$key)) {
			return $object->$key;
		} else if($autocreate) {
			$v = new \stdClass();
			$object->$key = $v;
			return $v;
		}
	}

	return null;
}

/**
 * @param  \stdClass|array 	&$object 
 * @param  string 			$key    
 * @param  any 				$value   
 * @return any
 */
function dynamic_set(&$object,$key,&$value) {
	
	if (is_array($object)) {
		if($value === null) {
			if (isset($object[$key])) {
				unset($object[$key]);
			}
		} else {
			$object[$key] = $value
		}
	} else if(is_object($object)) {
		if($object instanceof ISetter) {
			$object->set($key,$value);
		}
		else {
			$object->$key = $value;
		}
	}

}

function dynamic_get_with_keys() {

}



