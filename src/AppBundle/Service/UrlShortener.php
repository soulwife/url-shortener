<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;


class UrlShortener
{


    /** @var EntityManagerInterface */
    private $em;

    /**
     * @param UrlRepository $urlRepository
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $url
     * @return string
     */
    public function shortUrl(string $url) : string
    {
        $hash = password_hash($url, PASSWORD_DEFAULT);

        $shortUrl = substr($hash, 7, random_int(5, 7));

        //TODO: check generated url existence in db, but I'm not sure that it would be efficient

        return $shortUrl;

    }
}