<?php
namespace App\Security;

use App\Entity\Vendor\SecurityApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\BadgeInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class ApiKeyAuthenticator extends AbstractAuthenticator
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function supports(Request $r): ?bool
    {
        return $r->headers->has('X-AUTH-TOKEN');
    }

    public function authenticate(Request $r): SelfValidatingPassport
    {
        $raw = (string)$r->headers->get('X-AUTH-TOKEN') ?: '';
        if ($raw === '') throw new CustomUserMessageAuthenticationException('No token.');

        $token = $this->em->getRepository(SecurityApiToken::class)->findOneBy(['code' => $raw, 'published' => true]);
        if (!$token) throw new CustomUserMessageAuthenticationException('Invalid token.');

        // IP-фильтр
        $ip = $r->getClientIp() ?? '0.0.0.0';
        if (!$token->isIpAllowed($ip)) {
            throw new CustomUserMessageAuthenticationException('IP not allowed.');
        }

        // срок действия можешь хранить в BaseTrait.expiresAt (если добавил)
        if (method_exists($token, 'getExpiresAt')) {
            $exp = $token->getExpiresAt();
            if ($exp instanceof \DateTimeImmutable && $exp <= new \DateTimeImmutable()) {
                throw new CustomUserMessageAuthenticationException('Token expired.');
            }
        }

        $user = $token->getVendor();
        return new SelfValidatingPassport(
            new UserBadge($user->getUserIdentifier(), fn() => $user),
            array_filter([
                // можно повесить сюда кастомные Badge с проверкой scope/ролей, если нужно
            ], fn(?BadgeInterface $b) => $b !== null)
        );
    }

    public function onAuthenticationFailure(Request $request, $exception): ?JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], 401);
    }

    public function onAuthenticationSuccess(Request $request, $token, string $firewallName): ?JsonResponse
    {
        return null; // пропускаем дальше
    }
}
