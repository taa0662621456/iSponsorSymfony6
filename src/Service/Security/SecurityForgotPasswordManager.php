<?php
namespace App\Service\Security;

use App\Entity\Security\SecurityPasswordRequest;
use App\Entity\Vendor\VendorSecurity;
use App\Repository\Security\SecurityPasswordRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mailer\MailerInterface;

class SecurityForgotPasswordManager
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SecurityPasswordRequestRepository $repo,
        private readonly MailerInterface $mailer,
        private readonly string $fromEmail,
        private readonly string $fromName,
        private readonly int $ttlMinutes = 30
    ) {}

    public function createRequest(VendorSecurity $user): SecurityPasswordRequest
    {
        $this->repo->invalidateAllForUser($user->getId());
        $token = Uuid::v4()->toRfc4122();
        $req = new SecurityPasswordRequest($user, $token, new \DateTimeImmutable("+{$this->ttlMinutes} minutes"));
        $this->em->persist($req);
        $this->em->flush();

        $email = (new TemplatedEmail())
            ->from(new Address($this->fromEmail, $this->fromName))
            ->to($user->getEmail())
            ->subject('Password reset')
            ->htmlTemplate('security/email/reset_password.html.twig')
            ->context(['token' => $token, 'user' => $user]);

        $this->mailer->send($email);
        return $req;
    }

    public function consume(string $token, string $newHash): ?VendorSecurity
    {
        /** @var SecurityPasswordRequest|null $req */
        $req = $this->repo->findOneBy(['token' => $token, 'published' => true]);
        if (!$req || $req->isExpired() || $req->getId() === null) return null;

        $user = $req->getUser();
        $user->setPassword($newHash);
        $req->markUsed();
        $req->setPublished(false);
        $this->em->flush();

        return $user;
    }
}