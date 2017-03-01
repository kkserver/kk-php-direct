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

/**
 * @param  \stdClass|array 	&$object 
 * @param  string|array 	$keys    
 * @return any         
 */
function dynamic_get_with_keys(&$object,$keys) {
	
	if(is_string($keys)) {
		$keys = split('\\.', $keys)
	}

	if is_array($keys) {

		while(count($keys) > 0) {
			$object = dynamic_get($object,array_shift($keys));
		}

		return $object;

	} else {
		return $object;
	}

}

/**
 * @param  \stdClass|array 	&$object 
 * @param  string|array 	$keys    
 * @param  any 				$value   
 * @return void          
 */
function dynamic_set_with_keys(&$object,$keys,$value) {

	if(is_string($keys)) {
		$keys = split('\\.', $keys)
	}

	if is_array($keys) {

		while(count($keys) > 0) {
			if(count($keys) == 1) {
				dynamic_set($object,array_shift($keys));
			} else {
				$object = dynamic_get($object,array_shift($keys),true);
			}
		}
	}

}


