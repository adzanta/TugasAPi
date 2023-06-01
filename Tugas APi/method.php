<?php
require_once "koneksi.php";
class kontak
{
    public function get_contact()
    {
        global $koneksi;
        $query = "SELECT * FROM contact";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'list kontak berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_kontak($id = 0)
    {
        global $koneksi;
        $query = "SELECT * FROM contact";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get kontak berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function insert_kontak()
    {
        global $koneksi;
        $arrcheckpost = array(
            'nama' => '',
            'email' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "INSERT INTO contact SET
nama = '$_POST[nama]',
email = '$_POST[email]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'kontak berhasil ditambahkan'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'kontak tidak berhasil ditambahkan'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function update_kontak($id)
    {
        global $koneksi;
        $arrcheckpost = array(
            'nama' => '',
            'email' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "UPDATE contact SET
nama = '$_POST[nama]',
email = '$_POST[email]'
WHERE id='$id'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Update kontak berhasil'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Update kontak gagal'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function delete_kontak($id)
    {
        global $koneksi;
        $query = "DELETE FROM contact WHERE id=" . $id;
        if (mysqli_query($koneksi, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Hapus kontak berhasil'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Hapus kontak gagal'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}