


<?php

include_once("php/classes/Card.php");
include_once("php/classes/Client.php");

echo "<center>Hi, this is atm's main page!" . "<br>" . "Use this commands to work whis atm:" . "<br>" . "<br>" . "


																										" . "<br>" . "
?type=auth&num=[CARD_NUMBER]&pin=[PIN_CODE] ................,,, Логин									" . "<br>" . "
?sid=[SID]&bal= ...............................................	Проверить баланс						" . "<br>" . "
?sid=[SID]&chgpin=[NEW_PIN] ...................................	Сменить PIN-код							" . "<br>" . "
?sid=[SID]&withdraw=[SUM] .....................................	Снять наличные							" . "<br>" . "
?sid=[SID]&refill=[SUM] .......................................	Пополнить счет							" . "<br>" . "
?sid=[SID]&transfer=[SUM]&dest=[DESTINATION_CARD_NUMBER] ......	Перевести средства на другую карту		" . "<br>" . "
?sid=[SID]&end=	............................................... Закончить сессию						" . "<br></center>";


/*
 * authentication
 * */

if ($_GET['type'] == 'auth' && isset($_GET['num']) && isset($_GET['pin'])) {
    $card = new Card($_GET['num'], "");

	$card_info = $card->getInfoAboutCard();


    if ($card_info['Blocked'] == 1) {
         
        $card->endSession();
        die("card blocked");
    }

    $check = $card->checkPIN($_GET['pin']);

    if ($check == 0) {
        echo $card->keepInMindSID();
    }
    else
        echo $check;

}
/*
 * check balance
 * */
else if (isset($_GET['sid']) && isset($_GET['bal'])) {
    $card = new Card($_GET['num'], $_GET['sid']);


    if ($card->checkSID($_GET['sid']) == 1) {
         
        die('1');
    }

    $card_info = $card->getInfoAboutCard();

    echo $card->getBalance() . " " . $card_info["Available"];
}
/*
 * cnahge PIN
 * */
else if (isset($_GET['sid']) && isset($_GET['chgpin'])) {
    $card = new Card($_GET['num'], $_GET['sid']);
    if ($card->checkSID($_GET['sid']) == 1) {
         
        die('1');
    }

    echo $card->changePIN($_GET['chgpin']);
}
/*
 * withdraw cash
 * */
else if (isset($_GET['sid']) && isset($_GET['withdraw'])) {
    $card = new Card($_GET['num'], $_GET['sid']);
    if ($card->checkSID($_GET['sid']) == 1) {
         
        die('1');
    }

    echo $card->withdrawCash($_GET['withdraw']);
}
/*
 * refill balance
 * */
else if (isset($_GET['sid']) && isset($_GET['refill'])) {
    $card = new Card($_GET['num'], $_GET['sid']);
    if ($card->checkSID($_GET['sid']) == 1) {
         
        die('1');
    }

    echo $card->refillBalance($_GET['refill']);
}
/*
 * transfer monet to dest-card_number
 * */
else if (isset($_GET['sid']) && isset($_GET['transfer']) && isset($_GET['dest'])) {
    $card = new Card($_GET['num'], $_GET['sid']);
    if ($card->checkSID($_GET['sid']) == 1) {
         
        die('1');
    }

    $dest = new Card($_GET['dest'], "");

    echo $card->transferMoney($_GET['transfer'], $dest);
}
/*
 * end the session
 * */
else if (isset($_GET['sid']) && isset($_GET['end'])) {
    $card = new Card($_GET['num'], $_GET['sid']);
    if ($card->checkSID($_GET['sid']) == 1) {
         
        die('1');
    }

     
    echo $card->endSession();

}


