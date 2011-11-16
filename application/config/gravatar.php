<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| The size to use for avatars.
|--------------------------------------------------------------------------
*/
$config['gravatar_size'] = 80;

/*
|--------------------------------------------------------------------------
| The default image to use - either a string of the gravatar-recognized default image "type" to use, a URL, 
| or false if using the...default gravatar default image (hah)
|--------------------------------------------------------------------------
*/
$config['gravatar_default_image'] = 'mm';

/*
|--------------------------------------------------------------------------
| The maximum rating to allow for the avatar.
|--------------------------------------------------------------------------
*/
$config['gravatar_max_rating'] = 'g';

/*
|--------------------------------------------------------------------------
| Should we use the secure (HTTPS) URL base?
|--------------------------------------------------------------------------
*/
$config['gravatar_use_secure_url'] = false;

/*
|--------------------------------------------------------------------------
| A temporary internal cache of the URL parameters to use.
|--------------------------------------------------------------------------
*/
$config['gravatar_param_cache'] = false;

/* End of file gravatar.php */
/* Location: ./application/config/gravatar.php */