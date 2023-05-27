<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SessionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Session::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('formation'),
            AssociationField::new('former'),
            TextField::new('title_section'),
            DateTimeField::new('date_begin')->setFormat('Y-m-d H:i:s')->setFormTypeOptions([
                'html5' => true,
                'widget' => 'single_text',
            ]),
            DateTimeField::new('date_end')->setFormat('Y-m-d H:i:s')->setFormTypeOptions([
                'html5' => true,
                'widget' => 'single_text',
            ]),
            IntegerField::new('nb_places'),
        ];
    }
    
}
