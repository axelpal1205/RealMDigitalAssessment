<?php

	class API_Calls {

		private function connect( $endpoint ){
			$cURLConnection = curl_init('https://interview-assessment-1.realmdigital.co.za/'. $endpoint );
			curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
			$apiResponse = curl_exec($cURLConnection);
			$httpcode = curl_getinfo($cURLConnection, CURLINFO_HTTP_CODE);
			curl_close($cURLConnection);

			if( $httpcode != 200 )
				return;

			return json_decode($apiResponse);
		}

		public function getEmployeeList( ){
			return $this->connect('employees');
		}

		public function getExclusionList(){
			return $this->connect('do-not-send-birthday-wishes');
		}

	}