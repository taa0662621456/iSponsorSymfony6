<?php

namespace App\Controller\Admin;

use App\Entity\Role\RolePermission;
use App\Field\Admin\PermissionMatrixField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RoleMatrixCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RolePermission::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Permission Matrix')
            ->setEntityLabelInSingular('Role Permissions')
            ->showEntityActionsInlined();


        return $crud
            ->setEntityLabelInPlural('Role Permission Matrix')
            ->setEntityLabelInSingular('Role Permissions')
            ->showEntityActionsInlined()
            ->setDefaultSort(['role' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('role'),
            PermissionMatrixField::new('permissions')->formatValue(function ($value, $entity) {
                // тут агрегируем все права роли
                $em = $this->getDoctrine()->getManager();
                $records = $em->getRepository(RolePermission::class)->findBy(['role' => $entity->getRole()]);
                return array_map(fn(RolePermission $rp) => $rp->getPermission(), $records);
            }),
        ];
    }

    #[Route('/admin/permissions-matrix', name: 'admin_permissions_matrix')]
    public function matrix(EntityManagerInterface $em): Response
    {
        $records = $em->getRepository(RolePermission::class)->findAll();

        $matrix = [];
        foreach ($records as $rp) {
            $matrix[$rp->getRole()][] = $rp->getPermission();
        }

        $allPermissions = ['VIEW','EDIT','DELETE','CANCEL','REFUND','PAY'];
        $roles = array_keys($matrix);

        return $this->render('admin/matrix/permissions.html.twig', [
            'matrix' => $matrix,
            'roles' => $roles,
            'allPermissions' => $allPermissions,
        ]);
    }

    #[Route('/admin/permissions-matrix-edit', name: 'admin_permissions_matrix_edit')]
    public function matrixEditable(EntityManagerInterface $em): Response
    {
        $records = $em->getRepository(RolePermission::class)->findAll();

        $matrix = [];
        foreach ($records as $rp) {
            $matrix[$rp->getRole()][] = $rp->getPermission();
        }

        $allPermissions = ['VIEW','EDIT','DELETE','CANCEL','REFUND','PAY'];
        $roles = array_unique(array_map(fn($r) => $r->getRole(), $records));

        return $this->render('admin/matrix/permissions_editable.html.twig', [
            'matrix' => $matrix,
            'roles' => $roles,
            'allPermissions' => $allPermissions,
        ]);
    }

    #[Route('/admin/sync-permissions-matrix', name: 'admin_sync_permissions_matrix', methods: ['POST'])]
    public function syncPermissionsMatrix(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $submittedMatrix = $request->request->all('matrix'); // ['ROLE_ADMIN' => ['VIEW','EDIT'], ...]

        $allPermissions = ['VIEW','EDIT','DELETE','CANCEL','REFUND','PAY'];

        foreach ($submittedMatrix as $role => $permissions) {
            $existing = $em->getRepository(RolePermission::class)->findBy(['role' => $role]);
            $existingPerms = array_map(fn($rp) => $rp->getPermission(), $existing);

            // добавить новые
            foreach (array_diff($permissions, $existingPerms) as $perm) {
                $rp = new RolePermission();
                $rp->setRole($role);
                $rp->setPermission($perm);
                $em->persist($rp);
            }

            // удалить снятые
            foreach (array_diff($existingPerms, $permissions) as $perm) {
                $rp = $em->getRepository(RolePermission::class)->findOneBy([
                    'role' => $role,
                    'permission' => $perm,
                ]);
                if ($rp) {
                    $em->remove($rp);
                }
            }
        }

        $em->flush();

        return new JsonResponse([
            'success' => true,
            'message' => 'Permission matrix updated successfully.'
        ]);
    }

    #[Route('/admin/permissions-matrix-inline', name: 'admin_permissions_matrix_inline')]
    public function matrixInline(EntityManagerInterface $em): Response
    {
        $records = $em->getRepository(RolePermission::class)->findAll();

        $matrix = [];
        foreach ($records as $rp) {
            $matrix[$rp->getRole()][] = $rp->getPermission();
        }

        $allPermissions = ['VIEW','EDIT','DELETE','CANCEL','REFUND','PAY'];
        $roles = array_unique(array_map(fn($r) => $r->getRole(), $records));

        return $this->render('admin/matrix/permissions_inline.html.twig', [
            'matrix' => $matrix,
            'roles' => $roles,
            'allPermissions' => $allPermissions,
        ]);
    }

    #[Route('/admin/toggle-permission', name: 'admin_toggle_permission', methods: ['POST'])]
    public function togglePermission(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $role = $request->request->get('role');
        $permission = $request->request->get('permission');
        $granted = (bool) $request->request->get('granted');

        if (!$role || !$permission) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid input'], 400);
        }

        $repo = $em->getRepository(RolePermission::class);

        $record = $repo->findOneBy(['role' => $role, 'permission' => $permission]);

        if ($granted && !$record) {
            $rp = new RolePermission();
            $rp->setRole($role);
            $rp->setPermission($permission);
            $em->persist($rp);
            $em->flush();

            return new JsonResponse(['success' => true, 'message' => "Granted $permission to $role"]);
        }

        if (!$granted && $record) {
            $em->remove($record);
            $em->flush();

            return new JsonResponse(['success' => true, 'message' => "Revoked $permission from $role"]);
        }

        return new JsonResponse(['success' => true, 'message' => 'No changes']);
    }
}
