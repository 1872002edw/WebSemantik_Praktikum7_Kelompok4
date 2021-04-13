<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $name = filter_input(INPUT_POST, "txtName");
    echo 'Hello, ' . $name;
}
?>
<form method="post" action="">
<div class="row row-space">
    <div class="col-2">
        <div class="input-group">
            <label class="label">Your name</label>
            <input class="input--style-4" id="idTxtName" type="text" name="txtName" autofocus="" placeholder="Your Name" required="">
        </div>
    </div>
</div>

<div class="p-t-10">
    <input class="btn btn--radius-2 btn--blue" type="submit" Value="Submit" name="btnSubmit" />
</div>
</form>