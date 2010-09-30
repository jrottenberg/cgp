<?php

include_once 'conf/common.inc.php';
include_once 'inc/collectd.inc.php';
require_once 'inc/html.inc.php';

html_start();

if(!$chosts = collectd_hosts())
    printf('<p class="warn">Error: No Collectd hosts found in <em>%s</em></p>', $CONFIG['datadir']);


class array_ereg {
    function array_ereg($pattern) { $this->pattern = $pattern; }
    function ereg($string) {
        return preg_match($this->pattern, $string);
    }
}

$h = array();

if (is_array($CONFIG['regexp'])) {
    echo "<ul class=\"regexp\">\n";
    foreach($CONFIG['regexp'] as $name => $regexp ) {
        printf("\t<li><a href=\"#%s\">%s</a></li>\n", $regexp, $name);
    }
    echo "</ul>\n";
}


# show all hosts by regexp
if (is_array($CONFIG['regexp'])) {
    foreach($CONFIG['regexp'] as $name => $regexp ) {
        $h[$regexp] =  array_filter($chosts, array(new array_ereg("/$regexp/"), 'ereg'));
        printf("<h2 id=\"%s\">%s</a></h2>\n", $regexp, $name);
        host_summary($h[$regexp]);
        $chosts = array_diff($chosts, $h[$regexp]);
    }  
}


# show all uncategorized hosts
if ($chosts) {
    echo "<h2>uncategorized</h2>\n";
    host_summary($uhosts);
}

html_end();

?>
