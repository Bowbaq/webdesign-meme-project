<?php

namespace meme\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * meme\Ban
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Ban
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $punchline
     *
     * @ORM\Column(name="ip", type="string", length=20)
     */
    protected $ip;

    /**
     * @var string $author
     *
     * @ORM\ManyToOne(targetEntity="Joke")
     */
    protected $joke;
    
    public function __construct($ip, $joke) {
        $this->setIp($ip);
        $this->setJoke($joke);
    }
    
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
     * Set ip
     *
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set joke
     *
     * @param meme\Entity\Joke $joke
     */
    public function setJoke(\meme\Entity\Joke $joke)
    {
        $this->joke = $joke;
    }

    /**
     * Get joke
     *
     * @return meme\Entity\Joke 
     */
    public function getJoke()
    {
        return $this->joke;
    }
}