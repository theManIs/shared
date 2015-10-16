<?php
class V_page extends M_base
{
	public function noAction($user, $password, $token)
	{
		$this->token = $token;
		$this->password = $password;
		$this->user = $user;
		$this->style = 'css/auth.css';
		$this->title = 'Доступные запросы';
		$this->json = json_encode([$user, $token]);
		ob_start();
		include 'html/noAction.html';;
		$body = ob_get_clean();
		include 'html/shell.html';
	}
	
	public function mainAction($oprtns, $actual)
	{
		$this->style = 'css/auth.css';
		$this->title = 'Операции';
		$this->balance = $actual . ' &#8364;';
		$this->lastOperations = $oprtns;
		$this->json = json_encode($this->balance);
		ob_start();
		include 'html/main.html';;
		$body = ob_get_clean();
		include 'html/shell.html';
	}
}
?>