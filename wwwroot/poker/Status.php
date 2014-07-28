<?php
/**
 * 各個人のステータス
 */
class Status
{
	// 現在のコイン数
	private $coin = 10;
	// 現在賭けている金額
	private $nowCoin = 0;
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
	 * 現在のかけている金額を返します
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
	 * 現在のコインが足りていたら賭ける
	 * @param {int} coin 賭けるコインの数
	 * @return {Boolean} 賭けられたらtrue
	 */
	public function latch($coin)
	{
		if($coin < $this->coin)
		{
			$this->coin -= $coin;
			return true;
		}
		return false;
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
			$this->nowCoin = $this->coin;
			$this->coin = 0;
			$this->allInFlag = true;
			return false;
		}
	}

	public function bet($addCoin)
	{
		// コインが足りているか
		if($addCoin < $this->coin)
		{
			// 足りていたら減らす
			$this->coin -= $addCoin;
			$this->nowCoin += $addCoin;

			return $this->nowCoin;
		}
		// 足りない
		else
		{
			// オールインする
			$this->nowCoin = $this->coin;
			$this->coin = 0;
			$this->allInFlag = true;
			return $this->nowCoin;
		}
	}

	public function allIn()
	{
		// オールインする
		$this->nowCoin = $this->coin;
		$this->coin = 0;
		$this->allInFlag = true;
	}
}