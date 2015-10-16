<?php
class v_auth 
{
	private $style = 'css/auth.css';
	private $title = 'Авторизация';
	public function response($message, $user, $password)
	{
		$this->user = $user;
		$this->password = $password;
		$this->message = $message;
		if (is_null($this->message)) {
			$this->message = 'Всё плохо...';
		} elseif ($this->message) {
			$this->message = 'Ваш адрес заблокирован на 3 минуты';
		} else {
			$this->message = 'Тестовая версия. <br>Логин и пароль: admin@bank.com 12345';
			$this->message .= '<br>Логин и пароль: some any';
			$this->message .= '<br>Логин и пароль: unknow unknow';
		}
		$this->json = json_encode($this->message);
		ob_start();
		include 'html/auth.html';
		$body = ob_get_clean();
		include 'html/shell.html';
	}
}