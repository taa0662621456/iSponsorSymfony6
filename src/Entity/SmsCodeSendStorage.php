<?php

	namespace App\Entity;
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="sms_code_send_storage")
	 * @ORM\HasLifecycleCallbacks()
	 */
	class SmsCodeSendStorage
	{
		use BaseTrait;

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

		/** @var bool
		 *
		 * @ORM\Column(type="boolean", name="is_login")
		 */
		protected $isLogin;

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