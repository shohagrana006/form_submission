<?php

namespace App\Requests;

class ReportRequest 
{

    public static function validate()
    {
        session_start();

        if (isset($_COOKIE['submitted'])) {
            $validation['err_message'] = 'You have already submitted the form. Please try again after 24 hours.';
            return $validation;
        }

       if(isset($_SESSION['csrf_token'])){
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $validation['err_message'] = 'Invalid CSRF token';
                return $validation;
            }
       }else{
            $validation['err_message'] = 'Remove token';
            return $validation;
       }

        $data = [
                'amount' => filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT),
                'buyer' => isset($_POST['buyer']) && preg_match('/^[a-zA-Z0-9\s]{1,20}$/', $_POST['buyer']) ? $_POST['buyer'] : null,
                'receipt_id' => isset($_POST['receipt_id']) && preg_match('/^[a-zA-Z0-9]+$/', trim($_POST['receipt_id'])) ? $_POST['receipt_id'] : null,
                'buyer_email' => isset($_POST['buyer_email']) && filter_var($_POST['buyer_email'], FILTER_VALIDATE_EMAIL) ? $_POST['buyer_email'] : null,
                'buyer_ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'note' => isset($_POST['note']) && strlen($_POST['note']) > 0 && str_word_count($_POST['note']) <= 30 ? strval($_POST['note']) : null,
                'city' => isset($_POST['city']) && preg_match('/^[a-zA-Z\s]+$/', $_POST['city']) ? $_POST['city'] : null,
                'phone' => isset($_POST['phone']) && preg_match('/^[0-9]+$/', trim($_POST['phone'])) ? $_POST['phone'] : null,
                'entry_by' => filter_input(INPUT_POST, 'entry_by', FILTER_VALIDATE_INT),
            ];

        if ($data['amount'] === false || $data['amount'] === null) {
            $data['amount'] = null;
        }
        if ($data['entry_by'] === false || $data['entry_by'] === null) {
            $data['entry_by'] = null;
        }

        if (in_array(null, $data, true)) {
            $validation['err_message'] = 'Invalid input';
            return $validation;
        }

        if (isset($_POST['items']) && is_array($_POST['items'])) {
            foreach ($_POST['items'] as $index => $item) {
                if (empty(trim($item)) || !preg_match('/^[a-zA-Z]+$/', trim($item))) {
                    $validation['err_message'] = 'All items are required and must contain only letters';
                    return $validation;
                }
            }
            $data['items'] = serialize($_POST['items']);
        } else {
            $validation['err_message'] = 'Items must be an array';
            return $validation;
        }

        $data['hash_key'] = hash('sha512', trim($_POST['receipt_id']) . bin2hex(random_bytes(16)));
        $data['entry_at'] = $_POST['entry_at'] ?? date('Y-m-d');

        return $data;
    }



}