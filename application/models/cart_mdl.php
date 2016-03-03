<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cart_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	public function insert($data)
	{
		$this->cart->insert($data);
	}

	public function total()
	{
		return $this->cart->total();
	}

	public function total_items()
	{
		return $this->cart->total_items();
	}

	public function contents()
	{
		return $this->cart->contents();
	}

	public function destroy()
	{
		$this->cart->destroy();
	}

	public function update($data)
	{
		$this->cart->update($data);
	}

	public function exist($id)
	{
		foreach ($this->cart->contents() as $item){
			if($item['id'] == $id){
				return array('rowid' => $item['rowid'],'qty'=> $item['qty']);
			}
		}
		return array();
	}

	public function remove($id)
	{	
		$item = $this->exist($id);
		if(!empty($item))
		{
			$this->update(array('rowid'=> $item['rowid'],'qty'=>0));
		}
	}

}
?>