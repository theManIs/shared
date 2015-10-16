<?php
final class C_Controller
{
	public function __construct()
	{
		$base = new C_Base();
		$base->session();
		$base->getVars($_COOKIE);
		$base->getVars($_REQUEST);
		if ($base->auth()) {
			$base->before();
			$base->play();
		}
		$base->end();
	}
}

?>