<?php
namespace App\MyScraper\Bukalapak\Optimization;


class Title
{

	public static function applyTitleRules(string $title)
	{
		// TODO: Apply bukalapak title naming rules
	}
	
	public static function addPrefix(string $title, string $prefix)
	{
		return trim($prefix).' '.trim($title);
	}


	public static function addSuffix(string $title, string $suffix)
	{
		return trim($title).' '.trim($suffix);
	}
}