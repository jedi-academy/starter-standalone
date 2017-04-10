<?php

/**
 * Factory class implements database CRUD operations.
 *
 * @author Fred Yang, 4O
 */
class Factory extends CI_Model {
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // retrieve a single quote
    public function get($table, $which)
    {
        $query = $this->db->select('*')
                      ->where("id = '$which'")
                      ->get($table);
        return $query->result();
    }   
    
    
    // retrieve all of the quotes
    public function all($table)
    {
        $this->db->from($table);
        $query = $this->db->get(); 
        return $query->result();
    }    
    
    // add Orderitems. $order: order number, $item: item id, $quantity:
    // number of items ordered, $special: item name.
    public function addOrderItems($order, $item, $quantity, $special)
    {
        $this->db->trans_start();
        $data = array( 
            'order' => $order,
            'item' => $item,
            'quantity' => $quantity,
            'special' => $special);
        $this->db->insert('Orderitems', $data);
        $this->db->trans_complete();
    }

    // add Orders. $num: order number, $date: order date,
    // $total: total amount of the order.
    public function addOrders($num, $date, $total)
    {
        $this->db->trans_start();
        $data = array( 
            'num' => $num,
            'date' => $date,
            'status' => '1',
            'total' => $total,
            'customer' => 'Group5');
        $this->db->insert('Orders', $data);
        $this->db->trans_complete();
    }
}

