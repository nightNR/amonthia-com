<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 7/25/16
 * Time: 10:57 AM
 */

namespace Night\AmonthiaBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Translation\Translator;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        /**
         * @var Translator $translator
         */
        $translator = $this->container->get('translator');


        $menu->addChild('home', [
            'route' => 'night_amonthia_default_index',
            'label' => '<span class="menu-label">'.$translator->trans('menu.home', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-home"></span>',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.campaigns', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-flag"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.history', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-book"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.codex', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-tasks"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.map', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-map-marker"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.members', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-knight"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.gallery', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-picture"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.downloads', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-download"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);
        $menu->addChild('<span class="menu-label">'.$translator->trans('menu.forum', [], 'AmonthiaBundle').'</span><span class="icon glyphicon glyphicon-bullhorn"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ]
        ]);

        return $menu;
    }
}