<?php
namespace UserBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue;
use FOS\UserBundle\Form\Type\RegistrationFormType as FOSRegistrationFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/6/16
 * Time: 11:15 AM
 */
class RegistrationFormType extends FOSRegistrationFormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => [
                    'placeholder' => 'form.email'
                ]
            ))
            ->add('username', TextType::class, array(
                'label' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => [
                    'placeholder' => 'form.username'
                ]
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => false, 'attr' => ['placeholder' => 'form.password']),
                'second_options' => array('label' => false, 'attr' => ['placeholder' => 'form.password_confirmation']),
                'invalid_message' => 'fos_user.password.mismatch',
            ));
//            ->add('captcha', EWZRecaptchaType::class, [
//                'attr' => array(
//                    'options' => array(
//                        'theme' => 'light',
//                        'type' => 'image',
//                        'size'  => 'normal'
//                    )
//                ),
//                'label' => false,
//                'mapped' => false,
//                'constraints' => array(
//                    new IsTrue()
//                )
//            ]);
    }
}