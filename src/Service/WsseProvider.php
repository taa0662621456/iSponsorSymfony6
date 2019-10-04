<?php

	namespace App\Service;

	use App\Security\WsseUserToken;
	use Psr\Cache\CacheItemPoolInterface;
	use Psr\Cache\InvalidArgumentException;
	use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
	use Symfony\Component\Security\Core\User\UserProviderInterface;
	use Symfony\Component\Security\Core\Exception\AuthenticationException;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

	class WsseProvider implements AuthenticationProviderInterface
	{
		private $userProvider;
		private $cachePool;

		public function __construct(UserProviderInterface $userProvider, CacheItemPoolInterface $cachePool)
		{
			$this->userProvider = $userProvider;
			$this->cachePool = $cachePool;
		}

		public function authenticate(TokenInterface $token)
		{
			$user = $this->userProvider->loadUserByUsername($token->getUsername());

			try {
				if ($user && $this->validateDigest($token->digest, $token->nonce, $token->created, $user->getPassword())) {
					$authenticatedToken = new WsseUserToken($user->getRoles());
					$authenticatedToken->setUser($user);

					return $authenticatedToken;
				}
			} catch (InvalidArgumentException $e) {
			}

			throw new AuthenticationException('The WSSE authentication failed.');
		}

		/**
		 * Эта функция характерна исключительно для аутентификации WSSE и используется только для помощи в этом примере
		 * Чтобы узнать больше информации об особенной логике здесь, см.
		 * https://github.com/symfony/symfony-docs/pull/3134#issuecomment-27699129
		 *
		 * @param $digest
		 * @param $nonce
		 * @param $created
		 * @param $secret
		 *
		 * @return bool
		 * @throws InvalidArgumentException
		 */
		protected function validateDigest($digest, $nonce, $created, $secret)
		{
			// Проверить, чтобы созданное время не было в будущем
			if (strtotime($created) > time()) {
				return false;
			}

			// Временная метка истекает через 5 минут
			if (time() - strtotime($created) > 300) {
				return false;
			}

			// Попробовать извлечь объкт кеша из пула
			$cacheItem = $this->cachePool->getItem(md5($nonce));

			// Валидировать, что nonce *не* в кеше
			// если он там, это может быть повторной атакой
			if ($cacheItem->isHit()) {
				//throw new NonceExpiredException('Previously used nonce detected');
			}

			// Сохранить объект в кеше на 5 минут
			$cacheItem->set(null)->expiresAfter(300);
			$this->cachePool->save($cacheItem);

			// Валидировать секрет
			$expected = base64_encode(sha1(base64_decode($nonce) . $created . $secret, true));

			return hash_equals($expected, $digest);
		}

		public function supports(TokenInterface $token)
		{
			return $token instanceof WsseUserToken;
		}
	}