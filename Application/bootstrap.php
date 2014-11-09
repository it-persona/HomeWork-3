<?php
/**
 * bootstrap.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

require_once 'Core/Core.php';
require_once 'Core/Model.php';
require_once 'Core/View.php';
require_once 'Core/Router.php';

// Load router
Router::startRouting();
