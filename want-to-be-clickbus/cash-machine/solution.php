<?php
//I did a generic solution for any number.
Class CashMachine{
  
  private $availableMoney;
  
  Public function CashMachine($values){
    rsort($values); // to allow different order of values we have to order the array descendently
    $this->availableMoney = $values;
  }
  Private function checkIsValid($money,$value){
    $mod = $money % $value;
    return($mod != $money);
  }
  Public function getMoney($money=null){
    $return = array();
    if(!isset($money)){
      throw new InvalidArgumentException('[Empty Set]');
    }
    if($money < 0){
      throw new InvalidArgumentException('getMoney function only accepts integers positives. Input was: '.$money);
    }
    $valuesleft = $money;
    while($valuesleft > 0){ //while the money still left
      $prevalue = $valuesleft;
      foreach($this->availableMoney as $key => $value){ //loop around the money values in the machine
   	if($this->checkIsValid($valuesleft,$value)){ //if value is still valid
          $valuesleft =  $valuesleft - $value;
          $return[] = $value;
          break;
        }
      }
      if($valuesleft == $prevalue){ //if we check all values and anything has changed, this mean that is not a valid number
        throw new InvalidArgumentException('Only accepts partible money. Input was: '.$money);
      }
    }
    return $return;
   }
}

$machine = new CashMachine(array(100,20,50,10,5,3));
if($arrmoney = $machine->getMoney(33)){
echo "[";
foreach($arrmoney as $key => $money){
  echo $money;
  if($key < count($arrmoney)-1){
    echo ", ";
  }
}
echo "]";
}

?>
