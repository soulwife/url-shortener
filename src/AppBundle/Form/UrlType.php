<?php

namespace AppBundle\Form;

use AppBundle\Entity\Url;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class UrlType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('initialUrl', null, [
                'attr' => ['autofocus' => true, 'rows' => 1, 'columns' => 20],
                'label' => 'Url',
            ])
            ->add('expiredAt', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'label' => 'Expire time',
                'placeholder' => 'Expire time for your short url. Leave it empty in case you don\'t need it',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('Short url', SubmitType::class, [
               'attr' => ['class' => 'btn-success float-right']
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Url::class
        ]);
    }
}
