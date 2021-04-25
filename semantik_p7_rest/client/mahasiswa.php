<?php

?>

<form method="POST" action="" enctype="multipart/form-data">
    <h2>Mahasiswa Form</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">NRP</label>
                <input class="input--style-4" type="text" name="txtNRP" placeholder="New Nrp" required="">
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
                <label class="label">Foto</label>
                <input class="input--style-4" type="file" name="foto" accept="image/png, image/jpeg">
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



<table id="tableId" class="display">
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
        // var_dump($list_mahasiswa);
        foreach ($list_mahasiswa as $mahasiswa) {
        ?>
            <tr>
                <td><?php echo $mahasiswa->nrp ?></td>
                <td><?php echo $mahasiswa->nama ?></td>
                <td>
                    <?php
                    $foto = $mahasiswa->foto;
                    if (isset($foto)) {
                        if ($foto == null) {
                            echo '<img class="img-tbl" width=100 src="images/default.jpg">';
                        } else {
                            echo '<img class="img-tbl" width=100 src="uploads/' . $foto . '">';
                        }
                    } else {
                        echo '<img class="img-tbl" width=100 src="images/default.jpg">';
                    }
                    ?>
                </td>
                <td><?php echo $mahasiswa->prodi ?></td>
                <td><?php echo $mahasiswa->fakultas ?></td>
                <td><?php echo $mahasiswa->universitas ?></td>
            <?php

        }
            ?>
            </tr>
    </tbody>
</table>