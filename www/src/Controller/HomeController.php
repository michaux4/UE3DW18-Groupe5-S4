<?php

namespace Watson\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        // $links = $app['dao.link']->findAll();
        // return $app['twig']->render('index.html.twig', array('links' => $links));
        return $app->redirect('page/0');
    }

    public function getPage(int $pageIndex, Application $app) {
        // par 15 links
        $pageSize = 2;
        // count total de links
        $count = $app['dao.link']->count();
        // nb page avec AGRANDISSEMENT
        $nbPages = ceil($count / $pageSize);

        // cas si la page index va depasser les bords
        if ($pageIndex < 0) {
            $pageIndex = $nbPages - 1;
        }
        
        if ($pageIndex >= $nbPages){
            $pageIndex = 0;
        }
        // startIndex         
        $startIndex = $pageIndex * $pageSize;

        // requette sql
        $links = $app['dao.link']->pagination($startIndex, $pageSize);
        
        return $app['twig']->render('index.html.twig', array(
            'links' => $links, 
            // 'count' => $count,
            'pageIndex' => $pageIndex,
            'nbPages' => $nbPages,
        ));
    }

    /**
     * Link details controller.
     *
     * @param integer $id Link id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function linkAction($id, Request $request, Application $app) {
        $link = $app['dao.link']->find($id);
       /* echo "<pre>";
        var_dump($link);exit;*/
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
            // A user is fully authenticated : he can add comments
            // Check if he's author for manage link

        }
        return $app['twig']->render('link.html.twig', array(
            'link' => $link
        ));
    }

    /**
     * Links by tag controller.
     *
     * @param integer $id Tag id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function tagAction($id, Request $request, Application $app) {
        $links = $app['dao.link']->findAllByTag($id);
        $tag   = $app['dao.tag']->findTagName($id);

        return $app['twig']->render('result_tag.html.twig', array(
            'links' => $links,
            'tag'   => $tag
        ));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            )
        );
    }
}
