<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class ReportModel extends Model
{
    public function getSubmissions($startDate = null, $endDate = null, $userId = null)
    {
        $sql = "SELECT * FROM submissions WHERE 1=1";
        $params = [];

        if (!empty($startDate) && !empty($endDate)) {
            $sql .= " AND entry_at BETWEEN :start_date AND :end_date";
            $params['start_date'] = $startDate;
            $params['end_date'] = $endDate;
        }

        if (!empty($userId)) {
            $sql .= " AND entry_by = :user_id";
            $params['user_id'] = $userId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
