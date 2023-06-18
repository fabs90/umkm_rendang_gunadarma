<?php
// Include CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');

// Include init.php file
// require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

// Create object of menu class
$menu = new Menu();
$db = new connection();
// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// get id from url
$id = intval($_GET['id'] ?? '');

// Get all or a single menu from database
if ($api == 'GET') {
    if ($id != 0) {
        $data = $menu->show($id);
        $data = $data->fetch_assoc();
        echo json_encode($data);

    } else {
        $data = $menu->index();
        $data = $data->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);

    }
}

// Add a new menu into database
if ($api == 'POST') {
    if ($menu->store([
        'nama' => input::getValue('nama'),
        'deskripsi' => input::getValue('deskripsi'),
        'harga' => input::getValue('harga'),
        'bahan' => input::getValue('bahan'),
        'gambar' => $_FILES['gambar']['name'],
    ])) {
        echo $db->message('menu added successfully!', false);
    }
    echo $db->message('Failed to add an menu!', true);
}

// Update an menu in database
if ($api == 'PUT') {
    parse_str(file_get_contents('php://input'), $post_input);

    if ($id != null) {
        if ($menu->update($id, [
            'nama' => input::getValue('nama'),
            'deskripsi' => input::getValue('deskripsi'),
            'harga' => input::getValue('harga'),
            'bahan' => input::getValue('bahan'),
            'gambar' => $_FILES['gambar']['name'],
        ])) {
            echo $db->message('menu updated successfully!', false);
        } else {
            echo $db->message('Failed to update an menu!', true);
        }
    } else {
        echo $db->message('menu not found!', true);
    }

    echo $db->message('menu failed to update!', true);
}

// Delete an menu from database
if ($api == 'DELETE') {
    if ($id != null) {
        if ($menu->destroy($id)) {
            echo $db->message('menu deleted successfully!', false);
        } else {
            echo $db->message('Failed to delete an menu!', true);
        }
    } else {
        echo $db->message('menu not found!', true);
    }
}
