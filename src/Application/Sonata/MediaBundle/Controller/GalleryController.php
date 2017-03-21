<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 10/27/16
 * Time: 3:49 PM
 */

namespace Application\Sonata\MediaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $galleries = $this->get('sonata.media.manager.gallery')->findBy(array(
            'enabled' => true,
        ));

        return $this->render('ApplicationSonataMediaBundle:Gallery:index.html.twig', array(
            'galleries' => $galleries,
        ));
    }

    /**
     * @param string $id
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     */
    public function viewAction($id)
    {
        $gallery = $this->get('sonata.media.manager.gallery')->findOneBy(array(
            'id' => $id,
            'enabled' => true,
        ));

        if (!$gallery) {
            throw new NotFoundHttpException('unable to find the gallery with the id');
        }

        return $this->render('ApplicationSonataMediaBundle:Gallery:view.html.twig', array(
            'gallery' => $gallery,
        ));
    }
}