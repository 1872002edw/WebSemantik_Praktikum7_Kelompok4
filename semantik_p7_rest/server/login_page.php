<?php
$signInPressed = filter_input(INPUT_POST,'btnSignIn');
if ($signInPressed) {
    $username = filter_input(INPUT_POST,'txtUsername');
    $password = filter_input(INPUT_POST,'txtPassword');
    $md5Password = md5($password);
    $result = login($username,$md5Password);
    if ($result !=null && $result['username'] == $username) {
        $_SESSION['my_session'] = true;
        $_SESSION['session_user'] = $result['name'];
        header("location:index.php");
    } else {
        echo '<div class="bg-error">Invalid username or password</div>';
    }
}
?>

<form method="post" class="form-sign-in">
    <h1>Please sign in</h1>
    <label for="txtUsername" class="label">Username</label>
    <input type="text" id="txtUsername" name="txtUsername" autofocus required
    placeholder="Username" class="input--style-4">
    <label for="txtPassword" class="label">Password</label>
    <input type="password" id="txtPassword" name="txtPassword" required placeholder="Password"
    class="input--style-4">
    <input type="submit" class="btn btn--radius-2 btn--blue" value="Sign In"
    name="btnSignIn">
</form>