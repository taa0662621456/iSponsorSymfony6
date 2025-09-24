<?php

namespace App\Controller\Admin;

use App\Entity\Permission\Permission;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class PermissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Permission::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->addBatchAction(
                BatchAction::new('grant_permission', 'Grant Permission…')
                    ->setIcon('fa fa-plus')
                    ->setCssClass('btn btn-success')
                    ->linkToCrudAction('batchGrantPermissionForm')
            )
            ->addBatchAction(
                BatchAction::new('revoke_permission', 'Revoke Permission…')
                    ->setIcon('fa fa-minus')
                    ->setCssClass('btn btn-danger')
                    ->linkToCrudAction('batchRevokePermissionForm')
            )
            ->addBatchAction(
                BatchAction::new('manage_permission', 'Manage Permission…')
                    ->setIcon('fa fa-shield-alt')
                    ->setCssClass('btn btn-primary')
                    ->linkToCrudAction('batchManagePermissionForm')
            );
    }

    #[Route('/admin/grant-permission', name: 'admin_grant_permission', methods: ['POST'])]
    public function grantPermissionAjax(Request $request, EntityManagerInterface $em): JsonResponse
    {
        return $this->updatePermissions($request, $em, 'grant');
    }

    #[Route('/admin/revoke-permission', name: 'admin_revoke_permission', methods: ['POST'])]
    public function revokePermissionAjax(Request $request, EntityManagerInterface $em): JsonResponse
    {
        return $this->updatePermissions($request, $em, 'revoke');
    }

    #[Route('/admin/manage-permission', name: 'admin_manage_permission', methods: ['POST'])]
    public function managePermissionAjax(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $action = $request->request->get('action'); // grant | revoke
        $permissions = $request->request->all('permissions') ?? [];
        $entityIds = json_decode($request->request->get('entityIds', '[]'), true);

        if (!in_array($action, ['grant', 'revoke'], true) || empty($entityIds)) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid input.'], 400);
        }

        foreach ($entityIds as $id) {
            $entity = $em->getRepository(Permission::class)->find($id);
            if (!$entity) {
                continue;
            }
            $role = $entity->getRole();

            foreach ($permissions as $permission) {
                $record = $em->getRepository(Permission::class)->findOneBy([
                    'role' => $role,
                    'permission' => $permission,
                ]);

                if ($action === 'grant' && !$record) {
                    $rp = new Permission();
                    $rp->setRole($role);
                    $rp->setPermission($permission);
                    $em->persist($rp);
                }

                if ($action === 'revoke' && $record) {
                    $em->remove($record);
                }
            }
        }

        $em->flush();

        return new JsonResponse([
            'success' => true,
            'message' => sprintf(
                'Permissions [%s] %s for selected roles.',
                implode(', ', $permissions),
                $action === 'grant' ? 'granted' : 'revoked'
            ),
        ]);
    }

    #[Route('/admin/fetch-role-permissions', name: 'admin_fetch_role_permissions', methods: ['POST'])]
    public function fetchPermissions(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $entityIds = json_decode($request->request->get('entityIds', '[]'), true);

        if (empty($entityIds)) {
            return new JsonResponse(['success' => false, 'message' => 'No roles selected.'], 400);
        }

        $roles = [];
        foreach ($entityIds as $id) {
            $entity = $em->getRepository(Permission::class)->find($id);
            if ($entity) {
                $role = $entity->getRole();
                $roles[$role][] = $entity->getPermission();
            }
        }

        return new JsonResponse([
            'success' => true,
            'roles' => $roles,
        ]);
    }

    #[Route('/admin/sync-permissions', name: 'admin_sync_permissions', methods: ['POST'])]
    public function syncPermissions(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $permissions = $request->request->all('permissions') ?? [];
        $entityIds = json_decode($request->request->get('entityIds', '[]'), true);

        if (empty($entityIds)) {
            return new JsonResponse(['success' => false, 'message' => 'No roles selected.'], 400);
        }

        foreach ($entityIds as $id) {
            $entity = $em->getRepository(Permission::class)->find($id);
            if (!$entity) {
                continue;
            }
            $role = $entity->getRole();

            $existing = $em->getRepository(Permission::class)->findBy(['role' => $role]);
            $existingPerms = array_map(fn($rp) => $rp->getPermission(), $existing);

            $toAdd = array_diff($permissions, $existingPerms);
            foreach ($toAdd as $perm) {
                $rp = new Permission();
                $rp->setRole($role);
                $rp->setPermission($perm);
                $em->persist($rp);
            }

            $toRemove = array_diff($existingPerms, $permissions);
            foreach ($toRemove as $perm) {
                $rp = $em->getRepository(Permission::class)->findOneBy([
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
            'message' => sprintf('Permissions synced: [%s]', implode(', ', $permissions)),
        ]);
    }

    private function updatePermissions(Request $request, EntityManagerInterface $em, string $action): JsonResponse
    {
        $permission = $request->request->get('permission');
        $entityIds = json_decode($request->request->get('entityIds', '[]'), true);

        if (!$permission || empty($entityIds)) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid input.'], 400);
        }

        foreach ($entityIds as $id) {
            $entity = $em->getRepository(Permission::class)->find($id);
            if (!$entity) {
                continue;
            }
            $role = $entity->getRole();

            $record = $em->getRepository(Permission::class)->findOneBy([
                'role' => $role,
                'permission' => $permission,
            ]);

            if ($action === 'grant' && !$record) {
                $rp = new Permission();
                $rp->setRole($role);
                $rp->setPermission($permission);
                $em->persist($rp);
            }

            if ($action === 'revoke' && $record) {
                $em->remove($record);
            }
        }

        $em->flush();

        return new JsonResponse([
            'success' => true,
            'message' => sprintf('Permission "%s" %s for selected roles.', $permission, $action === 'grant' ? 'granted' : 'revoked'),
        ]);
    }
}
