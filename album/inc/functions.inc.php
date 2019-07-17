<?php

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




  /*****************************************************
  ** Print debug messages
  *****************************************************/
          function debug_mode($msg, $desc = '') {
              global $debug_mode;

              if ($debug_mode == 'on' and !empty($msg)) {
                  if (!is_array($msg)) {
                      $msg = (array) $msg;
                  }

                  for($i = 0; $i < count($msg); $i++)
                  {
                      echo '<pre><strong>' . $desc . '</strong>' . "\n\n" . htmlspecialchars($msg[$i]) . '</pre>.............................................................................<br />';
                  }
              }
          }



  /*****************************************************
  ** Show server info for the admin
  *****************************************************/
          function get_phpinfo($msg = '')
          {
              if (isset ($_REQUEST['ap']) and $_REQUEST['ap'] == 'phpinfo') {
                  $additional_content = '';
                  if (!empty($msg)) {
                      if (!is_array($msg)) {
                          $msg = (array) $msg;
                      }

                      while(list($key, $val) = each($msg))
                      {
                          $dots = '';

                          for($i = 1; $i <= 35 - strlen($key); $i++)
                          {
                              $dots .= '.';
                          }
                          $additional_content .= $key . $dots . $val . "\n";
                      }
                  }

                  ob_start();
                  phpinfo ();
                  $php_information = ob_get_contents();
                  ob_end_clean();
                  echo preg_replace("/<body(.*?)>/i", '<body' . "$1" . '><pre style="color:#CFCFCF;">' . $additional_content . '</pre><br /><br />', $php_information);

                  exit;
              }
          }




  /*****************************************************
  ** Output script runtime
  *****************************************************/
          function script_runtime($runtime_start)
          {
              $runtime_end = explode (' ', microtime ());
              $runtime_difference = $runtime_end[1]     - $runtime_start[1];
              $runtime_summe      = $runtime_difference + $runtime_end[0];
              $runtime            = $runtime_summe      - $runtime_start[0];

              return $runtime;
          }




  /*****************************************************
  ** Print Array
  *****************************************************/
          function print_a($ar)
          {
              echo '<pre>';

              print_r($ar);

              echo '</pre>';
          }

?>