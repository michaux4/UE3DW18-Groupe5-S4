<?php

namespace Watson\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class ApiXmlController {

    public function getLinksAction(Application $app) {

        $links = $app['dao.link']->findAllXml();
        
        return new Response($links ,200,['Content-Type' => 'text/xml']);
    }
}

