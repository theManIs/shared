<?php
class M_auth extends M_base
{
	public $message = false;
	public static $storage;
	
	public function __construct($user, $password, $action, $token)
	{
		$this->user = $user; 
		$this->password = $password;
		$this->action = $action;
		$this->token = $token;
	}

	public function sessionToken()
	{ 	
		$session_id = session_id();
		$sess = M_sql::getSelf(M_access::getPDO());
		$sess->insert('sessions')->set('sid', 'user')->bind($session_id, $this->user);
		$sess->getIncrement();
		$this->token = $session_id;
		return true;
	}
	
	public function proof()
	{
		$attempt = M_sql::getSelf(M_access::getPDO());
		$attempt->select('id')->from('persons')->where('user', 'password');
		$attempt->sign('=', '=')->bind($this->user, $this->password);
		$attempt = $attempt->getArray();
		$cnt = M_sql::getSelf(M_access::getPDO());
		$cnt->select('COUNT(ip)')->from('pool')->where('ip')->bind($_SERVER['REMOTE_ADDR']);
		$cnt = $cnt->getArray();
		if (isset($cnt[0]['COUNT(ip)']) && (int)$cnt[0]['COUNT(ip)'] > 5) {
			$this->message = true;
			return false;
		} elseif (parent::what('a', $attempt)) {
			return true;
		} else {
			$try = M_sql::getSelf(M_access::getPDO());
			$try->insert('pool')->set('ip')->bind($_SERVER['REMOTE_ADDR']);
			$try->getIncrement();
			$this->message = null;
			return false;
		}
	}
	
	public function release()
	{
		$rules = '(EXTRACT(HOUR_SECOND FROM NOW())-EXTRACT(HOUR_SECOND FROM `timemark`))';
		$release = M_sql::getSelf(M_access::getPDO());
		$release->delete('pool')->where($rules)->sign('>')->bind('10');
		$release->getDel();
	}
	
	public function quit()
	{
		
		$del = M_sql::getSelf(M_access::getPDO());
		$del->delete('sessions')->where('sid')->bind(session_id());
		$del->getDel();
		session_destroy();
		header('Location: /' . ROOTDIR);
	}
	
	public function checkToken()
	{	
		$check = M_sql::getSelf(M_access::getPDO());
		$check->select('sid, user')->from('sessions')->where('sid')->bind(session_id());
		$check = $check->getArray();
		if (isset($check[0]['sid']) && parent::what('s', $check[0]['sid'])) {
			$this->token = $check[0]['sid'];
			$this->user = $check[0]['user'];
			return true;
		} else {
			return false;
		}
	}
}
?>