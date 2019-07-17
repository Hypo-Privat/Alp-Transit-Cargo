<?php

  /**
   * Gallery Script
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
  ** Include template functions and initialyze global
  ** and table template.
  *****************************************************/
          define('SCRIPT_ROOT', './');
          require SCRIPT_ROOT .  'inc/template.class.inc.php';
          
          $query_string = '';
          if (isset($_SERVER['QUERY_STRING'])) {
              $query_string = '?' . $_SERVER['QUERY_STRING'];
          }

          $tpl = new template;
          $tpl->load_file('index', 'templates/cal2009_frame_index.html');
          $tpl->register ('index', 'txt_script_name, query_string');
          $tpl->parse ('index');
          $tpl->print_file ('index');



?>