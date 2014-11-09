<?php
/**
 * ControllerMain.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

class MainController extends Core
{


    public function action()
    {
        $this->setPageProperty('pageTitle', 'Homepage');
        $this->view->generate('site/home.php', 'site/template.php', $this->getCurrentPageMeta());
    }
}
