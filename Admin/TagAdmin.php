<?php

// src/YS/UserBundle/Admin/TagAdmin.php

namespace YS\UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TagAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('name', 'text')
    ;
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper->add('name');
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper->addIdentifier('name');
  }
}