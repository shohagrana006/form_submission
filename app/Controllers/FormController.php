<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\FormModel;
use App\Requests\ReportRequest;

class FormController extends Controller
{
    public function create(){
        session_start();
        // token generate for valid form submit
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        return view('form');
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $data = ReportRequest::validate();
            if(isset($data['err_message'])){
                self::errorWithResponse($data['err_message'],403);
            }
            $formModel = new FormModel();
            if ($formModel->insert($data)) {
                setcookie('submitted', 'true', time() + 86400, "/");
                self::successWithResponse('Form submitted successfully', 201);
            } else {
                self::errorWithResponse('Database error', 500);
            }
        }
    }
}
