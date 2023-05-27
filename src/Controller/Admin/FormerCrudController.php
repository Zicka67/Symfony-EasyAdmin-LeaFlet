<?php

namespace App\Controller\Admin;

use App\Entity\Former;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Former::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
