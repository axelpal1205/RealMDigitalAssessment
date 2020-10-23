<?php

	class Send_Message {



		public function send_birthday_wish( $name, $surname ){
			$this->composeEmail( $name, $surname, "Birthday Wishes", "Happy Birthday" );
		}

		public function send_anniversary($name, $surname){
			$this->composeEmail( $name, $surname, "Anniversary", "Happy Anniversary" );
			
		}

		
		private function composeEmail( $name, $surname, $subject, $message ){
			$to = "test@gmail.com";
			$subject = $subject;
			$message = sprintf("<b>%s %s, %s.</b>", $message, $name, $surname);
			$header = "From:no-reply@realmdigital.com \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";

			$retval = mail ($to,$subject,$message,$header);
		}

	}