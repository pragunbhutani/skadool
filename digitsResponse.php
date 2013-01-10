<?php

      require_once 'plivo.php';
      require_once 'includes.php';

      $from = $_REQUEST['From'];
           
      $affirmative = 'Thanks, your delivery shall be scheduled today.';
      $negative = 'Thanks, your delivery shall be scheduled on another day.';
      $wrong_input = 'You just entered a wrong input! Have a good day!'

      $attributes = array (
        'loop' => 2,
      );
      $digits = $_REQUEST['Digits'];
      $response = new Response();
         
      if ($digits == '1') {
            $response->addSpeak($affirmative, $attributes);
            $updateAfterReply = "UPDATE visits SET status='Scheduled' WHERE contactNumber='" . $from . "'";
      } elseif ($digits == '2') {
            $response->addSpeak($negative, $attributes);
            $updateAfterReply = "UPDATE visits SET status='Unscheduled' WHERE contactNumber='" . $from . "'";

      } else {
            $response->addSpeak($wrong_input, $attributes);
      }
      
      mysql_query($updateAfterReply, $conn);

      header("Content-Type: text/xml");
      echo($response->toXML());

?>