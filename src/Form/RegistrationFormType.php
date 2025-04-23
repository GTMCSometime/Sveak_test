<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, 
                ['required' => true])
            ->add('surname', TextType::class,
                 ['required' => true])
            ->add('email', EmailType::class,
                 ['required' => true])
            ->add('phone_number', TextType::class,
                 ['required' => true])
            ->add('education', ChoiceType::class,
             [
                'label'    => 'Образование',
                'choices'  => [
                'выберите' => null,
                'Высшее образование' => 'higher',
                'Специальное образование' => 'special',
                'Среднее образование' => 'secondary',
            ], 
                'required' => true,])
            ->add('agree_terms', CheckboxType::class,
             ['label'    => 'Я даю согласие на обработку моих личных данных',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
