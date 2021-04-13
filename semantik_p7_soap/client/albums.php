<?php

?>

<form method="POST" action="" enctype="multipart/form-data">
    <h2>Album Form</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Title</label>
                <input class="input--style-4" type="text" name="txtAlbumsTitle" placeholder="New Albums Title" required="">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Release Date</label>
                <div class="input-group-icon">
                    <input class="input--style-4 js-datepicker" type="text" name="txtAlbumsReleaseDate" required="">
                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Producers</label>
                <input class="input--style-4" type="text" name="txtAlbumsProducers" placeholder="New Albums Release Date" required="">
            </div>
        </div>
    </div>
    <div class="input-group">
        <label class="label">Artists</label>
        <div class="rs-select2 js-select-simple select--no-search">
            <select name="txtArtists">
                <option disabled="disabled" selected="selected" required="">Choose option</option>
                <?php
                
                foreach ($artists as $artist) {
                    echo "<option value='" . $artist->idartists . "'>" . $artist->name . "</option>";
                }
                ?>
            </select>
            <div class="select-dropdown"></div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Cover Album</label>
                <input class="input--style-4" type="file" name="albumsCover" accept="image/png, image/jpeg">
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
            <th>Album ID</th>
            <th>Album Cover</th>
            <th>Title</th>
            <th>Release Date</th>
            <th>Producers</th>
            <th>Artist</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        foreach ($albums as $album) {
        ?>
            <tr>
                <td><?php echo $album->idalbums ?></td>
                <td>
                    <?php
                    $cover = $album->cover;
                    if (isset($cover)) {
                        if ($cover == null) {
                            echo '<img class="img-tbl" width=100 src="images/default.jpg">';
                        } else {
                            echo '<img class="img-tbl" width=100 src="uploads/' . $cover . '">';
                        }
                    } else {
                        echo '<img class="img-tbl" width=100 src="images/default.jpg">';
                    }
                    ?>
                </td>
                <td><?php echo $album->title ?></td>
                <td><?php echo $album->releasedate ?></td>
                <td><?php echo $album->producers ?></td>
                <td><?php echo $album->artists_name ?></td>
                <?php
                if ($_SESSION['my_session']) {
                ?>
                    <td>
                        <button class="btn btn--radius-2 btn--green" type="submit" onclick="updateAlbums('<?php echo $album->idalbums ?>')">Update</button>
                        <button class="btn btn--radius-2 btn--red" type="submit" onclick="deleteAlbums('<?php echo $album->idalbums ?>')">Delete</button>
                    </td>
                <?php
                } else {
                ?>
                    <td>
                        <button disabled class="btn btn--radius-2 btn--grey" type="submit" onclick="updateAlbums('<?php echo $album->idalbums ?>')">Update</button>
                        <button disabled class="btn btn--radius-2 btn--grey" type="submit" onclick="deleteAlbums('<?php echo $album->idalbums ?>')">Delete</button>
                    </td>
            <?php
                }
            }
            ?>

            </tr>
    </tbody>
</table>