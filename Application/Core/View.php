<?php
/**
 * View.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 *
 */

class View
{

    public function pageGenerate($content_view, $template_view, $data = null)
    {
        if(is_array($data)) {
            // Extract page meta date from array returned by controller
            extract($data, EXTR_PREFIX_SAME, "wddx");
        }

        include 'Themes/Default/views/' . $template_view;
    }
}
