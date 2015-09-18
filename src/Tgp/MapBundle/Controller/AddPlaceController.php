<?php

namespace Tgp\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\UserBundle\Model\UserInterface;
use Tgp\MapBundle\Entity\Place;

class AddPlaceController extends Controller
{
    public function setAction($name, $lat, $lng)
    {
        $user = $this->getUser();

        $response = new JsonResponse();

        if (!is_object($user) || !($user instanceof UserInterface)) {
            $response->setData(array("error" => "not connected"));
            return $response;
        }

        $place = new Place();

        $place->setName($name);
        $place->setLatitude($lat);
        $place->setLongitude($lng);
        $place->addUser($user);
        $user->addPlace($place);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($place);
        $em->flush();

        $response->setData(array("ok" => "created"));

        return $response;
    }
}
