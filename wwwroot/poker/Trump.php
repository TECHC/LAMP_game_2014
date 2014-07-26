<?php
class Trump
{
	// カードの種類
	private $suit;
	// カードの数字
	private $suji;

	public function __constract($suit, $suji)
	{
		$this->suit = $suit;
		$this->suji = $suji;
	}

	/**
	 * カードの種類を返します。
	 * @return カードの種類($suit)
	 */
	public function getSuit()
	{
		return $this->suit;
	}

	/**
	 * カードの数字を返します
	 * @return カードの数字($suji)
	 */
	public function getSuji()
	{
		return $this->suji;
	}
}