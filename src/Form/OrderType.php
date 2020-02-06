<?php

namespace App\Form;

use App\Entity\OrderHead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    const DELIVERY = [
        'Sent'      => 'sent',
        'Not Sent'  => 'not sent'
    ];
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', NumberType::class, [
                'disabled'   => true
            ])
            ->add('dataOrdine', DateType::class, [
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'view_timezone'   => 'Europe/Rome',
                'attr'     => [
                    'class'   => 'input-group date',
                    'id'      => 'datetime-picker'
                ]
            ])
            ->add('phone', TelType::class, [
                'label'   => 'Phone Number',
                'attr'    => [
                    'class'   => 'form-control'
                ]
            ])
            ->add('shipping_status', ChoiceType::class, [
                'choices'   => [self::DELIVERY]
            ])
            ->add('shipping_price', MoneyType::class)
            ->add('shipping_payment_status', ChoiceType::class, [
                'choices'   => [self::DELIVERY]
            ])
            ->add('payment_status', ChoiceType::class, [
                'choices'   => [self::DELIVERY]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderHead::class,
        ]);
    }
}
