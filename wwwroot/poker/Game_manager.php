<?php
// ポーカーのデータをすべて管理するクラス
class GameManager
{
	// 掛け金
	private $nowCoin = 0;

	// プレイヤー全員の手札
	private $handList = [];

	// トランプ
	private $trump = [];

	// 相手AIタイプなどを保存
	private $comAI = [];

	// ステータスを保存
	private $statusList = [];

	// フィールドのカード
	private $fieldCard = [];

	// 現在のゲームのターン
	private $gameTurn = 0;

	// 全プレイヤーの手札と現在の山札を取得
	public function GameManager()
	{
		
	}

	// --------------------------------------------------------

	/**
	 * 現在の山札をセットします
	 */
	public function setTrump($trump)
	{
		$this->trump = $trump;
	}

	/**
	 * 現在の山札を返します
	 */
	public function getTrump()
	{
		return $this->trump;
	}

	// --------------------------------------------------------

	/**
	 * プレイヤー全員の手札をセットします
	 */
	public function setHand($handList)
	{
		$this->handList = $handList;
	}

	/**
	 * プレイヤー全員の手札を返します
	 */
	public function getHand()
	{
		return $this->handList;
	}

	// --------------------------------------------------------

	/**
	 * 賭けコインをセットします
	 */
	public function setNowCoin($nowCoin)
	{
		$this->nowCoin = $nowCoin;
	}

	/**
	 * 賭けコインを返します
	 */
	public function getNowCoin()
	{
		return $this->nowCoin;
	}

	// --------------------------------------------------------

	/**
	 * コンピューターのAIタイプを保存します
	 */
	public function setComAI($comAI)
	{
		$this->comAI = $comAI;
	}

	/**
	 * コンピューターのAIタイプを返します
	 */
	public function getComAI()
	{
		return $this->comAI;
	}

	// --------------------------------------------------------

	/**
	 * 各プレイヤーのステータスを保存
	 */
	public function setStatus($statusList)
	{
		$this->statusList = $statusList;
	}

	/**
	 * 各プレイヤーのステータスを返します
	 */
	public function getStatus()
	{
		return $this->statusList;
	}

	// --------------------------------------------------------

	/**
	 * 現在のゲームターンを保存
	 */
	public function setGameTurn($gameTurn)
	{
		$this->gameTurn = $gameTurn;
	}

	/**
	 * 現在のゲームターンを返す
	 */
	public function getGameTurn()
	{
		return $this->gameTurn;
	}

	// --------------------------------------------------------

	/**
	 * 現在のフィールドのカードを保存
	 */
	public function setFieldCard($fieldCard)
	{
		$this->fieldCard = $fieldCard;
	}

	/**
	 * 現在のフィールドのカードを返す
	 */
	public function getFieldCard()
	{
		return $this->fieldCard;
	}


}