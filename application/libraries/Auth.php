<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

/**
 * @author Shmavon Gazanchyan
 * @since 27.10.2011
 */

class Auth {
	
	private $ci;
	private $db;
	
	function __construct()
    {
		$this->ci =& get_instance();
		$this->db = $this->ci->doctrine->em;
		if (!in_array('auth_lang.php', $this->ci->lang->is_loaded, TRUE))
		{
			$this->ci->lang->load('auth');
		}
	}
	
	function createUser($username, $email, $password, $type = '0')
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
					$user->setUserType('0');
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
				return $this->_translation('email_already_exists');
			}
		}
		else
		{
			return $this->_translation('username_already_exists');
		}
	}
	
	function deleteUser($user_id)
	{
		// ToDo: check current user for permission
		$user = $this->db->find('models\User', $id);
		$this->db->remove($user);
		$this->db->flush();
	}
	
	function login($username, $password, $remember)
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
				return $this->_translation('activation_needed');
			}
		}
		else
		{
			return $this->_translation('no_user');
		}
	}
	
	function logout()
	{
		$this->ci->input->set_cookie();
		$this->ci->session->sess_destroy();
	}
	
	function isLoggedIn()
	{
		if($this->ci->session->userdata('user_id'))
		{
			return true;
		}
			return false;
	}
	
	function getUserId()
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
	
	function getUsername()
	{
		if($this->isLoggedIn())
		{
			$id = $this->getUserId();
			$user = $this->db->find('models\User', $id);
			return $user->getUsername();
		}
		else
		{
			return false;
		}
	}
	
	function getAllData()
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
	
	function isUsernameAvailable($username)
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
	
	function isEmailAvailable($email)
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
	
	function activateUser($user_id, $activation_key)
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
	
	function forgotPassword($username)
	{
		// ToDo;
	}
	
	function resetPassword($user_id, $password, $new_password)
	{
		// ToDo;
	}
	
	private function _translation($line, $values = array())
	{
		if($count = count($values) > 0)
		{
			$line = $this->ci->lang->line($line);
			for($i = 0; $i < $count; $i++)
			{
				$line = str_replace('%'.($i+1), $values[$i], $line);
			}
			return $line;
		}
		else
		{
			return $this->ci->lang->line($line);
		}
	}
}