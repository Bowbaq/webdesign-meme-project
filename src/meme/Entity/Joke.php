<?php

namespace meme\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * meme\Joke
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="meme\Repository\JokeRepository")
 */
class Joke
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
     * @var array $whos
     *
     * @ORM\Column(name="whos", type="array")
     */
    protected $whos;

    /**
     * @var string $punchline
     *
     * @ORM\Column(name="punchline", type="string", length=255)
     */
    protected $punchline;

    /**
     * @var string $author
     *
     * @ORM\Column(name="author", type="string", length=80)
     */
    protected $author = 'Anonymous';

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created_at;

    /**
     * @var integer $up_votes
     *
     * @ORM\Column(name="up_votes", type="integer")
     */
    protected $up_votes = 0;

    /**
     * @var integer $down_votes
     *
     * @ORM\Column(name="down_votes", type="integer")
     */
    protected $down_votes = 0;
    
    public function __construct($author, $whos, $punchline) {
        $this->setAuthor($author);
        $this->setWhos($whos);
        $this->setPunchline($punchline);
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
     * Set whos
     *
     * @param array $whos
     */
    public function setWhos($whos)
    {
        $this->whos = $whos;
    }
    
    /**
     * Add who
     *
     * @param string $who
     */
    public function addWho($who) {
        $this->whos[] = $who;
    }

    /**
     * Get whos
     *
     * @return array 
     */
    public function getWhos()
    {
        return $this->whos;
    }

    /**
     * Set punchline
     *
     * @param string $punchline
     */
    public function setPunchline($punchline)
    {
        $this->punchline = $punchline;
    }

    /**
     * Get punchline
     *
     * @return string 
     */
    public function getPunchline()
    {
        return $this->punchline;
    }

    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set up_votes
     *
     * @param integer $upVotes
     */
    public function setUpVotes($upVotes)
    {
        $this->up_votes = $upVotes;
    }
    
    /**
     * Vote up
     */
    public function upVote()
    {
        $this->up_votes++;
    }

    /**
     * Get up_votes
     *
     * @return integer 
     */
    public function getUpVotes()
    {
        return $this->up_votes;
    }

    /**
     * Set down_votes
     *
     * @param integer $downVotes
     */
    public function setDownVotes($downVotes)
    {
        $this->down_votes = $downVotes;
    }
    
    /**
     * Down vote
     */
    public function downVote()
    {
        $this->down_votes++;
    }

    /**
     * Get down_votes
     *
     * @return integer 
     */
    public function getDownVotes()
    {
        return $this->down_votes;
    }
}