<?php
class C_page extends M_base
{
	public function __construct($action, $user, $password, $token)
	{
		$page = new V_page();
		$evaluation = new M_page();
		switch ($action) {
			default:
				$page->noAction($user, $password, $token);
			break;
			case 'balance':
				$data = $evaluation->last($user);
				$page->mainAction($evaluation->lastTable($data), $data[0]['actual']);
			break;
		}
	}
}
?>