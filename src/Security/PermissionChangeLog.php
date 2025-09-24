<?php

namespace App\Security;

use App\Entity\Role\RolePermission;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PermissionChangeLog
{

    #[Route('/admin/toggle-permission', name: 'admin_toggle_permission', methods: ['POST'])]
    public function togglePermission(Request $request, EntityManagerInterface $em, Security $security): JsonResponse
    {
    $role = $request->request->get('role');
    $permission = $request->request->get('permission');
    $granted = (bool) $request->request->get('granted');

    if (!$role || !$permission) {
        return new JsonResponse(['success' => false, 'message' => 'Invalid input'], 400);
    }

    $repo = $em->getRepository(RolePermission::class);
    $record = $repo->findOneBy(['role' => $role, 'permission' => $permission]);

    $user = $security->getUser();
    $changedBy = $user ? $user->getUserIdentifier() : 'system';

    if ($granted && !$record) {
        $rp = new RolePermission();
        $rp->setRole($role);
        $rp->setPermission($permission);
        $em->persist($rp);

        $log = (new PermissionChangeLog())
            ->setRole($role)
            ->setPermission($permission)
            ->setAction('grant')
            ->setChangedAt(new \DateTime())
            ->setChangedBy($changedBy);
        $em->persist($log);

        $em->flush();

        return new JsonResponse(['success' => true, 'message' => "Granted $permission to $role"]);
    }

    if (!$granted && $record) {
        $em->remove($record);

        $log = (new PermissionChangeLog())
            ->setRole($role)
            ->setPermission($permission)
            ->setAction('revoke')
            ->setChangedAt(new \DateTime())
            ->setChangedBy($changedBy);
        $em->persist($log);

        $em->flush();

        return new JsonResponse(['success' => true, 'message' => "Revoked $permission from $role"]);
    }

    return new JsonResponse(['success' => true, 'message' => 'No changes']);
}
}
