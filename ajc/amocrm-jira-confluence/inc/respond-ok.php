<?php
// This returns 200 to the user, and processing continues
session_write_close();
ignore_user_abort(true);
fastcgi_finish_request(); // For fastcgi (php-cgi and php-fpm)
?>
