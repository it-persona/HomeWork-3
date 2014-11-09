<?php
/**
 * controller.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

abstract class Core
{
    protected   $model,
                $view,
                $templateLayout,
                $siteName,
                $specialChar,
                $pageTitle,
                $pageAuthor,
                $description,
                $keywords;

    public function __construct()
    {
        $this->view = new View();
    }

    abstract public function action();

    // Setters

    protected function setPageProperty($property, $value)
    {
        $this->$property = $value;
    }

    // Getters

    protected function getCurrentPageMeta()
    {
        //TODO: Set values of this properties from database or config file
        return $this->pageData = array
        (
            'siteName'          => empty($this->siteName)     ? 'Base MVC Application'   : $this->siteName,
            'specialChar'       => empty($this->specialChar)  ? '-'                      : $this->specialChar,
            'pageTitle'         => empty($this->pageTitle)    ? 'Page title'             : $this->pageTitle,
            'pageAuthor'        => empty($this->pageAuthor)   ? 'Panchenko Vadim'        : $this->pageAuthor,
            'pageDescriptions'  => empty($this->description)  ? 'page description'       : $this->description,
            'pageKeywords'      => empty($this->keywords)     ? 'page keywords'          : $this->keywords,
        );
    }
}
