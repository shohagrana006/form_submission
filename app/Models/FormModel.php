<?php

namespace App\Models;

use App\Core\Model;

class FormModel extends Model
{

    public function insert($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO submissions (amount, buyer, receipt_id, buyer_email, buyer_ip, note, city, phone, entry_by, items, hash_key, entry_at)
            VALUES (:amount, :buyer, :receipt_id, :buyer_email, :buyer_ip, :note, :city, :phone, :entry_by, :items, :hash_key, :entry_at)
        ");
        return $stmt->execute($data);
    }
    
}
