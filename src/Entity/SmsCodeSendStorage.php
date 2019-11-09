<?php

	namespace App\Entity;

	use Doctrine\ORM\Mapping as ORM;


	/**
	 * @ORM\Table(name="sms_code_send_storage", indexes={
	 * @ORM\Index(name="sms_code_send_storage_idx", columns={"phone"})}))
	 * @ORM\Entity(repositoryClass="App\Repository\SmsCodeStorageRepository")
	 * @ORM\HasLifecycleCallbacks()
	 */
	class SmsCodeSendStorage
	{
		/**
		 * @var integer
		 *
		 * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue
		 */
		private $id;

		/**
		 * @var srting
		 *
		 * @ORM\Column(type="string", name="phone")
		 */
		protected $phone;

		/**
		 * @var int
		 *
		 * @ORM\Column(type="code")
		 */
		private $code;

		/**
		 * @var bool
		 *
		 * @ORM\Column(type="boolean", name="is_login")
		 */
		protected $isLogin;

		/**
		 * @return int
		 */
		public function getId(): int
		{
			return $this->id;
		}

		/**
		 * @return srting
		 */
		public function getPhone()
		{
			return $this->phone;
		}

		/**
		 * @param srting $phone
		 */
		public function setPhone($phone): void
		{
			$this->phone = $phone;
		}

		/**
		 * @return int
		 */
		public function getCode(): int
		{
			return $this->code;
		}

		/**
		 * @param int $code
		 */
		public function setCode(int $code): void
		{
			$this->code = $code;
		}

		/**
		 * @return bool
		 */
		public function isLogin(): bool
		{
			return $this->isLogin;
		}

		/**
		 * @param bool $isLogin
		 */
		public function setIsLogin(bool $isLogin): void
		{
			$this->isLogin = $isLogin;
		}


	}