<?php
require_once "method.php";
$obj_kontak = new kontak();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_kontak->get_kontak($id);
        } else {
            $obj_kontak->get_contact();
        }
        break;
    case 'POST':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_kontak->update_kontak($id);
        } else {
            $obj_kontak->insert_kontak();
        }
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $obj_kontak->delete_kontak($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}