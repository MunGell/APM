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
	}
	
	function createUser($username, $email, $password, $type)
	{
		if($this->isUsernameAvailable($username) && $this->isEmailAvailable($email))
		{
			try
			{
				$user = new models\User;
				$user->setUsername($username);
				$user->setUserEmail($email);
				$user->setUserPass($pass);
				$user->setUserCreatedAt(date("Y-m-d H:i:s"));
				$user->setUserActive('0');
				$user->setUserActivateKey(do_hash($username.rand().microtime()));
				$this->db->persist($user);
				$this->db->flush();
				return true;
			}
			catch(ErrorException $e)
			{
				show_error($e->getMessage());
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function deleteUser($user_id)
	{
		/*$query = $this->db->createQueryBuilder();
		$query = $query->delete('models\User', 'u')
			  		   ->where('u.user_id = ?1')
			  		   ->setParameters(array(1 => $user_id))
			  		   ->getQuery();
		return $query->getResult();*/
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
			$this->ci->session->set_userdata('user_id', $result[0]->getUserId());
			$this->ci->input->set_cookie('remember', $remember);
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
			if($result === 0)
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
			if($result === 0)
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
			if($user->getUserActive() == 0 && ($user->getUserActivateKey() == $activation_key))
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
}