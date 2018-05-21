<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistic
 *
 * @ORM\Table(name="statistic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatisticRepository")
 */
class Statistic
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
     * @var \DateTime
     *
     * @ORM\Column(name="clicked_at", type="datetime")
     */
    private $clickedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent_data", type="text")
     */
    private $userAgentData;


    public function __construct()
    {
        $this->clickedAt = new \DateTime();
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
     * Get clickedAt
     *
     * @return \DateTime
     */
    public function getClickedAt()
    {
        return $this->clickedAt;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Statistic
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;

        return $this;
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
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Statistic
     */
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Set userAgentData
     *
     * @param string $userAgentData
     *
     * @return Statistic
     */
    public function setUserAgentData(string $userAgentData)
    {
        $this->userAgentData = $userAgentData;

        return $this;
    }

    /**
     * Get userAgentData
     *
     * @return string
     */
    public function getUserAgentData() : string
    {
        return $this->userAgentData;
    }

}

