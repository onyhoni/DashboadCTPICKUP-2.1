<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Tiket extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tikets';
    protected $useSoftDeletes   = true;
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $db;
    protected $allowedFields = ['tiket_id', 'case_id', 'desc', 'status', 'urgency', 'awb', 'no_order', 'nama_pic', 'account', 'origin', 'regional', 'nama_kota', 'customer_name', 'seller_name', 'merchant_id', 'seller_address', 'seller_phone', 'destinasi', 'service', 'intruksi', 'ins_value', 'cod_flag', 'cod_amount', 'armada', 'modul_entry', 'desc_good', 'qty', 'weight', 'city_id', 'user_id'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function Search($id)
    {

        $builder = $this->db->table('tikets')
            ->where('tiket_id', $id);

        $query = $builder->get()->getRowArray();

        return $query;
    }

    public function Edit($id)
    {
        $data = [
            'status' => 'PROGRESS'
        ];
        $this->db->table('tikets')
            ->update($data, ['tiket_id' => $id]);
    }

    public function Close($id, $status)
    {
        $data = [
            'status' => $status,
            'closed_at' => Time::now()
        ];
        $this->db->table('tikets')
            ->update($data, ['tiket_id' => $id]);
    }
}
