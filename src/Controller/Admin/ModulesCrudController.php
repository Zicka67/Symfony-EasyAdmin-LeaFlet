<?php

namespace App\Controller\Admin;

use App\Entity\Modules;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ModulesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Modules::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Category'),
            TextField::new('title_modules'),
        ];
    }
    
}
