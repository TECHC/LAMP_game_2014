<?php

/**
 * MW用 Smartyラッパー
 *
 * @package magicweapon
 * @link http://www.grid-works-guild.net/MagicWeapon/ MagicWeapon
 * @access  public
 * @author  Michiaki Wuzawa <wuzawa@m-fr.net>
 * @create  $LastChangedDate$
 * @version $Revision$
 **/


class mw_smarty extends Smarty {

/*
 * HTMLタグを直接assignで扱いたい時用
 *
 * @access public
 */
public function assign_unsecure_raw($tpl_var, $value = null)
{
  //
  parent::assign($tpl_var, $value);
}

/*
 * assignのセキュアラッパー
 *
 * @access public
 */
public function set($tpl_var, $value = null)
{
  //
  parent::assign($this->_esc($tpl_var), $this->_esc($value));
}
public function assign($tpl_var, $value = null)
{
  $this->set($tpl_var, $value);
}

/*
 * 内部処理用関数
 *
 * @access protected
 */
protected function _esc($str){
  if(is_array($str)){
    $ret = array();
    foreach($str as $key => $val) {
      $ret[$key] = $this->_esc($val);
    }
    return $ret;
  }else{
    if (is_null($str)) {
      return null;
    }
    // else
    // XXX
    if (true === is_string($str) ) {
      return htmlspecialchars($str,ENT_QUOTES);
    }
    //else
    return $str;
  }
}

//private:


} // end of class


