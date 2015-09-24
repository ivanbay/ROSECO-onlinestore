<?php

/**
* Custo validation
*/
class CustomValidator extends Illuminate\Validation\Validator
{
	
	public function validateNotzero($attribute, $value, $parameters){

		if( $value == '0' ){
			return false;
		}

		return true;

	}

}