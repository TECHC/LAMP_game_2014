<?php
/**
 * 各個人のステータス
 */
class Status
{
	// 現在のコイン数
	private $coin = 10;
	// 現在賭けている金額
	private $nowCoin = 5;
	// 名前
	private $name;

	// フォールドしているかどうか
	private $foldFlag = false;
	// オールインしているかどうか
	private $allInFlag = false;
	// --------------------------------------------------------

	public function Status($name)
	{
		$this->name = $name;
	}

	// --------------------------------------------------------

	/**
	 * 現在のコイン数をセットします
	 */
	public function setCoin($coin)
	{
		$this->coin = $coin;
	}

	/**
	 * 現在のコイン数を返します
	 */
	public function getCoin()
	{
		return $this->coin;
	}

	// --------------------------------------------------------

	/**
	 * 現在の賭けている金額をセットします
	 */
	public function setNowCoin($nowCoin)
	{
		$this->nowCoin = $nowCoin;
	}

	/**
	 * 現在の山札を返します
	 */
	public function getNowCoin()
	{
		return $this->nowCoin;
	}

	// --------------------------------------------------------

	/**
	 * 現在フォールドしているかどうかをセットします
	 */
	public function setfoldFlag($foldFlag)
	{
		$this->foldFlag = $foldFlag;
	}

	/**
	 * 現在フォールドしているかどうかを返します
	 */
	public function getfoldFlag()
	{
		return $this->foldFlag;
	}

	// --------------------------------------------------------

	/**
	 * 現在オールインしているかどうかをセットします
	 */
	public function setAllInFlag($foldFlag)
	{
		$this->foldFlag = $foldFlag;
	}

	/**
	 * 現在オールインしているかどうかを返します
	 */
	public function getAllInFlag()
	{
		return $this->foldFlag;
	}

	// --------------------------------------------------------
	
	/**
	 * オールインかフォールドをしていたらtrueを返す
	 * @return {Boolean} していたらture
	 */
	public function isAllInORFold()
	{
		if($this->foldFlag || $this->allInFlag)
		{
			return true;
		}
		return false;
	}
	// --------------------------------------------------------
	/**
	 * 名前を返す
	 */
	public function getName()
	{
		return $this->name;
	}

	// --------------------------------------------------------

	/**
	 * コールとチェックの処理
	 * もしも掛け金に足りない場合はオールインになる
	 * @return {Boolean} true コールチェック成功 / false オールインした
	 */
	public function call($nowCoin)
	{
		// 賭けなければならないコイン数
		$needCoin = $nowCoin - $this->nowCoin;
		// コイン足りるか
		if($needCoin <= $this->coin)
		{
			// コインを減らす
			$this->coin -= $needCoin;
			$this->nowCoin = $nowCoin;

			return true;
		}
		else
		{
			// オールインする
			$coin = 0;
			$this->allInFlag = true;

			return false;
		}
	}
}