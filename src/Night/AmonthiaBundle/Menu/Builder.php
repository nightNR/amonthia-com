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
use UserBundle\Entity\Setting;
use UserBundle\Entity\User;

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

        $user = $this->getUser();
        $setting = null;
        if($user !== null) {
            $setting = $user->getSetting(Setting::MENU_TOGGLE);
        }

        $menuLabel = function($label, $icon) use ($setting) {
            return sprintf('<span class="menu-label">%s</span><span class="icon glyphicon %s"></span>', $label, $icon);
        };

        $menu->addChild('home', [
            'route' => 'night_amonthia_default_index',
            'label' => $menuLabel($translator->trans('menu.home', [], 'AmonthiaBundle'), 'glyphicon-home'),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.home', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('campaigns', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.campaigns', [], 'AmonthiaBundle'), "glyphicon-flag"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.campaigns', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('history', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.history', [], 'AmonthiaBundle'), "glyphicon-book"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.history', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('codex', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.codex', [], 'AmonthiaBundle'), "glyphicon-tasks"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.codex', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('map', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.map', [], 'AmonthiaBundle'), "glyphicon-map-marker"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.map', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('members', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.members', [], 'AmonthiaBundle'), "glyphicon-knight"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.members', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('gallery', [
            'route' => 'sonata_media_gallery_index',
            'label' => $menuLabel($translator->trans('menu.gallery', [], 'AmonthiaBundle'), "glyphicon-picture"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.gallery', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('downloads', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.downloads', [], 'AmonthiaBundle'), "glyphicon-download"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.downloads', [], 'AmonthiaBundle')
            ]
        ]);
        $menu->addChild('forum', [
            'route' => 'homepage',
            'label' => $menuLabel($translator->trans('menu.forum', [], 'AmonthiaBundle'), "glyphicon-bullhorn"),
            'extras' => [
                'safe_label' => true,
                'translation_domain' => false
            ],
            'attributes' => [
                "data-toggle"    => "tooltip",
                "data-placement" => "right",
                "title"          => $translator->trans('menu.forum', [], 'AmonthiaBundle')
            ]
        ]);

        return $menu;
    }

    /**
     * Get a user from the Security Token Storage.
     *
     * @return User|null
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }
}