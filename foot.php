<?php
    include("toast.php");
?>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <?php 
        if(isset($_SESSION['admin']))
        { 
            echo '<script src="./js/admin-script.js"></script>';
        }
    ?>
</html>