<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ItemType
 * @package AppBundle\Form
 */
class ItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('collection', TextType::class)
            ->add('title', TextType::class)
            ->add('user', TextType::class)
            ->add('code', TextType::class)
            ->add('description', TextType::class)
            ->add('imageUrl', UrlType::class)
            ->add('submit', SubmitType::class)
            ->add('update', SubmitType::class, array('label' => 'update'))
            ->add('changeOwner', SubmitType::class, array('label' => 'ChangeOwner'))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Item',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_item';
    }
}
