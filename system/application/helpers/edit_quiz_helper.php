<?php

function type($question)
{
	$CI = get_instance();

	// Because of the way the form is built, we'll
	// need to decrement the type by one
	$type = $question['type'] - 1;

	return ucwords($CI->types[$type]);
}

function answer($question)
{
}