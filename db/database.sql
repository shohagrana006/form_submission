CREATE DATABASE IF NOT EXISTS form_submission;
USE form_submission;

CREATE TABLE IF NOT EXISTS submissions (
    id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    amount INT(10) NOT NULL,
    buyer VARCHAR(255) NOT NULL,
    receipt_id VARCHAR(20) NOT NULL,
    items VARCHAR(255) NOT NULL,
    buyer_email VARCHAR(50) NOT NULL,
    buyer_ip VARCHAR(20) NOT NULL,
    note TEXT NOT NULL,
    city VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    hash_key VARCHAR(255) NOT NULL,
    entry_at DATE NOT NULL,
    entry_by INT(10) NOT NULL
);
