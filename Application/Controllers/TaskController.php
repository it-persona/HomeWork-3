<?php
/**
 * ControllerTask1.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

class TaskController extends Core
{

    public function action()
    {
        $this->setPageProperty('pageTitle', 'Task #1');
        $this->view->generate('tasks/task1.php', 'site/template.php', $this->getCurrentPageMeta());
    }

    public function actionTask1()
    {
        $this->setPageProperty('pageTitle', 'Task #1');
        $this->view->generate('tasks/task1.php', 'site/template.php', $this->getCurrentPageMeta());
    }
}
