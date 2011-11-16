<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

// ------------------------------------------------------------------------

/**
 * CodeIgniter Avatar Helpers
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
 * @param	boolean
 * @return	string url
 */
if ( ! function_exists('avatar'))
{
	function avatar($email, $hash = true)
	{
		$CI =& get_instance();
		$CI->load->library('gravatar');
		return $CI->gravatar->getAvatar($email, $hash);
	}
}