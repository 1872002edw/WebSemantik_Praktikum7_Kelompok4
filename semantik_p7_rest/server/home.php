<?php
if ($_SESSION['my_session']) {
    echo 'Welcome, ' . $_SESSION['session_user'];
} else {
    echo 'Welcome, guest';
}
