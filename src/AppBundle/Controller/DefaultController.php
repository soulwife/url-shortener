<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Statistic;
use AppBundle\Entity\Url;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UrlType;
use AppBundle\Service\UrlShortener;
use AppBundle\Service\GeoInfo;


class DefaultController extends Controller
{

    /**
     * Short url
     *
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $url = new Url();

        $form = $this->createForm(UrlType::class, $url);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $urlShortener = $this->get(UrlShortener::class);
            $url->setShortUrl($urlShortener->shortUrl($url->getInitialUrl()));

            $em->persist($url);
            $em->flush();

            $this->addFlash('success', 'Your url have been shorted: ' . $url->getShortUrl());

            return $this->redirectToRoute('url_statistic', ['url' => $url, 'shortUrl' => $url->getShortUrl()]);
        }

        return $this->render('default/index.html.twig', [
            'url' => $url,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{shortUrl}/info", name="url_statistic")
     * @Method("GET")
     */
    public function showStatisticAction(Url $url)
    {
        return $this->render('default/statistic.html.twig', ['url' => $url, 'statistics' => $url->getStatistics()]);
    }


    /**
     * @Route("/{shortUrl}", name="redirect_url", requirements={"shortUrl": ".{5,}"})
     */
     public function redirectAction(Request $request, $shortUrl)
     {
         $em = $this->getDoctrine()->getManager();

         $url = $em->getRepository(Url::class)->findOneBy(['shortUrl' => $shortUrl]);
         $now = new \DateTime();

         if ($url) {
             if ($url->getExpiredAt() && $url->getExpiredAt() < $now) {
                 throw $this->createNotFoundException('The url has expired');
             }
             $geoInfo = $this->get(GeoInfo::class);

             $statistic = new Statistic();
             $ip = $request->getClientIp();
             $statistic->setIp($ip);
             $statistic->setCountry($geoInfo->getCountryNameByIp($ip));
             $statistic->setUserAgentData($request->headers->get('User-Agent'));
             $em->persist($statistic);

             $url->addStatistics($statistic);
             $em->persist($url);

             $em->flush();
         } else {
             throw $this->createNotFoundException('The url does not exist');
         }

         return $this->redirect($url->getInitialUrl());
     }
}
