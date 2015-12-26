<?php

/**
 * Base_Url este adresa siteului
 * @example http://google.com
 * @example http://metin2.ro
 * @tutorial Lasa necompletat daca vrei ca sistemul sa o detecteze automat.
**/

$config['base_url'] = '';

/**
 * Relative_Path  
 * @example /metin2
 * @example /sv1
 * @tutorial In caz ca nu pui scriptul in radacina domeniului trebuie sa specifici 
 * subfolderul
**/

$config['relative_path'] = '';

/**
 * Tema implicita setata pe site 
 * @access Modificati doar daca doriti.
 * @default Tema clasica asemanatoare metin2.ro
**/

$config['template'] = 'clasic';

/**
 * Default_Plugin este fisierul de tip index care apare cand celalate nu au fost gasite 
 * @access Nu trebuie modificat
**/

$config['default_controller'] = 'main';

$config['default_action'] = 'index';

/**
 * La cat timp se va updata clasamentul 
 * @access Modifici dupa bunul plac
**/

$config['rank_regenerate'] = 4 * 60 * 60;

/**
 * Site_Name este numele siteului 
 * @example Google
 * @example Metin2
 * @tutorial Utila cand folosesti functia site_name(); si numele implicit atribuit templateului.
**/

$config['site_name'] = 'Metin2fw';

/**
 * Site_Lang este limba implicita a siteului
 * @example ro-Ro
 * @example us-US
 * @tutorial Folosita atunci cand siteul are un sistem multilingv
**/

$config['site_lang'] = 'ro';

/**
 * Default_Timezone este setarea implicita pentru fusul orar
 * @example Europe/Bucharest
 * @example Europe/Madrid
 * @link http://www.php.net/manual/en/timezones.php
**/

$config['default_timezone'] = 'Europe/Bucharest';

/**
 * Site_Keywords sunt cuvintele cheie utile pentru SEO
 * Motorul de cautare va fi ajutat de catre acestea atunci cand utilizatorul 
 * cauta ceva pe internet.
**/

$config['site_keywords'] = 'metin 2 clasic private pvm rates warrior sura shaman ninja battle fms rib';

/**
 * Site_Description este o descriere a siteului utila pentru motoarele de cautare.
 * Recomand sa nu folositi mai mult de 15 cuvinte. 
**/

$config['site_description'] = 'Cel mai bun privat clasic de metin2.';

$config['banners'] = array(
    array(
        'url' => '',
        'img' => $config['base_url'].'templates/frontend/clasic/img/ren.jpg'
    ),
    array(
        'url' => '',
        'img' => $config['base_url'].'templates/frontend/clasic/img/mounts.jpg'
    )    
);