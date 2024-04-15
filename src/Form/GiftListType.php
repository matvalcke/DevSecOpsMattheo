<?php

namespace App\Form;

use App\Entity\Gift;
use App\Entity\GiftList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class GiftListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gifts', EntityType::class, [
                'class' => Gift::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => function (Gift $gift) {
                    $accessor = PropertyAccess::createPropertyAccessor();
                    $name = $accessor->getValue($gift, 'name');
                    $price = $accessor->getValue($gift, 'price');
                    return sprintf('%s - %s', $name, $price);
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GiftList::class,
        ]);
    }
}
