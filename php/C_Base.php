<?php
class C_Base
{
	public function getVars($box)
	{ 
		foreach($box as $k => $v) { 
			$v = htmlentities($v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8');
			$this->$k = $v;
		}
	}
	
	protected function initialize()
	{
		for ($i = 0, $c = func_num_args(); $i < $c; $i++) {
			$arg = func_get_arg($i);
			if(!isset($this->$arg)) $this->$arg = null;
		}
	}
	
	public function huri()
	{	
		if (isset($_GET['uri'])) $request = $GLOBALS['_GET']['uri'];
		if(empty($request)) {
			$page = '';
		} else {
			$meta = explode(".", $request);
			foreach($meta as $key => $into) 
			{
				if($into == '') unset($meta[$key]);
			}
			$page = $meta;
		}
		$this->page = $page;
	}
	
	public static function whatIsIt()
	{
		for($i = 1, $c = func_num_args(); $i < $c; $i++) {
			$v = func_get_arg($i);
			if (!empty($v)) {
				if (func_get_arg(0) === 's' && is_string($v) && trim($v) != false) {
					return true;
				} elseif (func_get_arg(0) === 'a' && is_array($v)) {
					return true;
				}
			}
			return false;
		}
	}
	
	public function auth()
	{
		self::initialize('user', 'password', 'action');
		$auth = new C_Auth($this->user, $this->password, $this->action);
		$auth->control();
		if ($auth->check === true) {
			echo 'Очевидно, что вы теперь авторизированный пользователь.';
		} else {
			//echo 'Не авторизирован';
		}
	}
	
	public function before()
	{
		
	}
	

}

?>