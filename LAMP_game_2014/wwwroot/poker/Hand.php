<?php
// 手札管理クラス
class Hand
{
	private $hand = [];

	// 手札をセットする
	public function Hand($hand)
	{
		$this->hand = $hand;
	}

	// 手札を再セット
	public function setHand($hand)
	{
		$this->hand = $hand;
	}

	// 手札をすべて返す
	public function getHand()
	{
		return $this->hand;
	}
}