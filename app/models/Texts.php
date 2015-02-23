<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Textos
 */
class Texts extends \app\models\AuditableEntity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $page;

    /**
     * @var string
     */
    private $content;

    // private $locale;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set page
     *
     * @param string $page
     * @return Textos
     */
    public function setPage($page)
    {
        $this->page = $page;
    
        return $this;
    }

    /**
     * Get page
     *
     * @return string 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Content
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * @var string
     */
    private $language;


    /**
     * Set language
     *
     * @param string $language
     * @return Textos
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    // public function setTranslatableLocale($locale)
    // {
    //     $this->locale = $locale;
    // }

}