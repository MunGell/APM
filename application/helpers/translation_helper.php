<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

// ------------------------------------------------------------------------

/**
 * CodeIgniter URL Helpers
 *
 * @package		APM
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Shmavon Gazanchyan
 * @link		http://none.html
 */

// ------------------------------------------------------------------------

/**
 * Translation helper
 *
 * Translates a line with values
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('translate'))
{
	function translate($line, $values = array())
	{
		$CI =& get_instance();
		if($count = count($values) > 0)
		{
			$line = $CI->lang->language[$line];
			for($i = 0; $i < $count; $i++)
			{
				$line = str_replace('%'.($i+1), $values[$i], $line);
			}
			return $line;
		}
		else
		{
			return $CI->lang->language[$line];
		}
	}
}