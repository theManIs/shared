<?php
class M_page extends M_base
{
	public function last($user) 
	{
		$persons_id = M_sql::getSelf(M_access::getPDO());
		$persons_id->select('id')->from('persons')->where('user')->bind($user);
		$persons_id = $persons_id->getArray()[0]['id'];
		$oprtns = M_sql::getSelf(M_access::getPDO());
		$oprtns->select('moment, sum, actual')->from('operations')->limit(10);
		$oprtns->where('persons_id')->bind($persons_id);
		return $oprtns->order('moment DESC')->getArray();
		
	}
	
	public function lastTable($oprtns)
	{
		$easyT = new V_easyTable($oprtns);
		$easyT->tHead('Номер', 'Дата и время', 'Cумма', 'Остаток');
		$easyT->tCaption('Последние операции по счёту');
		$easyT->tBody('counter', 'moment', 'sum', 'actual');
		return $easyT->getHTML();
	}
}
?>