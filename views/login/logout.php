<?php
              session_start();
              session_destroy(); // Ends the session
              header("Location: login.php"); // Redirects to login page
              exit();
              ?>