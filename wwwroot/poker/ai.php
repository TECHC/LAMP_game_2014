<?php
	define('HIGH_CARD',1);
	define('ONE_PAIR',2);
	define('TWO_PAIR',3);
	define('THREE_OF_A_KIND',4);
	define('STRAIGHT',5);
	define('FLUSH',6);
	define('FULL_HOUSE',7);
	define('FOUR_OF_A_KIND',8);
	define('STRAIGHT_FLASH',9);
	define('ROYAL_STRAIGHT_FLASH',10);

	abstract class AI
	{
		protected $hand;
		protected $status;
		protected $fieldCard;

		abstract function check();

		// --------------------------------------------------------

		public function setHand($handList)
		{
			$this->hand = $handList;
		}

		public function getHand()
		{
			return $this->hand;
		}

		// --------------------------------------------------------

		public function setStatus($status)
		{
			$this->status = $status;
		}

		public function getStatus()
		{
			return $this->status;
		}

		// --------------------------------------------------------

		public function setFieldCard($fieldCard)
		{
			$this->fieldCard = $fieldCard;
		}

		public function getFieldCard()
		{
			return $this->fieldCard;
		}

		// --------------------------------------------------------
	}