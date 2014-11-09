<?php
/**
 * Error404Controller.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

class Error404Controller extends Core
{

    public function action()
    {
        $this->setPageProperty('pageTitle', 'Page not found');
        $this->view->generate('site/404.php', 'site/template.php', $this->getCurrentPageMeta());
    }
}
