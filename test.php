<?php 
    $geoplugin = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );
    echo ("<h1>".$geoplugin['geoplugin_countryCode']."</h1> <br>");
    echo ("<h1>".$geoplugin['geoplugin_countryName']."</h1> <br>");
    echo ("<h1>".$geoplugin['geoplugin_regionCode']."</h1> <br>");
    echo ("<h1>".$geoplugin['geoplugin_regionName']."</h1><br>");
    echo ("<h1>".$geoplugin['geoplugin_currencyCode']."</h1><br>");
    echo ("<h1>".$geoplugin['geoplugin_currencySymbol']."</h1><br>");
    echo ("<h1>".$geoplugin['geoplugin_currencySymbol_UTF8']."</h1><br>");
    echo ("<h1>".$geoplugin['geoplugin_currencyConverter']."</h1>");
    
    ?>