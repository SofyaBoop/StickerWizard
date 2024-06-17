<?php
$errMsg_feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_form_btn'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $text = trim($_POST['text']);

    if ($name === '' || $email === '' || $text === '') {
        $errMsg_feedback = "Не все поля заполнены!";
    } elseif (mb_strlen($name, 'UTF8') < 2) {
        $errMsg_feedback = "Имя должно быть более 1-ого символа!";
    } elseif (mb_strlen($text, 'UTF8') < 16) {
        $errMsg_feedback = "Текст должен быть более 15-ти символов!";
    } else {
        $errMsg_feedback = '';
        $feedback = [
            'person_name' => $name,
            'person_email' => $email,
            'text' => $text
        ];

        insert('feedback', $feedback);

        $name = '';
        $email = '';
        $text = '';
    }
} else {
    $name = '';
    $email = '';
    $text = '';
}
