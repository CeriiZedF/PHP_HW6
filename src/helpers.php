<?php
session_start();

require_once  __DIR__.'/config.php';

function redirect($path) {
    header("Location: $path");
    die();
}

function getPDO() {
    try{
        return new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME,DB_PASSWORD);
    }
    catch (PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

function setValidationError(string $fieldName, string $message) :void {
    $_SESSION['validation'][$fieldName] = $message;
}
function hasValidationError(string $fieldName) :bool {
    return isset($_SESSION['validation'][$fieldName]);
}
function validationErrorAttr(string $fieldName):string {
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}
function validationErrorMessage(string $fieldName): string {
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}
function setOldValue(string $key, mixed $value):void {
    $_SESSION['old'][$key]=$value;
}
function old(string $key){
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}
function uploadFile(array $file, string $prefix='') : string {
    $uploadPath = __DIR__.'/../uploads';
    if(!is_dir($uploadPath)){
        mkdir($uploadPath, 0777, true);
    }
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix.'_'.time().".$ext";
    if(!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")){
        die("Не можливо завантажитий аватар");
    }
    return "uploads/$fileName";
}
function setMessage($type, $messages) {
    $_SESSION['messages'][$type] = $messages;
}

function hasMessage($type) {
    return !empty($_SESSION['messages'][$type]);
}

function getMessage($type) {
    $messages = $_SESSION['messages'][$type] ?? [];

    if (is_array($messages)) {
        unset($_SESSION['messages'][$type]);
        return implode('<br>', $messages);
    } else {
        return '';
    }
}
function findUser(string $email):array|bool {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email'=>$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function currentUser():array|false {
    $pdo = getPDO();
    if(!isset($_SESSION['user'])){
        return false;
    }
    $userId = $_SESSION['user']['id'] ?? null;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id'=>$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function logout():void {
    unset($_SESSION['user']['id']);
    redirect('/');
}
function checkAuth():void {
    if(!isset($_SESSION['user']['id'])){
        redirect('/');
    }
}
function checkGuest(): void {
    if(isset($_SESSION['user']['id'])) {
        redirect('/home.php');
    }
}

