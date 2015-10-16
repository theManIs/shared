<?php
class V_easyTable
{
	public function __construct($aim)
	{
		$this->aim = $aim;
		$this->table = '<table>';
	}

	public function tHead()
	{
		$thead = '<tr>';
		$i = 0; $c = func_num_args();
		while ($i < $c) {
			$thead .= '<th>' . func_get_arg($i);
			$i++;
		}
		$this->table .= $thead;
	}
	
	public function tCaption($caption)
	{
		$this->table .= '<caption>' . $caption . '</caption>';
	}
	
	public function getHTML()
	{
		ob_start();
		echo $this->table;
		return ob_get_clean();
	}
	
	public function tBody()
	{
		$column = func_get_args();
		foreach($this->aim as $v) {
			$this->table .= '<tr>';
			for($i = 0, $f = count($column); $i < $f; $i++) {
				if (is_int($column[$i]) && $column[$i] < $f) {
					$this->table .= '<td>' . $v[$column[$i]];
				} elseif (is_string($column[$i])) {
					if (isset($v[$column[$i]])) {
						$this->table .= '<td>' . $v[$column[$i]];
					} elseif ($column[$i] === 'counter') {
						$this->table .= '<td>' . self::counter();
					} else { 
						$this->table .= '<td>' . $column[$i];
					}
				} elseif (is_array($column[$i])) {
					exit('Нельзя передавать в таблицу массив!');
				}
			}
		}
		$this->table .= '</table>';
	}
	
	public function counter()
	{
		static $counter = 1;
		return $counter++;
	}
}
?>