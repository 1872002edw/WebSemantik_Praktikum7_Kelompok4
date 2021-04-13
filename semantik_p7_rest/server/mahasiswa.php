<?php

$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    //get Data dari form
    $nrp = filter_input(INPUT_POST, "txtNrp");
    $nama = filter_input(INPUT_POST, "txtNama");
    $prodi = filter_input(INPUT_POST, "txtProdi");
    $fakultas = filter_input(INPUT_POST, "txtFakultas");
    $universitas = filter_input(INPUT_POST, "txtUniversitas");

    //buat object utk json nya
    $objMahasiswa = (object) [
        'nrp' => $nrp,
        'nama' => $nama,
        'prodi' => $prodi,
        'fakultas' => $fakultas,
        'universitas' => $universitas
    ];

    //kirim data ke post api
    $url = "http://localhost/cobarestapi/mahasiswa/create.php";
    $content = json_encode($objMahasiswa);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $curl,
        CURLOPT_HTTPHEADER,
        array("Content-type: application/json")
    );
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($status = 200) {
        echo $json_response;
    }

    curl_close($curl);
}
?>

<form method="POST" action="">
    <h2>Mahasiswa Form</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">NRP</label>
                <input class="input--style-4" type="text" name="txtNrp" placeholder="New NRP" required="">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Nama</label>
                <input class="input--style-4" type="text" name="txtNama" placeholder="New Nama" required="">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Prodi</label>
                <input class="input--style-4" type="text" name="txtProdi" placeholder="New Prodi" required="">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Fakultas</label>
                <input class="input--style-4" type="text" name="txtFakultas" placeholder="New Fakultas" required="">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Universitas</label>
                <input class="input--style-4" type="text" name="txtUniversitas" placeholder="New Universitas" required="">
            </div>
        </div>
    </div>
    <div class="p-t-15">
        <input class="btn btn--radius-2 btn--blue" type="submit" Value="Submit" name="btnSubmit" />
    </div>
</form>

<br />

<?php
$json = file_get_contents("http://localhost/cobarestapi/mahasiswa/read.php");
$result = json_decode($json, true);
?>

<table id="tableId" class="display">
    <thead>
        <tr>
            <th>NRP</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Fakultas</th>
            <th>Universitas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result['records'] as $row) {
        ?>
            <tr>
                <td><?php echo $row['nrp'] ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['prodi'] ?></td>
                <td><?php echo $row['fakultas'] ?></td>
                <td><?php echo $row['universitas'] ?></td>
            </tr>
        <?php
        }
        $link = null;
        ?>
    </tbody>
</table>