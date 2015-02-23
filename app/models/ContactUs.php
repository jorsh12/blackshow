<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactUs
 */
class ContactUs extends \app\models\DoctrineEntity
{

    protected $formFields = array (
        'category' => array (
            'type' => 'select',
            'label' => 'Categoria',
            'list' => array(
                'prueba' => 'prueba'
            )
        ),
        'name' => array (
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Nombre Completo',
        ),
        'city' => array (
            'type' => 'text',
            'label' => 'City',
            'placeholder' => 'Ciudad',
        ),
        'fhone' => array (
            'type' => 'text',
            'label' => 'Fhone',
            'placeholder' => 'Telefono',
        ),
        'email' => array (
            'type' => 'text',
            'label' => 'Email',
            'placeholder' => 'Email',
        ),
        'comments' => array (
            'type' => 'textarea',
            'label' => 'Comments',
            'placeholder' => 'Comentarios',
        ),
    );

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $fhone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $comments;


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
     * Set category
     *
     * @param string $category
     * @return ContactUs
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ContactUs
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return ContactUs
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set fhone
     *
     * @param string $fhone
     * @return ContactUs
     */
    public function setFhone($fhone)
    {
        $this->fhone = $fhone;
    
        return $this;
    }

    /**
     * Get fhone
     *
     * @return string 
     */
    public function getFhone()
    {
        return $this->fhone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return ContactUs
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return ContactUs
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    
        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
