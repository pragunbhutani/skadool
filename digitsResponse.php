<?php

      require_once 'plivo.php';
      require_once 'includes.php';

      $from = $_GET['From'];
           
      $affirmative = 'Thanks, your delivery shall be scheduled today.';
      $negative = 'Okay, your delivery shall be scheduled on another day.';
      $wrong_input = 'You just entered a wrong input! Have a good day!';

      $attributes = array (
        'loop' => 1,
      );
      $digits = $_REQUEST['Digits'];
      $response = new Response();
         
      if ($digits == '1') {
            $response->addSpeak($affirmative, $attributes);
            $updateAfterReply = "UPDATE visits SET status='Scheduled', updateTime=" . time() . " WHERE contactNumber='" . $from . "'";
            mysql_query($updateAfterReply, $conn);
      } elseif ($digits == '2') {
            $response->addSpeak($negative, $attributes);
            $updateAfterReply = "UPDATE visits SET status='Unscheduled', updateTime=" . time() . " WHERE contactNumber='" . $from . "'";
            mysql_query($updateAfterReply, $conn);

      } else {
            $response->addSpeak($wrong_input, $attributes);
      }

      header("Content-Type: text/xml");
      echo($response->toXML());

?>
