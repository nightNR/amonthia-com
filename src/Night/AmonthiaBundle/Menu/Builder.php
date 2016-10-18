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

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');

        $menu->addChild('home', [
            'route' => 'night_amonthia_default_index',
            'label' => '<span class="menu-label">Home</span><span class="icon glyphicon glyphicon-home"></span>',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Campaigns</span><span class="icon glyphicon glyphicon-flag"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">History</span><span class="icon glyphicon glyphicon-book"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Codex</span><span class="icon glyphicon glyphicon-tasks"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Map</span><span class="icon glyphicon glyphicon-map-marker"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Members</span><span class="icon glyphicon glyphicon-knight"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Gallery</span><span class="icon glyphicon glyphicon-picture"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Downloads</span><span class="icon glyphicon glyphicon-download"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);
        $menu->addChild('<span class="menu-label">Forum</span><span class="icon glyphicon glyphicon-bullhorn"></span>', [
            'route' => 'homepage',
            'extras' => [
                'safe_label' => true
            ]
        ]);

        return $menu;
    }
}