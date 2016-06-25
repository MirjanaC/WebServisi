<?php
/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 9:09 AM
 */

// load up your config file
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(TEMPLATES_PATH . "/header.php");
?>
    <div id="container">
        <div id="content">
            <!-- content -->
        </div>
        <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
        ?>
    </div>

    <p>Jovana i Mima se vole</p>
    <script type="text/javascript" src="js/jovana.js">
    </script>
    <button onclick="test()">Click me</button>


<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>