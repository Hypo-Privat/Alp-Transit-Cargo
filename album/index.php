<?php

  /**
   * Gallery Script - index.php
   * 
   * @author Ralf Stadtaus
   * @link http://www.stadtaus.com/ Homepage
   * @link http://www.stadtaus.com/forum/ Support/Contact
   * @copyright Copyright &copy; 2005, Ralf Stadtauss
   */

  /* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
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




  /*****************************************************
  **           Settings - Einstellungen
  *****************************************************/

          $image_path        = "bilder";
          $image_url         = "bilder";


          $picture_count     = "2";
          $pictures_per_page = "6";

          $order             = "ascending";


          $language          = "de"; // en, de, es, fr, nl, da, sv


          $global_template   = "templates/index.html";
          $cell_template     = "templates/table.html";


          $large_image_page  = "index.php";


          $path['log']       = "./log";

          $logging_file      = "";
          $statistic_file    = "";




  /*****************************************************
  ** Add here further words, text, variables and stuff
  ** that you want to appear in the template.
  *****************************************************/
          $add_text = array(

                              'txt_additional' => 'Additional', //  {txt_additional}
                              'txt_more'       => 'More'        //  {txt_more}

                            );




  /*****************************************************
  ** Do not edit below.
  *****************************************************/
          define('SCRIPT_ROOT', './');
          include SCRIPT_ROOT . 'inc/gallery.inc.php';


?>