<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Room::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            CollectionField::new('images')
                ->setEntryType(MediaType::class)
                ->onlyOnForms(),
            
            CollectionField::new('images')
                ->setTemplatePath('admin/roomImages.html.twig')
                ->onlyOnDetail()
                   
        ];

        
    }

    public function configureActions(Actions $actions): Actions 
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
    
}
