<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Pesan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tiket_id', 'pesan', 'foto', 'user_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function notif()
    {
        $notif = $this->db->table('messages')
            ->select('messages.id,tikets.user_id, tikets.tiket_id , pesan,users.username,messages.created_at')
            ->join('users', 'messages.user_id = users.id')
            ->join('tikets', 'tikets.tiket_id = messages.tiket_id')
            ->join('is_reads', 'messages.id = is_reads.message_id', 'left')
            ->where('tikets.user_id', session('id'))
            ->where('is_reads.read', NULL)
            ->orderBy('created_at', 'desc')
            ->get()->getResult();

        foreach ($notif as $id => $psn) {
            $notif[$id]->created_at = Time::parse($psn->created_at)->humanize();
        }

        return $notif;
    }
}
