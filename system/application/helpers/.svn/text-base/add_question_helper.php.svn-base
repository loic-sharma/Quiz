<?php

function question_type($type)
{
	// Start out by writing the basic known information
	$return  = 'id="type-' . $type . '"';

	// We'll want to show the question type only if it
	// was requested for
	if(get_instance()->input->post('type') != $type)
	{
		$return .= ' style="display:none;"';
	}

	return $return;
}

function _value($field)
{
	return get_instance()->input->post($field);
}