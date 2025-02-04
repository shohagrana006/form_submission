<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ReportModel;

class ReportController extends Controller
{
    public function index()
    {
        $startDate = $_GET['start_date'] ?? null;
        $endDate = $_GET['end_date'] ?? null;
        $userId = $_GET['user_id'] ?? null;

        $reportModel = new ReportModel();
        $submissions = $reportModel->getSubmissions($startDate, $endDate, $userId);
        return view('report', ['submissions' => $submissions]);
    }
}
