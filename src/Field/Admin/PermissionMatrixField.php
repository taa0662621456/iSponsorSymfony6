<?php

namespace App\Field\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

final class PermissionMatrixField
{
    public static function new(string $propertyName = 'role'): Field
    {
        return Field::new($propertyName)
            ->setTemplatePath('admin/field/permission_matrix.html.twig');
    }
}
