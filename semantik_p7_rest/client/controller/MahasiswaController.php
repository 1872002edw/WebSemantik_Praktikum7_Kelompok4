<?php

class MahasiswaController
{
    public function index()
    {
        $submitPressed = filter_input(INPUT_POST, "btnSubmit");
        if ($submitPressed) {
            //get Data dari form
            $nrp = filter_input(INPUT_POST, "txtNRP");
            $nama = filter_input(INPUT_POST, "txtNama");
            $prodi = filter_input(INPUT_POST, "txtProdi");
            $fakultas = filter_input(INPUT_POST, "txtFakultas");
            $universitas = filter_input(INPUT_POST, "txtUniversitas");

            if (isset($_FILES['foto']['name'])) {
                $targetDirectory = 'uploads/';
                $fileExtension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $newFileName = $nrp . '.' . $fileExtension;
                $targetFile = $targetDirectory . $newFileName;
                if ($_FILES['foto']['size'] > 1024 * 2048) {
                    echo '<div>Upload error. File size exceed 2MB</div>';
                } else {
                    move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile);
                }
            }
            if ($fileExtension == null) {
                $sendData = array('nrp' => $nrp, 'nama' => $nama, 'prodi' => $prodi, 'fakultas' => $fakultas, 'universitas' => $universitas);
                $wsResponse = Utility::curl_post(ApiService::ADD_MAHASISWA_URL, $sendData);
                $result = json_decode($wsResponse);
            } else {
                $sendData = array('nrp' => $nrp, 'nama' => $nama, 'foto'=>$newFileName, 'prodi' => $prodi, 'fakultas' => $fakultas, 'universitas' => $universitas);
                $wsResponse = Utility::curl_post(ApiService::ADD_MAHASISWA_URL, $sendData);
                $result = json_decode($wsResponse);
            }
            if ($result) {
                echo '<div class="bg-success">Data Successfully added (Mahasiswa: ' . $nrp . ' - ' . $nama . ')</div>';
            } else {
                echo '<div class="bg-error">Error add data</div>';
            }
        }
        $wsResponse = Utility::curl_get(ApiService::ALL_MAHASISWA_URL,array());
        
        $list_mahasiswa = json_decode($wsResponse);
        include_once 'mahasiswa.php';
    }

    
}
