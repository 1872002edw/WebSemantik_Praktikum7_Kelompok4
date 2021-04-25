<?php
require_once('lib/nusoap.php');
$ns = "http://" . $_SERVER['HTTP_HOST'] . "/semantik_p7_soap/server/server.php"; //setting namespace
$server = new soap_server();
$server->configureWSDL('WEB SERVICE MAHASISWA', 'urn:mahasiswaServerWSDL'); // configure WSDL file
$server->wsdl->schemaTargetNamespace = $ns; // server namespace
########################Data Mahasiswa##############################################################
// Complex Array Keys and Types Data Mahasiswa++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType(
    "mahasiswaData",
    "complexType",
    "struct",
    "all",
    "",
    array(
        "nrp" => array("name" => "nrp", "type" => "xsd:string"),
        "nama" => array("name" => "nama", "type" => "xsd:string"),
        "foto" => array("name" => "foto", "type" => "xsd:string"),
        "prodi" => array("name" => "prodi", "type" => "xsd:string"),
        "fakultas" => array("name" => "fakultas", "type" => "xsd:string"),
        "universitas" => array("name" => "universitas", "type" => "xsd:string")
    )
);
// Complex Array Data Mahasiswa++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType(
    "mahasiswaArray",
    "complexType",
    "array",
    "",
    "SOAP-ENC:Array",
    array(),
    array(
        array(
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:mahasiswaData[]"
        )
    ),
    "mahasiswaData"
);

//Method Membaca Data mahasiswa
$server->register(
    'readall', // method name
    //$input_readall,
    //$return_readall,
    array('input' => 'xsd:String'), // input parameters
    array('output' => 'xsd:Array'), // output parameters
    $ns, // namespace
    "urn:" . $ns . "/readall", // soapaction
    "rpc", // style
    "encoded", // use
    "Mengambil Semua Data Mahasiswa"
); // documentation
//Ambil Semua Data Barang

function readall()
{

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "latihansemantik";

    $con = new mysqli($server, $username, $password, $database);
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }
    $r = $con->query("SELECT * FROM mahasiswa");
    while ($value = $r->fetch_assoc()) {
        $return_value[] = array(
            'nrp' => $value['nrp'],
            'nama' => $value['nama'],
            'foto' => $value['foto'],
            'prodi' => $value['prodi'],
            'fakultas' => $value['fakultas'],
            'universitas' => $value['universitas']
        );
    }
    return $return_value;
}



//Method Create Data Mahasiswa
$server->register(
    'create',
    array('input' => 'xsd:Array'),
    array('output' => 'xsd:Array'),
    $ns,
    "urn:" . $ns . "/create",
    "rpc",
    "encoded",
    "Insert Data Mahasiswa"
);
function create($param)
{
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "latihansemantik";

    $con = new mysqli($server, $username, $password, $database);
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }
    $r = $con->query("INSERT INTO mahasiswa (nrp,nama,foto,prodi,fakultas,universitas) 
    VALUES('$param[nrp]','$param[nama]','$param[foto]','$param[prodi]','$param[fakultas]','$param[universitas]')");
    if ($r === true) {
        $s = 1;
    } else {
        $s = 0;
    }
    $return_value = array('status' => $s, 'error' =>mysqli_error($con));
    return $return_value;
}


//Method Membaca JSON
$server->register(
    'readjson', // method name
    //$input_readall,
    //$return_readall,
    array('input' => 'xsd:String'), // input parameters
    array('output' => 'xsd:String'), // output parameters
    $ns, // namespace
    "urn:" . $ns . "/readjson", // soapaction
    "rpc", // style
    "encoded", // use
    "Mengambil Semua Data JSON Mahasiswa"
); // documentation


