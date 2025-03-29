<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use App\Enum\JourEnum;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
    
            ChoiceField::new('jour')
                ->setChoices(JourEnum::cases())
                ->formatValue(fn ($value) => $value?->name)
                ->renderAsNativeWidget(),
    
            TimeField::new('heureOuverture'),
            TimeField::new('heureFermeture'),
            AssociationField::new('enseigne'),
        ];
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
