<?php

declare(strict_types=1);
require_once __DIR__ . '/../libs/VariableProfileHelper.php';

	class PontosBaseV2 extends IPSModule
	{
		use VariableProfileHelper;
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			$this->RegisterPropertyString('IPAddress', '');
			$this->RegisterPropertyString('Modell', '0');
			$this->RegisterAttributeString('URI', '');

			$this->RegisterAttributeBoolean('AdminMode', true);
			$this->RegisterAttributeBoolean('AdminModeUserActivated', true);
			
			$this->RegisterPropertyInteger('getSRN', 0);
			$this->RegisterPropertyBoolean('getSRNbool', false);
			$this->RegisterPropertystring('getVER', '');
			$this->RegisterPropertyBoolean('getVERbool', false);
			$this->RegisterPropertyInteger('getTYP', 0);
			$this->RegisterPropertyBoolean('getTYPbool', false);
			$this->RegisterPropertystring('getCNO', '');
			$this->RegisterPropertyBoolean('getCNObool', false);
			$this->RegisterPropertystring('getMAC', '');
			$this->RegisterPropertyBoolean('getMACbool', false);

			$this->RegisterPropertystring('getPN', '');
			$this->RegisterPropertyBoolean('getPNbool', false);
			$this->RegisterPropertyInteger('getPV', 0);
			$this->RegisterPropertyBoolean('getPVbool', false);
			$this->RegisterPropertyInteger('getPT', 0);
			$this->RegisterPropertyBoolean('getPTbool', false);
			$this->RegisterPropertyInteger('getPF', 0);
			$this->RegisterPropertyBoolean('getPFbool', false);
			$this->RegisterPropertyInteger('getPM', 0);
			$this->RegisterPropertyBoolean('getPMbool', false);
			$this->RegisterPropertyInteger('getPR', 0);
			$this->RegisterPropertyBoolean('getPRbool', false);
			$this->RegisterPropertyInteger('getPB', 0);
			$this->RegisterPropertyBoolean('getPBbool', false);

			$this->RegisterPropertyInteger('getTMP', 0);
			$this->RegisterPropertyBoolean('getTMPbool', false);
			$this->RegisterPropertyInteger('getVLV', 0);
			$this->RegisterPropertyBoolean('getVLVbool', false);
			$this->RegisterPropertyInteger('getCEL', 0);
			$this->RegisterPropertyBoolean('getCELbool', false);
			$this->RegisterPropertyInteger('getBAR', 0);
			$this->RegisterPropertyBoolean('getBARbool', false);
			$this->RegisterPropertyInteger('getNPS', 0);
			$this->RegisterPropertyBoolean('getNPSbool', false);
			$this->RegisterPropertystring('getALA', '');
			$this->RegisterPropertyBoolean('getALAbool', false);
			$this->RegisterPropertystring('getALM', '');
			$this->RegisterPropertyBoolean('getALMbool', false);
			$this->RegisterPropertyInteger('getDMA', 0);
			$this->RegisterPropertyBoolean('getDMAbool', false);
			$this->RegisterPropertystring('getAVO', '');
			$this->RegisterPropertyBoolean('getAVObool', false);
			$this->RegisterPropertystring('getVOL', '');
			$this->RegisterPropertyBoolean('getVOLbool', false);
			$this->RegisterPropertyFloat('getBAT', 0);
			$this->RegisterPropertyBoolean('getBATbool', false);
			$this->RegisterPropertyFloat('getNET', 0);
			$this->RegisterPropertyBoolean('getNETbool', false);
			$this->RegisterPropertyInteger('getBUZ', 0);
			$this->RegisterPropertyBoolean('getBUZbool', false);
			$this->RegisterPropertyInteger('getDBD', 0);
			$this->RegisterPropertyBoolean('getDBDbool', false);
			$this->RegisterPropertyInteger('getWFS', 0);
			$this->RegisterPropertyBoolean('getWFSbool', false);
			$this->RegisterPropertyInteger('getWFR', 0);
			$this->RegisterPropertyBoolean('getWFRbool', false);
			$this->RegisterPropertyInteger('getRTC', 0);
			$this->RegisterPropertyBoolean('getRTCbool', false);
			$this->RegisterPropertyInteger('getIDS', 0);
			$this->RegisterPropertyBoolean('getIDSbool', false);
			$this->RegisterPropertyInteger('getTMZ', 0);
			$this->RegisterPropertyBoolean('getTMZbool', false);
			$this->RegisterPropertyInteger('getCND', 0);
			$this->RegisterPropertyBoolean('getCNDbool', false);
			$this->RegisterPropertyInteger('getCND2', 0);
			$this->RegisterPropertyBoolean('getCND2bool', false);

			$this->RegisterPropertyInteger('getSLP', 0);
			$this->RegisterPropertyBoolean('getSLPbool', false);
			
			$this->RegisterPropertyInteger('getLOCK', 0);
			$this->RegisterPropertyBoolean('getLOCKbool', false);
			$this->RegisterPropertyInteger('getPROFILESW', 0);
			$this->RegisterPropertyBoolean('getPROFILESWbool', false);
			$this->RegisterPropertyBoolean('getALASW', false);
			$this->RegisterPropertyBoolean('getALASWbool', false);

						
			$this->RegisterTimer('HGPB_UpdateData', 0, 'HGPB_UpdateData($_IPS[\'TARGET\']);');
			$this->RegisterPropertyInteger('UpdateDataInterval', 60);
		
			
		}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();

			$this->SetTimerInterval('HGPB_UpdateData', $this->ReadPropertyInteger('UpdateDataInterval') * 1000);

			if ($this->ReadPropertyInteger('UpdateDataInterval') == 0){
				$this->SetStatus(104);
			} else {
				$this->SetStatus(102);
			}

			// create Profile
			if (!@IPS_VariableProfileExists("WaterManagement.Profile"))
			{
				IPS_CreateVariableProfile("WaterManagement.Profile", 1);
				IPS_SetVariableProfileDigits("WaterManagement.Profile", 1);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 1, $this->Translate('present'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 2, $this->Translate('absent'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 3, $this->Translate('holiday'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 4, $this->Translate('increased consumption'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 5, $this->Translate('max consumption'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 6, $this->Translate('not definied'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 7, $this->Translate('not definied'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Profile", 8, $this->Translate('not definied'), "", 0xFFFFFF);
				IPS_SetVariableProfileValues("WaterManagement.Profile", 1, 8, 1);
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Valve"))
			{
				IPS_CreateVariableProfile("WaterManagement.Valve", 1);
				IPS_SetVariableProfileDigits("WaterManagement.Valve", 1);
				IPS_SetVariableProfileAssociation("WaterManagement.Valve", 10, $this->Translate('close'), "", 0xFF0000);
				IPS_SetVariableProfileAssociation("WaterManagement.Valve", 11, $this->Translate('will be closed'), "", 0xFF0000);
				IPS_SetVariableProfileAssociation("WaterManagement.Valve", 20, $this->Translate('open'), "", 0x00FF00);
				IPS_SetVariableProfileAssociation("WaterManagement.Valve", 21, $this->Translate('will be opened'), "", 0x00FF00);
				IPS_SetVariableProfileValues("WaterManagement.Valve", 10, 20, 10);
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Mbar"))
			{
				IPS_CreateVariableProfile("WaterManagement.Mbar", 1);
				IPS_SetVariableProfileText ("WaterManagement.Mbar", ""," mbar");
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Liter"))
			{
				IPS_CreateVariableProfile("WaterManagement.Liter", 1);
				IPS_SetVariableProfileText ("WaterManagement.Liter", ""," L");
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Mliter"))
			{
				IPS_CreateVariableProfile("WaterManagement.Mliter", 1);
				IPS_SetVariableProfileText ("WaterManagement.Mliter", ""," mL");
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Conductivity"))
			{
				IPS_CreateVariableProfile("WaterManagement.Conductivity", 1);
				IPS_SetVariableProfileText ("WaterManagement.Conductivity", ""," µS/cm");
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Hardness"))
			{
				IPS_CreateVariableProfile("WaterManagement.Hardness", 1);
				IPS_SetVariableProfileDigits("WaterManagement.Hardness", 1);
				IPS_SetVariableProfileAssociation("WaterManagement.Hardness", 4, $this->Translate('very soft'), "", 0x00FF00);
				IPS_SetVariableProfileAssociation("WaterManagement.Hardness", 9, $this->Translate('soft'), "", 0x00DC00);
				IPS_SetVariableProfileAssociation("WaterManagement.Hardness", 15, $this->Translate('slightly hard'), "", 0x00C800);
				IPS_SetVariableProfileAssociation("WaterManagement.Hardness", 19, $this->Translate('moderately hard'), "", 0xFF0101);
				IPS_SetVariableProfileAssociation("WaterManagement.Hardness", 24, $this->Translate('hard'), "", 0xE60000);
				IPS_SetVariableProfileAssociation("WaterManagement.Hardness", 25, $this->Translate('very hard'), "", 0xC80000);

				IPS_SetVariableProfileValues("WaterManagement.Hardness", 0, 0, 1);
			}
			if (!@IPS_VariableProfileExists("WaterManagement.Alarm"))
			{
				IPS_CreateVariableProfile("WaterManagement.Alarm", 3);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "FF", $this->Translate('NO ALARM'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A1", $this->Translate('ALARM END SWITCH'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A2", $this->Translate('ALARM TURBINE BLOCKED'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A3", $this->Translate('ALARM VOLUME LEAKAGE'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A4", $this->Translate('ALARM TIME LEAKAGE'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A5", $this->Translate('ALARM MAX FLOW LEAKAGE'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A6", $this->Translate('ALARM MICRO LEAKAGE'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A7", $this->Translate('ALARM EXT. SENSOR LEAKAGE RADIO'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A8", $this->Translate('ALARM EXT. SENSOR LEAKAGE CABLE'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "A9", $this->Translate('ALARM PRESSURE SENSOR ERROR'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "AA", $this->Translate('ALARM TEMPERATURE SENSOR ERROR'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "AB", $this->Translate('ALARM LOW BATTERY'), "", 0xFFFFFF);
				IPS_SetVariableProfileAssociation("WaterManagement.Alarm", "AE", $this->Translate('Error: no more information available'), "", 0xFFFFFF);
			}
			if (!@IPS_VariableProfileExists("WaterManagement.clrAla"))
			{
				IPS_CreateVariableProfile("WaterManagement.clrAla", 1);
				IPS_SetVariableProfileDigits("WaterManagement.clrAla", 1);
				IPS_SetVariableProfileAssociation("WaterManagement.clrAla", 0, $this->Translate('clear Alarm'), "", 0x00FF00);
			}

			if (!@IPS_VariableProfileExists("WaterManagement.WifiStatus"))
			{
				IPS_CreateVariableProfile("WaterManagement.WifiStatus", 1);
				IPS_SetVariableProfileAssociation("WaterManagement.WifiStatus", 0, $this->Translate('Disconnect'), "", 0x00FF00);
				IPS_SetVariableProfileAssociation("WaterManagement.WifiStatus", 1, $this->Translate('Connecting'), "", 0x00FF00);
				IPS_SetVariableProfileAssociation("WaterManagement.WifiStatus", 2, $this->Translate('Connected'), "", 0x00FF00);
				IPS_SetVariableProfileText ("WaterManagement.WifiStatus", "","");
			}

			if (!@IPS_VariableProfileExists("WaterManagement.DSM"))
			{
				IPS_CreateVariableProfile("WaterManagement.DSM", 1);
				IPS_SetVariableProfileAssociation("WaterManagement.DSM", 0, $this->Translate('disabled'), "", 0x00FF00);
				IPS_SetVariableProfileAssociation("WaterManagement.DSM", 1, $this->Translate('enabled'), "", 0x00FF00);
				IPS_SetVariableProfileText ("WaterManagement.DSM", "","");
			}
			
			
			############################### 

			$this->MaintainVariable('getPN', $this->Translate('name of active profile'),3, "",100, $this->ReadPropertyBoolean('getPNbool') == true);
			$this->MaintainVariable('getPV', $this->Translate('water volume of active profile'),1, "",101, $this->ReadPropertyBoolean('getPVbool') == true);
			$this->MaintainVariable('getPT', $this->Translate('flow duration time of active profile'),1, "",102, $this->ReadPropertyBoolean('getPTbool') == true);
			$this->MaintainVariable('getPF', $this->Translate('water flow l/h for active profile'),1, "",103, $this->ReadPropertyBoolean('getPFbool') == true);
			$this->MaintainVariable('getPM', $this->Translate('micro leak detection for active profile'),0, "~Switch",104, $this->ReadPropertyBoolean('getPMbool') == true);
			$this->MaintainVariable('getPB', $this->Translate('Active state for buzzer for active profile'),1, "",105, $this->ReadPropertyBoolean('getPBbool') == true);
			$this->MaintainVariable('getPROFILESW', $this->Translate('switch active profile'),1, "WaterManagement.Profile",110, $this->ReadPropertyBoolean('getPROFILESWbool') == true);


			$this->MaintainVariable('getVLV', $this->Translate('Valvestate'),1, "WaterManagement.Valve",6, $this->ReadPropertyBoolean('getVLVbool') == true);
			$this->MaintainVariable('getVOL', $this->Translate('total volume in liters'),1, "WaterManagement.Liter",7, $this->ReadPropertyBoolean('getVOLbool') == true);
			$this->MaintainVariable('getBAT', $this->Translate('battery voltage'),2, "~Volt",8, $this->ReadPropertyBoolean('getBATbool') == true);
			$this->MaintainVariable('getNET', $this->Translate('voltage of power adapter'),2, "~Volt",9, $this->ReadPropertyBoolean('getNETbool') == true);
			$this->MaintainVariable('getCND', $this->Translate('water conductivity'),1, "WaterManagement.Conductivity",10, $this->ReadPropertyBoolean('getCNDbool') == true);
			$this->MaintainVariable('getCND2', $this->Translate('water hardness level'),1, "WaterManagement.Hardness",11, $this->ReadPropertyBoolean('getCND2bool') == true);
			$this->MaintainVariable('getBAR', $this->Translate('water pressure'),1, "WaterManagement.Mbar",12, $this->ReadPropertyBoolean('getBARbool') == true);

			$this->MaintainVariable('getSRN', $this->Translate('Serial-no.'),1, "",20, $this->ReadPropertyBoolean('getSRNbool') == true);
			$this->MaintainVariable('getVER', $this->Translate('Firmware Version'),3, "",21, $this->ReadPropertyBoolean('getVERbool') == true);
			$this->MaintainVariable('getTYP', $this->Translate('Type'),1, "",22, $this->ReadPropertyBoolean('getTYPbool') == true);
			$this->MaintainVariable('getCNO', $this->Translate('Code-no.'),3, "",23, $this->ReadPropertyBoolean('getCNObool') == true);
			$this->MaintainVariable('getMAC', $this->Translate('MAC Address'),3, "",24, $this->ReadPropertyBoolean('getMACbool') == true);
			$this->MaintainVariable('getRTC', $this->Translate('current time of Pontos-Base'),1, "~UnixTimestamp",25, $this->ReadPropertyBoolean('getRTCbool') == true);
			$this->MaintainVariable('getALA', $this->Translate('current alarm'),3, "WaterManagement.Alarm",26, $this->ReadPropertyBoolean('getALAbool') == true);

			$this->MaintainVariable('getPR', $this->Translate('getPR'),1, "",61, $this->ReadPropertyBoolean('getPRbool') == true);
			
			$this->MaintainVariable('getTMP', $this->Translate('Get temporary deactivation for leakage detection time'),1, "",63, $this->ReadPropertyBoolean('getTMPbool') == true);
			$this->MaintainVariable('getCEL', $this->Translate('Get water temperature'),2, "~Temperature",65, $this->ReadPropertyBoolean('getCELbool') == true);
			$this->MaintainVariable('getNPS', $this->Translate('Get no pulse time of turbine in seconds'),1, "",67, $this->ReadPropertyBoolean('getNPSbool') == true);
			$this->MaintainVariable('getALM', $this->Translate('Alert memory '),3, "",69, $this->ReadPropertyBoolean('getALMbool') == true);
			$this->MaintainVariable('getDMA', $this->Translate('getDMA'),1, "",70, $this->ReadPropertyBoolean('getDMAbool') == true);
			$this->MaintainVariable('getAVO', $this->Translate('Get volume of the current water consumption process in mm'),1, "WaterManagement.Mliter",71, $this->ReadPropertyBoolean('getAVObool') == true);
			$this->MaintainVariable('getBUZ', $this->Translate('Get state of alarm buzzer'),1, "",76, $this->ReadPropertyBoolean('getBUZbool') == true);
			$this->MaintainVariable('getDBD', $this->Translate('Get the configured Micro Leakage test pressure drop in bar.'),1, "",77, $this->ReadPropertyBoolean('getDBDbool') == true);
			$this->MaintainVariable('getWFS', $this->Translate('Get Wifi connection state'),1, "WaterManagement.WifiStatus",85, $this->ReadPropertyBoolean('getWFSbool') == true);
			$this->MaintainVariable('getWFR', $this->Translate('Get Wifi connection strength (RSSI)'),1, "~Intensity.100",86, $this->ReadPropertyBoolean('getWFRbool') == true);
			$this->MaintainVariable('getIDS', $this->Translate('Get activation state of Daylight saving mode'),1, "WaterManagement.DSM",88, $this->ReadPropertyBoolean('getIDSbool') == true);
			$this->MaintainVariable('getTMZ', $this->Translate('Get set time zone'),1, "",89, $this->ReadPropertyBoolean('getTMZbool') == true);
			$this->MaintainVariable('getSLP', $this->Translate('days left for self learning procedure'),1, "",89, $this->ReadPropertyBoolean('getSLPbool') == true);

			$this->MaintainVariable('getLOCK', $this->Translate('lock or unlock valve'),1, "WaterManagement.Valve",90, $this->ReadPropertyBoolean('getLOCKbool') == true);

			$this->MaintainVariable('getALASW', $this->Translate('clear Alarm'),1, "WaterManagement.clrAla",92, $this->ReadPropertyBoolean('getALASWbool') == true);

			######################## 
			// check if user deactivate variable with own IPS Profiles and delete them

			if  ( ((!$this->ReadPropertyBoolean('getVLVbool')) AND ((!$this->ReadPropertyBoolean('getLOCKbool')) AND (@IPS_VariableProfileExists("WaterManagement.Valve")) )))
			{
				IPS_DeleteVariableProfile("WaterManagement.Valve");
			}

			if  ( ((!$this->ReadPropertyBoolean('getAVObool')) AND (@IPS_VariableProfileExists("WaterManagement.Mliter")) ))
			{
				IPS_DeleteVariableProfile("WaterManagement.Mliter");
			}
			
			if  ( ((!$this->ReadPropertyBoolean('getBARbool')) AND (@IPS_VariableProfileExists("WaterManagement.Mbar")) ))
			{
				IPS_DeleteVariableProfile("WaterManagement.Mbar");
			}
			
			if  ( ((!$this->ReadPropertyBoolean('getVOLbool')) AND (@IPS_VariableProfileExists("WaterManagement.Liter")) ))
			{
				IPS_DeleteVariableProfile("WaterManagement.Liter");
			}

			if  ( ((!$this->ReadPropertyBoolean('getCNDbool')) AND (@IPS_VariableProfileExists("WaterManagement.Conductivity")) ))
			{
				IPS_DeleteVariableProfile("WaterManagement.Conductivity");
			}

			if  ( ((!$this->ReadPropertyBoolean('getCND2bool')) AND (@IPS_VariableProfileExists("WaterManagement.Hardness")) ))
			{
				IPS_DeleteVariableProfile("WaterManagement.Hardness");
			}

			if  ($this->ReadPropertyBoolean('getLOCKbool') )
			{
				$this->EnableAction('getLOCK');
			}
			if  ($this->ReadPropertyBoolean('getPROFILESWbool') )
			{
				$this->EnableAction('getPROFILESW');
			}
			if  ($this->ReadPropertyBoolean('getALASWbool') )
			{
				$this->EnableAction('getALASW');
			}
		
			if (!$this->ReadPropertyBoolean('getCNDbool') )
			{
				$this->UnregisterVariable("getCND2");
			}
			########################

		}

		public function GetConfigurationForm()
		{
			$jsonForm = json_decode(file_get_contents(__DIR__ . "/form.json"), true);
			
			if ($this->Getstatus() == 104 ){
				$jsonForm["elements"][4]["visible"] = true;
			}

			if ($this->ReadAttributeBoolean('AdminMode') )
			{
				//$jsonForm["actions"][3]["visible"] = false;

				// check if the user activate the adminmode "outside" from the module. In this case let the user show the "Enable Admin Mode" Button again
				/*
				$jsonForm["elements"][5]["items"][6]["visible"] = true;
				$jsonForm["elements"][5]["items"][8]["visible"] = true;
				$jsonForm["elements"][5]["items"][9]["visible"] = true;

				$jsonForm["elements"][5]["items"][10]["visible"] = true;
				$jsonForm["elements"][5]["items"][11]["visible"] = true;
				$jsonForm["elements"][5]["items"][12]["visible"] = true;
				$jsonForm["elements"][5]["items"][13]["visible"] = true;
				$jsonForm["elements"][5]["items"][14]["visible"] = true;
				$jsonForm["elements"][5]["items"][15]["visible"] = true;

				// ADMIN ONLY i created all elements incl. unknown variables... for release hide them
				 
				$jsonForm["elements"][6]["items"][10]["visible"] = true;
				$jsonForm["elements"][6]["items"][11]["visible"] = true;

				$jsonForm["elements"][6]["items"][14]["visible"] = true;
				$jsonForm["elements"][6]["items"][15]["visible"] = true;
				$jsonForm["elements"][6]["items"][18]["visible"] = true;
				$jsonForm["elements"][6]["items"][20]["visible"] = true;
				$jsonForm["elements"][6]["items"][21]["visible"] = true;
				$jsonForm["elements"][6]["items"][22]["visible"] = true;
				$jsonForm["elements"][6]["items"][23]["visible"] = true;
				$jsonForm["elements"][6]["items"][24]["visible"] = true;
				$jsonForm["elements"][6]["items"][25]["visible"] = true;
				$jsonForm["elements"][6]["items"][26]["visible"] = true;
				*/
				if ($this->ReadPropertyBoolean('getCNDbool') )
				{
					$jsonForm["elements"][5]["items"][10]["enabled"] = true;
				}
			}

			// i created all elements incl. unknown variables... for release hide them
			/*
			$jsonForm["elements"][6]["items"][9]["visible"] = true;
			$jsonForm["elements"][6]["items"][12]["visible"] = true;
			$jsonForm["elements"][6]["items"][13]["visible"] = true;
			$jsonForm["elements"][6]["items"][16]["visible"] = true;
			$jsonForm["elements"][6]["items"][17]["visible"] = true;
			$jsonForm["elements"][6]["items"][19]["visible"] = true;
			$jsonForm["elements"][6]["items"][27]["visible"] = true;
			$jsonForm["elements"][6]["items"][28]["visible"] = true;
			$jsonForm["elements"][6]["items"][29]["visible"] = true;
			$jsonForm["elements"][6]["items"][30]["visible"] = true;
			$jsonForm["elements"][6]["items"][31]["visible"] = true;
			*/

			return json_encode($jsonForm);
		}

		public function UpdateData()
		{
			$this->LogMessage($this->Translate('update data'), KL_MESSAGE);

			$DataAll = $this->GetAllData();
			$DataCND = $this->GetOneData("CND"); // water water conductivity level must be get separately
			$DataSLP = $this->GetOneData("SLP"); //Self lerning program
			if (!is_array($DataAll) || !is_array($DataCND) || !is_array($DataSLP)) {
				$this->LogMessage($this->Translate('problems to get data, data is not an array, try again later'), KL_ERROR);
				exit; 
			}
			$Data = array_merge($DataAll, $DataCND);
			$Data = array_merge($Data, $DataSLP);	

			$ActiveProfile = $Data['getPRF']; // get active Profile from DataArray			
			
			// check if User want to create Variable and if match with received Data, then set the value.

			foreach ($Data as $key =>$value) 
			{
				// check with profile is activated and fill the variables
				switch ($key) {
					case 'getPN'.$ActiveProfile.'':
					case 'getPV'.$ActiveProfile.'': 
					case 'getPT'.$ActiveProfile.'':
					case 'getPF'.$ActiveProfile.'':
					case 'getPM'.$ActiveProfile.'':
					case 'getPR'.$ActiveProfile.'':
					case 'getPB'.$ActiveProfile.'':
							$key=preg_replace("/[0-9]+/", "", $key); // remove Profileno from received data.
							//echo $key." - ".$value."\n";
						break;
				}

				if (@$this->GetIDForIdent(''.$key.'')) 
				{

					// some received data are not alphanumeric, we change this and remove all non numeric fields
					switch ($key) {
						case 'getVOL':
						case 'getAVO': 
						case 'getBAR':
								$value=preg_replace("/[^0-9]+/", "", $value);
							break;
					}
					// if the user won't enable admin mode, ignore No-Admin Errormessages
					switch ($key) {
						case 'getNPS':
						case 'getALM':
						case 'getVOL':
						case 'get71':
						case 'getNET':
						case 'getDBD':
						case 'getDBT':
						case 'getDST':
						case 'getDCM':
						case 'getDOM':
						case 'getDPL':
						case 'getDTC':
						case 'getCND':
							if ($value == "ERROR: ADM"){
								$value = 0;
								exit;
							}
							break;
					}

					if ($key == "getCEL"){
						$value = $value/10;
						if ($this->ReadPropertyBoolean('getCELbool'))
						{
							setValue($this->GetIDForIdent('getCEL'), $value);
						}
					}
 

					// if you want to see dH (deutsche Härtegrad) you need to recalculate mikrosiemens Value from getCND and divide it with 30.
					// see here: https://info.hannainst.de/parameter/leitfaehigkeit-erklaert
					if ($key == "getCND"){
						$valueCND=$value/"30"; 
						if ($this->ReadPropertyBoolean('getCND2bool'))
							{
								setValue($this->GetIDForIdent('getCND2'), $valueCND);
							}
						}

						setValue($this->GetIDForIdent(''.$key.''), $value);
						//echo $key."=".$value."\n";
				}
			}		
		}	


		public function GetOneData(string $key)
		{
			
			$ipaddress	 		= $this->ReadPropertyString('IPAddress');
			$uri       			= 'http://'.$ipaddress.':5333/Pontos-Base/get/'.$key.'';
			
			// entering Admin mode
			$this->EnableAdminMode(true);

			$this->LogMessage($this->Translate('get data for Key: ').$key, KL_MESSAGE);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $uri);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			$response = curl_exec($ch);
			$curl_error = curl_error($ch);
			curl_close($ch);
			if (empty($response) || $response === false || !empty($curl_error)) {
				$this->SendDebug(__FUNCTION__, 'no response from device' . $curl_error, 0);
				$this->LogMessage($this->Translate('GetOneData(): Error to get data'), KL_ERROR);
				return false;
			}
			$responseData = json_decode($response, TRUE);
			$this->SendDebug(__FUNCTION__, $response, 0);
			//leave admin mode
			$this->EnableAdminMode(false);

			return $responseData;	
		}


		public function GetAllData()
		{
			$ipaddress	 		= $this->ReadPropertyString('IPAddress');
			$uri       			= 'http://'.$ipaddress.':5333/Pontos-Base/get/all';
			
			$this->EnableAdminMode(true);

			$this->LogMessage($this->Translate('get all data'), KL_MESSAGE);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $uri);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			$response = curl_exec($ch);
			$curl_error = curl_error($ch);

			curl_close($ch);
			if (empty($response) || $response === false || !empty($curl_error)) {
				$this->SendDebug(__FUNCTION__, 'no response from device: ' . $curl_error, 0);
				$this->LogMessage($this->Translate('GetAllData(): Error to get data'), KL_ERROR);
				return false;
			}

			$responseData = json_decode($response, TRUE);
			$this->SendDebug(__FUNCTION__, $response, 0);
			$this->EnableAdminMode(false);

			return $responseData;	
		}

		// check if admin mode on the device is enable, if not, give user the option to change this
		public function CheckAdminMode()
		{
			$this->LogMessage($this->Translate('check admin state'), KL_MESSAGE);

			$AdminModeStatus = $this->GetOneData("NPS");
			if (!is_array($AdminModeStatus)) {
				$this->LogMessage($this->Translate('problems to get admin status, data is not an array, try again later'), KL_ERROR);
				exit; 
			}
			//$AdminModeStatus = array('getNPS' => "ERROR: ADM");
			if ( $AdminModeStatus['getNPS'] == "ERROR: ADM")
				{
					$this->LogMessage($this->Translate('AdminMode not active'), KL_MESSAGE);
					$this->WriteAttributeBoolean('AdminMode', false);
				}
			else 
				{
					$this->LogMessage($this->Translate('AdminMode active'), KL_MESSAGE);
					$this->WriteAttributeBoolean('AdminMode', true);
				}
		}
		

		public function CheckConnection()
		{
			$this->LogMessage($this->Translate('check Wifi Connection'), KL_MESSAGE);

			$ipaddress	 		= $this->ReadPropertyString('IPAddress');
			$uri       			= 'http://'.$ipaddress.':5333/Pontos-Base/get/WFS';
			
			$this->LogMessage($this->Translate('Check Wifi Connection: '), KL_MESSAGE);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $uri);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3); 
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			$response = curl_exec($ch);
			$curl_error = curl_error($ch);
			curl_close($ch);

			if (empty($response) || $response === false || !empty($curl_error)) {
				$this->SendDebug(__FUNCTION__, 'no response from device, wrong IP Address or device out of range!' . $curl_error, 0);
				$this->LogMessage($this->Translate('CheckConnection(): no response from device, wrong IP Address or device out of range!'), KL_ERROR);
				echo "no response from device, wrong IP Address or device out of range!";
				return false;
			}
			else
			{
				$this->SendDebug(__FUNCTION__, 'Device is reachable' . $curl_error, 0);
				$this->LogMessage($this->Translate('CheckConnection(): Device is reachable'), KL_MESSAGE);
				echo "Device is reachable!";
				return true;
			}
			$responseData = json_decode($response, TRUE);
			$this->SendDebug(__FUNCTION__, $response, 0);
			return $responseData;	

		}

		private function WriteSetting(string $setting, int $value)
		{
			//$adminmodeenable	= $this->ReadAttributeBoolean('AdminMode');
			$ipaddress	 		= $this->ReadPropertyString('IPAddress');
			$uri       			= 'http://'.$ipaddress.':5333/Pontos-Base';

			switch($setting)
			{
				case 'profile':
						$uri = $uri."/set/prf/".$value;
						Sys_getURLContent($uri);
						$this->LogMessage($this->Translate('set profile ').$value, KL_MESSAGE);
				break;
				case 'lock':
						$uri = $uri."/set/ab/".$value;
						Sys_getURLContent($uri);
						$this->LogMessage($this->Translate('set valve state ').$value, KL_MESSAGE);
				break;
				case 'ClearAlarm':
					$uri = $uri."/clr/ala";	
					Sys_getURLContent($uri);
					$this->LogMessage($this->Translate('Alarm cleared'), KL_MESSAGE);
				break;
			
			}
		}

		public function RequestAction($Ident, $Value)
		{
			$this->LogMessage("RequestAction : $Ident, $Value",KL_NOTIFY);

			switch ($Ident) {
				case 'getPROFILESW':
					$this->SetValue("getPROFILESW", $Value);
					$this->WriteSetting("profile", $Value);
				break;
				case 'getLOCK':
					$this->SetValue("getLOCK", $Value);
					if ($Value == 10){$Value = 2;} // set/ab/2 close valve
					if ($Value == 20){$Value = 1;} // set/ab/1 open valve
					$this->WriteSetting("lock", $Value);
				break;
				case 'getALASW':
					$this->WriteSetting("ClearAlarm", 0);
					$this->SetValue("getALASW", true);
					ips_sleep(1500);
					$this->SetValue("getALASW", false);
				break;
				case 'ClearAlarmFromForm':
					$this->WriteSetting("ClearAlarm", 0);
				break;	
			}
		}

		public function ChangeFormField(string $Field, string $Parameter, string $Value) 
		{
            $this->UpdateFormField($Field, $Parameter, $Value);
        }

		private function EnableAdminMode(bool $YesNo)
		{
			$ipaddress	 		= $this->ReadPropertyString('IPAddress');
			$uri       			= 'http://'.$ipaddress.':5333/Pontos-Base';
			switch($YesNo)
			{
				case true:
					$uri = $uri."/set/ADM/(2)f";
					Sys_getURLContent($uri);
					$this->LogMessage($this->Translate('entering AdminMode'), KL_MESSAGE);
				break;
				case false:
					$uri = $uri."/clr/ADM";
					Sys_getURLContent($uri);
					$this->LogMessage($this->Translate('leave AdminMode'), KL_MESSAGE);
				break;			
			}
		}
}