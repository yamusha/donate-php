<?php
if (!isset($_SESSION))
{
    session_start();
}
unset($_SESSION['user']);
?>
        <script type="text/javascript">
            window.location.href = './';
        </script>
