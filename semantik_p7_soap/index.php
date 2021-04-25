<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <title>SOAP</title>
</head>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
<?php
require_once('lib/nusoap.php');
$client = new nusoap_client('http://localhost/semantik_p7_soap/server/server.php?wsdl', true);
// , array('trace' => 1) 
$err = $client->getError();
if ($err) {
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

$client->call('readxml', '');

$client->call('readrdf', '');

if (isset($_POST['tambah_mhs'])) {
    if (isset($_FILES['foto']['name'])) {
        $targetDirectory = 'uploads/';
        $fileExtension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $newFileName = $_POST['nrp'] . '.' . $fileExtension;
        $targetFile = $targetDirectory . $newFileName;
        if ($_FILES['foto']['size'] > 1024 * 2048) {
            echo '<div>Upload error. File size exceed 2MB</div>';
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile);
        }
    }
    if ($fileExtension == null) {
        $param = array(
            "nrp" => $_POST['nrp'],
            "nama" => $_POST['nama'],
            "foto" => null,
            "prodi" => $_POST['prodi'],
            "fakultas" => $_POST['fakultas'],
            "universitas" => $_POST['universitas']
        );
        $result = $client->call("create", array($param));
        // try{$result = $client->call("create", array($param));
        // } catch (\Exception $e) {
        //     throw new \Exception("Soup Request Failed! Response:\n" . $client->__getLastResponse());
        // }
    } else {
        $param = array(
            "nrp" => $_POST['nrp'],
            "nama" => $_POST['nama'],
            "foto" => $newFileName,
            "prodi" => $_POST['prodi'],
            "fakultas" => $_POST['fakultas'],
            "universitas" => $_POST['universitas']
        );
        $result = $client->call("create", array($param));
    }
    if ($client->fault) {
        echo 'Error: ';
        print_r($result);
    } else {
        // check result
        $err_msg = $client->getError();
        if ($err_msg) {
            // Print error msg
            echo 'Error: ' . $err_msg;
        } else {
            // Print result
            echo 'Result: ';
            print_r($result);
        }
    }
    // var_dump($param);
    if ($result['status'] == 1) {
        echo 'Berhasil menyimpan data';
    } else {
        echo 'Gagal menyimpan data';
    }
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SOAP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Button trigger modal -->
        <div class="mt-2 mb-2"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#jsonModal">
                JSON
            </button>
            <a class="btn btn-info" href="server/mahasiswa.xml" target="_blank">RSS</a>
            <a class="btn btn-info" href="server/rdf.txt" target="_blank">RDF Triples</a>
            <button class="btn btn-warning" onClick="window.location.reload();">Refresh Page</button>
        </div>

        <form method="POST" action="" enctype="multipart/form-data" class="mb-3">
            <h1>Form Mahasiswa</h1>
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" require>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Masukkan foto</label>
                <input class="form-control" type="file" id="formFile" class="foto" name="foto">
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi" placeholder="Program Studi">
            </div>
            <div class="mb-3">
                <label for="fakultas" class="form-label">Fakultas</label>
                <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Fakultas">
            </div>
            <div class="mb-3">
                <label for="universitas" class="form-label">Universitas</label>
                <input type="text" class="form-control" id="universitas" name="universitas" placeholder="Universitas">
            </div>
            <input class="btn btn-primary" type="submit" value="Tambah Mahaiswa" name="tambah_mhs" />
        </form>
        <table class="table table-striped display" id="table">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Universitas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $param = "";
                $result = $client->call('readall', array($param));



                if (!empty($result)) {
                    // var_dump($result);
                    foreach ($result as $row) {
                ?>
                        <tr>
                            <td><?php echo $row['nrp'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo "<img width=100 src='uploads/" . $row['foto'] . "' alt='" . $row['foto'] . "' /img>" ?></td>
                            <td><?php echo $row['prodi'] ?></td>
                            <td><?php echo $row['fakultas'] ?></td>
                            <td><?php echo $row['universitas'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- MODAL JSON -->
    <div class="modal" id="jsonModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bentuk JSON</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?php
                        echo ($client->call('readjson', array($param)));
                        ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




</body>

</html>