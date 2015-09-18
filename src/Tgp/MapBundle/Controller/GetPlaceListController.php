<?php

namespace Tgp\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\UserBundle\Model\UserInterface;
use Tgp\MapBundle\Entity\Place;

class GetPlaceListController extends Controller 
{
    public function getAction() 
    {
        $response = new JsonResponse();

        $user = $this->getUser();

        if (!is_object($user) || !($user instanceof UserInterface)) {
            $response->setData(array("error" => "not connected"));
            return $response;
        }

        $places = $user->getPlaces();

        foreach($places as $key => $place) {
            $arr[$place->getId()] = array("name" => $place->getName(),
                                            "lat" => $place->getLatitude(),
                                            "lng" => $place->getLongitude()
                                        );
      }

        $response->setData($arr);

        return $response;
    }
}
