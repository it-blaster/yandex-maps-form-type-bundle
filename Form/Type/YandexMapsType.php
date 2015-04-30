<?php

namespace Fenrizbes\YandexMapsFormTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class YandexMapsType extends AbstractType
{
    /**
     * Map's size
     *
     * @var array
     */
    protected $size;

    /**
     * Default coordinates
     *
     * @var array
     */
    protected $default;

    /**
     * @param array $size
     * @param array $default
     */
    public function __construct(array $size, array $default)
    {
        $this->size    = $size;
        $this->default = $default;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'yandex_maps';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'width'   => $this->size['width'],
            'height'  => $this->size['height'],
            'default' => array(
                'lat' => $this->default['lat'],
                'lng' => $this->default['lng']
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lat', 'hidden')
            ->add('lng', 'hidden')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['width']   = $options['width'];
        $view->vars['height']  = $options['height'];
        $view->vars['default'] = $options['default'];
    }
}