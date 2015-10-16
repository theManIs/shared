<?php
class C_Base extends M_base
{
	public function session()
	{
		session_start();
	}
	public function auth()
	{
		parent::initialize('user', 'password', 'action', 'token');
		$auth = new M_auth($this->user, $this->password, $this->action, $this->token);
		$panel = new V_auth();
		$auth->release();
		if ($this->action === 'quit') {
			$auth->quit();
		} elseif ($auth->checkToken()) {
			$this->token = $auth->token;
			$this->user = $auth->user;
			return true;
		} else {
			if ($this->action === 'auth') {
				if (!$auth->proof()) {
					$panel->response($auth->message, $this->user, $this->password);
				} else {
					$auth->sessionToken();
					$this->token = $auth->token;
					return true;
				}
			} else {
				$panel->response($auth->message, $this->user, $this->password);
				return false;
			}
		}
	}
	
	public function before()
	{
		
	}
	
	public function play()
	{
		new C_page($this->action, $this->user, $this->password, $this->token);
	}
	
	public function end()
	{
		exit;
	}
}

?>