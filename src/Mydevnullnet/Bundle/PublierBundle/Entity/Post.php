<?php

namespace Mydevnullnet\Bundle\PublierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mydevnullnet\Bundle\PublierBundle\Entity\Post
 */
class Post
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var \DateTime $created_at
     */
    private $created_at;

    /**
     * @var \DateTime $publish_date
     */
    private $publish_date;

    /**
     * @var boolean $is_streamed
     */
    private $is_streamed;

    /**
     * @var boolean $is_in_menu
     */
    private $is_in_menu;


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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set publish_date
     *
     * @param \DateTime $publishDate
     * @return Post
     */
    public function setPublishDate($publishDate)
    {
        $this->publish_date = $publishDate;
    
        return $this;
    }

    /**
     * Get publish_date
     *
     * @return \DateTime 
     */
    public function getPublishDate()
    {
        return $this->publish_date;
    }

    /**
     * Set is_streamed
     *
     * @param boolean $isStreamed
     * @return Post
     */
    public function setIsStreamed($isStreamed)
    {
        $this->is_streamed = $isStreamed;
    
        return $this;
    }

    /**
     * Get is_streamed
     *
     * @return boolean 
     */
    public function getIsStreamed()
    {
        return $this->is_streamed;
    }

    /**
     * Set is_in_menu
     *
     * @param boolean $isInMenu
     * @return Post
     */
    public function setIsInMenu($isInMenu)
    {
        $this->is_in_menu = $isInMenu;
    
        return $this;
    }

    /**
     * Get is_in_menu
     *
     * @return boolean 
     */
    public function getIsInMenu()
    {
        return $this->is_in_menu;
    }
    /**
     * @var boolean $is_in_stream
     */
    private $is_in_stream;


    /**
     * Set is_in_stream
     *
     * @param boolean $isInStream
     * @return Post
     */
    public function setIsInStream($isInStream)
    {
        $this->is_in_stream = $isInStream;
    
        return $this;
    }

    /**
     * Get is_in_stream
     *
     * @return boolean 
     */
    public function getIsInStream()
    {
        return $this->is_in_stream;
    }
    /**
     * @var boolean $in_stream
     */
    private $in_stream;

    /**
     * @var boolean $in_menu
     */
    private $in_menu;


    /**
     * Set in_stream
     *
     * @param boolean $inStream
     * @return Post
     */
    public function setInStream($inStream)
    {
        $this->in_stream = $inStream;
    
        return $this;
    }

    /**
     * Get in_stream
     *
     * @return boolean 
     */
    public function getInStream()
    {
        return $this->in_stream;
    }

    /**
     * Set in_menu
     *
     * @param boolean $inMenu
     * @return Post
     */
    public function setInMenu($inMenu)
    {
        $this->in_menu = $inMenu;
    
        return $this;
    }

    /**
     * Get in_menu
     *
     * @return boolean 
     */
    public function getInMenu()
    {
        return $this->in_menu;
    }
}