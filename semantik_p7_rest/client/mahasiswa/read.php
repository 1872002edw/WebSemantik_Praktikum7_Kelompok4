<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/mahasiswa.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$mahasiswa = new Mahasiswa($db);

// query artists
$stmt = $mahasiswa->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // artists array
    $mahasiswa_arr = array();
    $mahasiswa_arr["records"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item = array(
            "nrp" => $nrp,
            "nama" => $nama,
            "prodi" => $prodi,
            "fakultas" => $fakultas,
            "universitas" => $universitas
        );

        array_push($mahasiswa_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show artists data in json format
    echo json_encode($mahasiswa_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no mahasiswa found
    echo json_encode(
        array("message" => "No mahasiswa found.")
    );
}
