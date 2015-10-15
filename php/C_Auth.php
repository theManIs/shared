<?php
class C_Auth extends C_Base
{
	public $check = false;
	private $style = 'css/auth.css';
	private $title = 'Авторизация';
	private $message = false;
	public static $storage;
	
	public function __construct($user, $password, $action)
	{
		$this->user = $user; 
		$this->password = $password;
		$this->action = $action;
	}

	public function control()
	{
		self::release();
		if ($this->action === 'auth') self::proof();
		if ($this->check === false)	self::response();
	}
	
	private function response()
	{
		if ($this->message) {
			$this->message = 'Ваш аккаунт заблокирован на 3 минуты';
		} else {
			$this->message = 'Тестовая версия. <br>Логин и пароль: admin@bank.com 12345';
		}
		ob_start();
		include 'html/auth.html';
		$body = ob_get_clean();
		include 'html/shell.html';
	}
	
	private function proof()
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
		} elseif (array_key_exists(0, $attempt)) {
			$this->check = true;
			setcookie('user', $this->user, time() + 24 * 3600);
			setcookie('password', $this->password, time() + 24 * 3600);
		}
		$try = M_sql::getSelf(M_access::getPDO());
		$try->insert('pool')->set('ip')->bind($_SERVER['REMOTE_ADDR']);
		$try->getIncrement();
	}
	
	private function release()
	{
		$rules = '(EXTRACT(HOUR_SECOND FROM NOW())-EXTRACT(HOUR_SECOND FROM `timemark`))';
		$release = M_sql::getSelf(M_access::getPDO());
		$release->delete('pool')->where($rules)->sign('>')->bind('300');
		$release->getDel();
	}
	
}
?>