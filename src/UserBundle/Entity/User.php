<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 7/19/16
 * Time: 5:04 PM
 *
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{

    /**
     * @var
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\LoginFacebook", mappedBy="user",cascade={"persist"})
     */
    protected $facebookLogin;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\LoginGoogle", mappedBy="user",cascade={"persist"})
     */
    protected $googleLogin;

    /**
     * @var ArrayCollection <Setting>
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Setting", mappedBy="user", orphanRemoval=true)
     */
    protected $settings;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", mappedBy="author", orphanRemoval=true)
     */
    protected $galleries;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null|LoginFacebook
     */
    public function getFacebookLogin()
    {
        return $this->facebookLogin;
    }

    /**
     * @param LoginFacebook $facebookLogin
     */
    public function setFacebookLogin(LoginFacebook $facebookLogin)
    {
        $this->facebookLogin = $facebookLogin;
        if($facebookLogin->getUser() === null) {
            $facebookLogin->setUser($this);
        }
    }

    /**
     * @return null|LoginGoogle
     */
    public function getGoogleLogin()
    {
        return $this->googleLogin;
    }

    /**
     * @param LoginGoogle $googleLogin
     */
    public function setGoogleLogin(LoginGoogle $googleLogin)
    {
        $this->googleLogin = $googleLogin;
        if($googleLogin->getUser() === null) {
            $googleLogin->setUser($this);
        }
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function getSetting($settingId)
    {
        /** @var Setting $setting */
        foreach($this->settings as $setting){
            if($setting->getSettingId() == $settingId) {
                return $setting;
            }
        }
        $setting = new Setting();
        $setting->setSettingId($settingId);
        $setting->setValue(Setting::$DEFAULT_VALUES[$settingId]);
        $this->addSetting($setting);
        return $setting;
    }

    public function addSetting(Setting $setting)
    {
        if($setting->getUser() === null) {
            $setting->setUser($this);
        }
        $this->settings->add($setting);
    }
}
