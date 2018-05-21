<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * Url
 *
 * @ORM\Table(name="url")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UrlRepository")
 */
class Url
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="initial_url", type="text")
     * @Assert\NotBlank(message="The url cannot be empty!")
     * @Assert\Url(message = "The url '{{ value }}' is not a valid url",)
     */
    private $initialUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="short_url", type="string", length=255, unique=true)
     */
    private $shortUrl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expired_at", type="datetime", nullable=true)
     */
    private $expiredAt;

    /**
     * Many Urls have Many Statistics.
     * @ORM\ManyToMany(targetEntity="Statistic")
     * @ORM\JoinTable(name="urls_statistics",
     *      joinColumns={@ORM\JoinColumn(name="url_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="statistic_id", referencedColumnName="id")}
     *      )
     */
    private $statistics;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->statistics = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set initialUrl
     *
     * @param string $initialUrl
     *
     * @return Url
     */
    public function setInitialUrl($initialUrl)
    {
        $this->initialUrl = $initialUrl;

        return $this;
    }

    /**
     * Get initialUrl
     *
     * @return string
     */
    public function getInitialUrl()
    {
        return $this->initialUrl;
    }

    /**
     * Set shortUrl
     *
     * @param string $shortUrl
     *
     * @return Url
     */
    public function setShortUrl($shortUrl)
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }

    /**
     * Get shortUrl
     *
     * @return string
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set expiredAt
     *
     * @param \DateTime $expiredAt
     *
     * @return Url
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * Get expiredAt
     *
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * Get url statistics
     *
     * @return ArrayCollection
     */
    public function getStatistics()
    {
        return $this->statistics;
    }

    /**
     * @param Statistic $statistic
     */
    public function addStatistics(Statistic $statistic)
    {
        if ($this->statistics->contains($statistic)) {
            return;
        }

        $this->statistics[] = $statistic;
    }

}

