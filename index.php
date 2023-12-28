<?php 
    if(isset($_GET["unRegSW"]) && $_GET["unRegSW"] = "458034859402942") {
        ?>
        <script>
           caches.keys().then(function(names){
            for(let name of names) {
                caches.delete(name);
            }
           });
        </script>
        <?php
    }
    @require("appStart/__allow_include.php");
    @require("config.php");
    @require("appStart/access.php");

?>
<script defer> window.location.replace("/app/in/"); </script>