function readjson()
{

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "latihansemantik";

    $con = new mysqli($server, $username, $password, $database);
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }
    $r = $con->query("SELECT * FROM mahasiswa");
    while ($value = $r->fetch_assoc()) {
        $return_value[] = array(
            'nrp' => $value['nrp'],
            'nama' => $value['nama'],
            'foto' => $value['foto'],
            'prodi' => $value['prodi'],
            'fakultas' => $value['fakultas'],
            'universitas' => $value['universitas']
        );
    }
    return json_encode($return_value);
}


//Method Membaca RSS
$server->register(
    'readxml', // method name
    //$input_readall,
    //$return_readall,
    array('input' => 'xsd:String'), // input parameters
    array('output' => 'xsd:String'), // output parameters
    $ns, // namespace
    "urn:" . $ns . "/readxml", // soapaction
    "rpc", // style
    "encoded", // use
    "Mengambil Semua Data XML Mahasiswa"
); // documentation


function readxml()
{

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "latihansemantik";

    $con = new mysqli($server, $username, $password, $database);
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }
    $r = $con->query("SELECT * FROM mahasiswa");
    while ($value = $r->fetch_assoc()) {
        $return_value[] = array(
            'nrp' => $value['nrp'],
            'nama' => $value['nama'],
            'foto' => $value['foto'],
            'prodi' => $value['prodi'],
            'fakultas' => $value['fakultas'],
            'universitas' => $value['universitas']
        );
    }

    //buat XML Document
    $xmlDoc = new DOMDocument("1.0", "UTF-8");
    $tabRss = $xmlDoc->appendChild($rssTag = $xmlDoc->createElement("rss"));
    $rssTag->setAttribute('version','2.0');
    $tabChannel = $tabRss->appendChild($xmlDoc->createElement("channel"));
    $tabTitle = $tabChannel->appendChild($xmlDoc->createElement("title","Mahasiswa"));
    $tabLink = $tabChannel->appendChild($xmlDoc->createElement("link","http://www.praktikum.com/maranatha"));
    $tabDescription = $tabChannel->appendChild($xmlDoc->createElement("description","Isi detail data mahasiswa"));
    foreach ($return_value as $data) {
        if (!empty($data)) {
            $tabMahasiswa = $tabChannel->appendChild($xmlDoc->createElement("item"));
            foreach ($data as $key => $val) {
                $tabMahasiswa->appendChild($xmlDoc->createElement($key, $val));
            }
        }
    }

    header("Content-Type: text/plain");

    //make output pretty
    $xmlDoc->formatOutput = true;
    $xmlDoc->save("mahasiswa.xml");
    return $xmlDoc->saveXML();
}


//Method Membaca RDF
$server->register(
    'readrdf', // method name
    //$input_readall,
    //$return_readall,
    array('input' => 'xsd:String'), // input parameters
    array('output' => 'xsd:String'), // output parameters
    $ns, // namespace
    "urn:" . $ns . "/readxml", // soapaction
    "rpc", // style
    "encoded", // use
    "Melihat bentuk RDF N-Triples"
); // documentation


function readrdf()
{

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "latihansemantik";

    $con = new mysqli($server, $username, $password, $database);
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }
    $r = $con->query("SELECT * FROM mahasiswa");
    while ($value = $r->fetch_assoc()) {
        $return_value[] = array(
            'nrp' => $value['nrp'],
            'nama' => $value['nama'],
            'foto' => $value['foto'],
            'prodi' => $value['prodi'],
            'fakultas' => $value['fakultas'],
            'universitas' => $value['universitas']
        );
    }

    //buat XML Document
    $nTriples = '';

    $URI = 'http://www.praktikum.com/maranatha';

    foreach ($return_value as $data) {
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key != 'nrp') {
                    $nTriples .= '<' . $URI . '/' . $data['nrp'] . '>';
                    $nTriples .= ' <' . $URI . '#has' . $key . '>';
                    $nTriples .= ' "' . $val . '" .' . "\n";
                }
            }
            $nTriples .= "\n";
        }
    }

    file_put_contents("rdf.txt", $nTriples);

    return $nTriples;
}

/////////////////////////
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
@$server->service(file_get_contents("php://input"));
