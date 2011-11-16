<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

/**
 * @author Shmavon Gazanchyan
 * @since 27.10.2011
 */

class Auth {
	
	private $ci;
	private $db;
	
	/**
	 * Class constructor
	 * @return void
	 */
	public function __construct()
    {
		$this->ci =& get_instance();
		$this->db = $this->ci->doctrine->em;
		if (!in_array('auth_lang.php', $this->ci->lang->is_loaded, TRUE))
		{
			$this->ci->lang->load('auth');
		}
	}
	
	/**
	 * Create a user in database
	 * @param string username
	 * @param string email
	 * @param string password
	 * @param int type
	 * @return boolean | error message
	 */
	public function createUser($username, $email, $password, $type = '0')
	{
		// ToDo: send an email
		if($this->isUsernameAvailable($username))
		{
			if($this->isEmailAvailable($email))
			{
				try
				{
					$user = new models\User;
					$user->setUsername($username);
					$user->setUserEmail($email);
					$user->setUserPass($password);
					$user->setUserType($type);
					$user->setUserCreatedAt(new DateTime());
					$user->setUserLastLogin(new DateTime());
					$user->setUserActive('0');
					$user->setUserActivationKey(do_hash($username.rand().microtime()));
					$this->db->persist($user);
					$this->db->flush();
					return true;
				}
				catch(ErrorException $e)
				{
					return $e->getMessage();
				}
			}
			else
			{
				return translate('email_already_exists');
			}
		}
		else
		{
			return translate('username_already_exists');
		}
	}
	
	/**
	 * Delete a user from the database
	 * @param int user ID
	 * @return void
	 */
	public function deleteUser($user_id)
	{
		// ToDo: check current user for permission
		$user = $this->db->find('models\User', $id);
		$this->db->remove($user);
		$this->db->flush();
	}
	
	/**
	 * User login
	 * @param string username
	 * @param string password
	 * @param boolean remeber the user or not
	 * @return boolean | error message
	 */
	public function login($username, $password, $remember)
	{
		$result = 0;
		if($username && $password)
		{
			$query = $this->db->createQueryBuilder();
			$query = $query->select('u')
							->from('models\User', 'u')
							->where('u.user_name = ?1')
							->andWhere('u.user_pass = ?2')
							->setParameters(array(1 => $username, 2 => $password))
							->getQuery();
			$result = $query->getResult();
		}
		if(count($result) === 1)
		{
			if($result[0]->getUserActive())
			{
				$this->ci->session->set_userdata('user_id', $result[0]->getUserId());
				$this->ci->input->set_cookie('remember', $remember);
				return true;
			}
			else
			{
				return translate('activation_needed');
			}
		}
		else
		{
			return translate('no_user');
		}
	}
	
	/**
	 * Destroy user session
	 * @return void
	 */
	public function logout()
	{
		$this->ci->input->set_cookie();
		$this->ci->session->sess_destroy();
	}
	
	/**
	 * Check if user is already logged in
	 * @return boolean
	 */
	public function isLoggedIn()
	{
		if($this->ci->session->userdata('user_id'))
		{
			return true;
		}
			return false;
	}
	
	/**
	 * Gets current user ID
	 * @return int ID
	 */
	public function getUserId()
	{
		if($this->isLoggedIn())
		{
			return $this->ci->session->userdata('user_id');
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Gets current user name
	 * @return string username
	 */
	public function getUsername()
	{
		if($this->isLoggedIn())
		{
			$id = $this->getUserId();
			$user = $this->db->find('models\User', $id);
			return $user->getUserName();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Gets current user email
	 * @return string email
	 */
	public function getEmail()
	{
		if($this->isLoggedIn())
		{
			$id = $this->getUserId();
			$user = $this->db->find('models\User', $id);
			return $user->getUserEmail();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Gets all user data in array
	 * @return array of user information
	 */
	public function getAllData()
	{
		if($this->isLoggedIn())
		{
			$id = $this->getUserId();
			$user = $this->db->find('models\User', 1);
			return $user->getArray();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Checks is username is available in the database
	 * @param string username
	 * @return boolean
	 */
	public function isUsernameAvailable($username)
	{
		if($username)
		{
			$query = $this->db->createQueryBuilder();
			$query = $query->select('count(u)')
							->from('models\User', 'u')
							->where('u.user_name = ?1')
							->setParameters(array(1 => $username))
							->getQuery();
			$result = $query->getSingleScalarResult();
			if($result == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Checks is email is available in the database
	 * @param string email
	 * @return boolean
	 */
	public function isEmailAvailable($email)
	{
		if($email)
		{
			$query = $this->db->createQueryBuilder();
			$query = $query->select('count(u)')
							->from('models\User', 'u')
							->where('u.user_email = ?1')
							->setParameters(array(1 => $email))
							->getQuery();
			$result = $query->getSingleScalarResult();
			if($result == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Activates user in the database
	 * @param int user ID
	 * @param string activation key
	 * @return boolean
	 */
	public function activateUser($user_id, $activation_key)
	{
		if($activation_key)
		{
			$user = $this->db->find('models\User', $user_id);
			if($user->getUserActive() == 0 && ($user->getUserActivationKey() == $activation_key))
			{
				$user->setUserActive(1);
				$user->flush();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function forgotPassword($username)
	{
		// ToDo;
	}
	
	public function resetPassword($user_id, $password, $new_password)
	{
		// ToDo;
	}
}