<?php
// src/Form/SearchType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Sofa' => 'Sofa',
                    'Chair' => 'Chair',
                    'Armchair' => 'Armchair',
                    'Bench' => 'Bench',
                    'Stool' => 'Stool',
                ],
                'label' => 'Choose Category',
                'required' => true,
                'placeholder' => 'Select a category',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
