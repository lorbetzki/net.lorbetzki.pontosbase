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
			$this->RegisterPropertyInteger('getPB', 0);
			$this->RegisterPropertyBoolean('getPBbool', false);

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
			$this->RegisterPropertystring('getAVO', '');
			$this->RegisterPropertyBoolean('getAVObool', false);
			$this->RegisterPropertystring('getVOL', '');
			$this->RegisterPropertyBoolean('getVOLbool', false);
			$this->RegisterPropertyFloat('getBAT', 0);
			$this->RegisterPropertyBoolean('getBATbool', false);
			$this->RegisterPropertyFloat('getNET', 0);
			$this->RegisterPropertyBoolean('getNETbool', false);
			$this->RegisterPropertyInteger('getDBD', 0);
			$this->RegisterPropertyBoolean('getDBDbool', false);
			$this->RegisterPropertyInteger('getWFS', 0);
			$this->RegisterPropertyBoolean('getWFSbool', false);
			$this->RegisterPropertyInteger('getWFR', 0);
			$this->RegisterPropertyBoolean('getWFRbool', false);
			$this->RegisterPropertyInteger('getCND', 0);
			$this->RegisterPropertyBoolean('getCNDbool', false);
			$this->RegisterPropertyInteger('getCND2', 0);
			$this->RegisterPropertyBoolean('getCND2bool', false);
			
			$this->RegisterPropertyInteger('getLOCK', 0);
			$this->RegisterPropertyBoolean('getLOCKbool', false);
			$this->RegisterPropertyInteger('getPROFILESW', 0);
			$this->RegisterPropertyBoolean('getPROFILESWbool', false);
			$this->RegisterPropertyBoolean('getALASW', false);
			$this->RegisterPropertyBoolean('getALASWbool', false);
			
			$this->RegisterPropertyInteger('getSLPSW', 0);
			$this->RegisterPropertyBoolean('getSLPSWbool', false);
			$this->RegisterPropertyInteger('getIDSSW', 0);
			$this->RegisterPropertyBoolean('getIDSSWbool', false);
			$this->RegisterPropertyInteger('getTMPSW', 0);
			$this->RegisterPropertyBoolean('getTMPSWbool', false);

			$this->RegisterTimer('PB_UpdateData', 0, 'PB_UpdateData($_IPS[\'TARGET\']);');
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

			$this->SetTimerInterval('PB_UpdateData', $this->ReadPropertyInteger('UpdateDataInterval') * 1000);

			if ($this->ReadPropertyInteger('UpdateDataInterval') == 0){
				$this->SetStatus(104);
			} else {
				$this->SetStatus(102);
			}
			
						// create Profile
						if (!@IPS_VariableProfileExists("PontosBase.Profile"))
						{
							IPS_CreateVariableProfile("PontosBase.Profile", 1);
							IPS_SetVariableProfileDigits("PontosBase.Profile", 1);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 1, $this->Translate('present'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 2, $this->Translate('absent'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 3, $this->Translate('holiday'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 4, $this->Translate('increased consumption'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 5, $this->Translate('max consumption'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 6, $this->Translate('not definied'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 7, $this->Translate('not definied'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Profile", 8, $this->Translate('not definied'), "", 0xFFFFFF);
							IPS_SetVariableProfileValues("PontosBase.Profile", 1, 8, 1);
						}
						if (!@IPS_VariableProfileExists("PontosBase.Valve"))
						{
							IPS_CreateVariableProfile("PontosBase.Valve", 1);
							IPS_SetVariableProfileDigits("PontosBase.Valve", 1);
							IPS_SetVariableProfileAssociation("PontosBase.Valve", 10, $this->Translate('close'), "", 0xFF0000);
							IPS_SetVariableProfileAssociation("PontosBase.Valve", 11, $this->Translate('will be closed'), "", 0xFF0000);
							IPS_SetVariableProfileAssociation("PontosBase.Valve", 20, $this->Translate('open'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.Valve", 21, $this->Translate('will be opened'), "", 0x00FF00);
							IPS_SetVariableProfileValues("PontosBase.Valve", 10, 20, 10);
						}
						if (!@IPS_VariableProfileExists("PontosBase.Mbar"))
						{
							IPS_CreateVariableProfile("PontosBase.Mbar", 1);
							IPS_SetVariableProfileText ("PontosBase.Mbar", ""," mbar");
						}
						if (!@IPS_VariableProfileExists("PontosBase.Liter"))
						{
							IPS_CreateVariableProfile("PontosBase.Liter", 1);
							IPS_SetVariableProfileText ("PontosBase.Liter", ""," L");
						}
						if (!@IPS_VariableProfileExists("PontosBase.Mliter"))
						{
							IPS_CreateVariableProfile("PontosBase.Mliter", 1);
							IPS_SetVariableProfileText ("PontosBase.Mliter", ""," mL");
						}
						if (!@IPS_VariableProfileExists("PontosBase.Conductivity"))
						{
							IPS_CreateVariableProfile("PontosBase.Conductivity", 1);
							IPS_SetVariableProfileText ("PontosBase.Conductivity", ""," µS/cm");
						}
						if (!@IPS_VariableProfileExists("PontosBase.Hardness"))
						{
							IPS_CreateVariableProfile("PontosBase.Hardness", 1);
							IPS_SetVariableProfileDigits("PontosBase.Hardness", 1);
							IPS_SetVariableProfileAssociation("PontosBase.Hardness", 4, $this->Translate('very soft'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.Hardness", 9, $this->Translate('soft'), "", 0x00DC00);
							IPS_SetVariableProfileAssociation("PontosBase.Hardness", 15, $this->Translate('slightly hard'), "", 0x00C800);
							IPS_SetVariableProfileAssociation("PontosBase.Hardness", 19, $this->Translate('moderately hard'), "", 0xFF0101);
							IPS_SetVariableProfileAssociation("PontosBase.Hardness", 24, $this->Translate('hard'), "", 0xE60000);
							IPS_SetVariableProfileAssociation("PontosBase.Hardness", 25, $this->Translate('very hard'), "", 0xC80000);
			
							IPS_SetVariableProfileValues("PontosBase.Hardness", 0, 0, 1);
						}
						if (!@IPS_VariableProfileExists("PontosBase.Alarm"))
						{
							IPS_CreateVariableProfile("PontosBase.Alarm", 3);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "FF", $this->Translate('NO ALARM'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A1", $this->Translate('ALARM END SWITCH'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A2", $this->Translate('ALARM TURBINE BLOCKED'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A3", $this->Translate('ALARM VOLUME LEAKAGE'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A4", $this->Translate('ALARM TIME LEAKAGE'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A5", $this->Translate('ALARM MAX FLOW LEAKAGE'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A6", $this->Translate('ALARM MICRO LEAKAGE'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A7", $this->Translate('ALARM EXT. SENSOR LEAKAGE RADIO'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A8", $this->Translate('ALARM EXT. SENSOR LEAKAGE CABLE'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "A9", $this->Translate('ALARM PRESSURE SENSOR ERROR'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "AA", $this->Translate('ALARM TEMPERATURE SENSOR ERROR'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "AB", $this->Translate('ALARM LOW BATTERY'), "", 0xFFFFFF);
							IPS_SetVariableProfileAssociation("PontosBase.Alarm", "AE", $this->Translate('Error: no more information available'), "", 0xFFFFFF);
						}
						if (!@IPS_VariableProfileExists("PontosBase.clrAla"))
						{
							IPS_CreateVariableProfile("PontosBase.clrAla", 1);
							IPS_SetVariableProfileDigits("PontosBase.clrAla", 1);
							IPS_SetVariableProfileAssociation("PontosBase.clrAla", 0, $this->Translate('clear Alarm'), "", 0x00FF00);
						}
			
						if (!@IPS_VariableProfileExists("PontosBase.WifiStatus"))
						{
							IPS_CreateVariableProfile("PontosBase.WifiStatus", 1);
							IPS_SetVariableProfileAssociation("PontosBase.WifiStatus", 0, $this->Translate('Disconnect'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.WifiStatus", 1, $this->Translate('Connecting'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.WifiStatus", 2, $this->Translate('Connected'), "", 0x00FF00);
							IPS_SetVariableProfileText ("PontosBase.WifiStatus", "","");
						}
			
						if (!@IPS_VariableProfileExists("PontosBase.DSM"))
						{
							IPS_CreateVariableProfile("PontosBase.DSM", 1);
							IPS_SetVariableProfileAssociation("PontosBase.DSM", 0, $this->Translate('disabled'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.DSM", 1, $this->Translate('enabled'), "", 0x00FF00);
							IPS_SetVariableProfileText ("PontosBase.DSM", "","");
						}
						
						if (!@IPS_VariableProfileExists("PontosBase.SLP"))
						{
							IPS_CreateVariableProfile("PontosBase.SLP", 1);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 0, $this->Translate('disabled'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 1, $this->Translate('2 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 2, $this->Translate('3 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 3, $this->Translate('4 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 4, $this->Translate('5 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 5, $this->Translate('6 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 6, $this->Translate('7 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 7, $this->Translate('8 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 8, $this->Translate('9 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 9, $this->Translate('10 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 10, $this->Translate('11 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 11, $this->Translate('12 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 12, $this->Translate('13 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 13, $this->Translate('14 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 14, $this->Translate('15 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 15, $this->Translate('16 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 16, $this->Translate('17 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 17, $this->Translate('18 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 18, $this->Translate('19 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 19, $this->Translate('20 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 20, $this->Translate('21 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 21, $this->Translate('22 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 22, $this->Translate('23 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 23, $this->Translate('24 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 24, $this->Translate('25 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 25, $this->Translate('26 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 26, $this->Translate('27 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileAssociation("PontosBase.SLP", 27, $this->Translate('28 Tage'), "", 0x00FF00);
							IPS_SetVariableProfileText ("PontosBase.SLP", "","");
							IPS_SetVariableProfileValues("PontosBase.SLP", 0, 27, 1);
						}
						
			############################### 
			// Sort 100-110 for profiles
			$this->MaintainVariable('getPN', $this->Translate('name of active profile'),3, "",100, $this->ReadPropertyBoolean('getPNbool') == true);
			$this->MaintainVariable('getPV', $this->Translate('water volume of active profile'),1, "",101, $this->ReadPropertyBoolean('getPVbool') == true);
			$this->MaintainVariable('getPT', $this->Translate('flow duration time of active profile'),1, "",102, $this->ReadPropertyBoolean('getPTbool') == true);
			$this->MaintainVariable('getPF', $this->Translate('water flow l/h for active profile'),1, "",103, $this->ReadPropertyBoolean('getPFbool') == true);
			$this->MaintainVariable('getPM', $this->Translate('micro leak detection for active profile'),0, "~Switch",104, $this->ReadPropertyBoolean('getPMbool') == true);
			$this->MaintainVariable('getPB', $this->Translate('Active state of buzzer for active profile'),1, "",105, $this->ReadPropertyBoolean('getPBbool') == true);
			$this->MaintainVariable('getPROFILESW', $this->Translate('switch active profile'),1, "PontosBase.Profile",110, $this->ReadPropertyBoolean('getPROFILESWbool') == true);

			// sort of switchable action 120-130
			$this->MaintainVariable('getALASW', $this->Translate('clear Alarm'),1, "PontosBase.clrAla",120, $this->ReadPropertyBoolean('getALASWbool') == true);
			$this->MaintainVariable('getSLPSW', $this->Translate('set days for self learning procedure'),1, "PontosBase.SLP",121, $this->ReadPropertyBoolean('getSLPSWbool') == true);
			$this->MaintainVariable('getIDSSW', $this->Translate('set daylight saving mode'),1, "PontosBase.DSM",122, $this->ReadPropertyBoolean('getIDSSWbool') == true);
			$this->MaintainVariable('getTMPSW', $this->Translate('set temporary deactivation for leakage detection time in sec.'),1, "",123, $this->ReadPropertyBoolean('getTMPSWbool') == true);
			$this->MaintainVariable('getLOCK', $this->Translate('lock or unlock valve'),1, "PontosBase.Valve",124, $this->ReadPropertyBoolean('getLOCKbool') == true);

			//sort  for information 131-150
			$this->MaintainVariable('getALA', $this->Translate('current alarm'),3, "PontosBase.Alarm",131, $this->ReadPropertyBoolean('getALAbool') == true);
			$this->MaintainVariable('getVOL', $this->Translate('total volume in liters'),1, "PontosBase.Liter",132, $this->ReadPropertyBoolean('getVOLbool') == true);
			$this->MaintainVariable('getCND', $this->Translate('water conductivity'),1, "PontosBase.Conductivity",133, $this->ReadPropertyBoolean('getCNDbool') == true);
			$this->MaintainVariable('getCND2', $this->Translate('water hardness level'),1, "PontosBase.Hardness",134, $this->ReadPropertyBoolean('getCND2bool') == true);
			$this->MaintainVariable('getBAR', $this->Translate('water pressure'),1, "PontosBase.Mbar",135, $this->ReadPropertyBoolean('getBARbool') == true);
			$this->MaintainVariable('getCEL', $this->Translate('water temperature'),2, "~Temperature",136, $this->ReadPropertyBoolean('getCELbool') == true);
			$this->MaintainVariable('getNPS', $this->Translate('no pulse time of turbine in seconds'),1, "",137, $this->ReadPropertyBoolean('getNPSbool') == true);
			$this->MaintainVariable('getAVO', $this->Translate('volume of the current water consumption process in ml'),1, "PontosBase.Mliter",138, $this->ReadPropertyBoolean('getAVObool') == true);
			$this->MaintainVariable('getDBD', $this->Translate('configured Micro Leakage test pressure drop in bar'),1, "",139, $this->ReadPropertyBoolean('getDBDbool') == true);
			$this->MaintainVariable('getWFS', $this->Translate('Wifi connection state'),1, "PontosBase.WifiStatus",140, $this->ReadPropertyBoolean('getWFSbool') == true);
			$this->MaintainVariable('getWFR', $this->Translate('Wifi connection strength (RSSI)'),1, "~Intensity.100",141, $this->ReadPropertyBoolean('getWFRbool') == true);

			$this->MaintainVariable('getBAT', $this->Translate('battery voltage'),2, "~Volt",142, $this->ReadPropertyBoolean('getBATbool') == true);
			$this->MaintainVariable('getNET', $this->Translate('voltage of power adaptor'),2, "~Volt",143, $this->ReadPropertyBoolean('getNETbool') == true);
			$this->MaintainVariable('getVLV', $this->Translate('Valvestate'),1, "PontosBase.Valve",144, $this->ReadPropertyBoolean('getVLVbool') == true);


			// sort of static information 200
			$this->MaintainVariable('getSRN', $this->Translate('Serial-no.'),1, "",200, $this->ReadPropertyBoolean('getSRNbool') == true);
			$this->MaintainVariable('getVER', $this->Translate('Firmware Version'),3, "",201, $this->ReadPropertyBoolean('getVERbool') == true);
			$this->MaintainVariable('getTYP', $this->Translate('Type'),1, "",202, $this->ReadPropertyBoolean('getTYPbool') == true);
			$this->MaintainVariable('getCNO', $this->Translate('Code-no.'),3, "",203, $this->ReadPropertyBoolean('getCNObool') == true);
			$this->MaintainVariable('getMAC', $this->Translate('MAC Address'),3, "",204, $this->ReadPropertyBoolean('getMACbool') == true);
			


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
			//
			if  ($this->ReadPropertyBoolean('getSLPSWbool') )
			{
				$this->EnableAction('getSLPSW');
			}
			if  ($this->ReadPropertyBoolean('getIDSSWbool') )
			{
				$this->EnableAction('getIDSSW');
			}
			if  ($this->ReadPropertyBoolean('getTMPSWbool') )
			{
				$this->EnableAction('getTMPSW');
			}			
			########################
			if ($this->ReadPropertyInteger('UpdateDataInterval') >0){
				$this->UpdateData();
			}
		}

		public function GetConfigurationForm()
		{
			$jsonForm = json_decode(file_get_contents(__DIR__ . "/form.json"), true);
			
			if ($this->Getstatus() == 104 ){
				$jsonForm["elements"][3]["visible"] = true;
			}

			if (!$this->ReadPropertyString('IPAddress') )
			{
				$this->SetStatus(200);
			}
			
			return json_encode($jsonForm);
		}

		public function UpdateData()
		{
			if ($this->CheckConnection() == true) 
			{

				$this->LogMessage($this->Translate('update data'), KL_MESSAGE);

				$DataAll = $this->GetAllData();
				$DataCND = $this->GetOneData("CND"); // water  conductivity level must be get separately
				$DataSLP = $this->GetOneData("SLP"); // Self learning program

				if (!is_array($DataAll) || !is_array($DataCND) || !is_array($DataSLP)) {
					$this->LogMessage($this->Translate('problems to get data, data is not an array, try again later'), KL_ERROR);
					exit; 
				}

				$Data = array_merge($DataAll, $DataCND);
				$Data = array_merge($Data, $DataSLP);	

				$ActiveProfile = $Data['getPRF']; // get active Profile from DataArray			
				
				if ($this->ReadPropertyBoolean('getPROFILESWbool') )
				{
					$this->SetValue("getPROFILESW", $ActiveProfile);
				}

				if ($this->ReadPropertyBoolean('getSLPSWbool') )
				{
					$this->SetValue("getSLPSW", $Data['getSLP']);
				}
				
				if ($this->ReadPropertyBoolean('getIDSSWbool') )
				{
					$this->SetValue("getIDSSW", $Data['getIDS']);
				}
				if ($this->ReadPropertyBoolean('getTMPSWbool') )
				{
					$this->SetValue("getTMPSW", $Data['getTMP']);
				}
				if ($this->ReadPropertyBoolean('getLOCKbool') )
				{
					$this->SetValue("getLOCK", $Data['getVLV']);
				}
				
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

						// temperature looks wrong, divide it and it looks better
						if ($key == "getCEL"){
							$value = $value/10;
							if ($this->ReadPropertyBoolean('getCELbool'))
							{
								setValue($this->GetIDForIdent('getCEL'), $value);
							}
						}

						// if you want to see dH (deutsche Härtegrad) you need to recalculate mikrosiemens Value from getCND and divide it with 30.
						// see here: https://info.hannainst.de/parameter/leitfaehigkeit-erklaert
						if ($this->ReadPropertyBoolean('getCND2bool'))
						{	
							$valueCND=$Data['getCND']/"30"; 
							setValue($this->GetIDForIdent('getCND2'), $valueCND);
						}

							setValue($this->GetIDForIdent(''.$key.''), $value);
							//echo $key."=".$value."\n";
					}
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
				$this->SendDebug(__FUNCTION__, 'CheckConnection(): no response from device, wrong IP Address or device out of range!' . $curl_error, 0);
				$this->LogMessage($this->Translate('CheckConnection(): no response from device, wrong IP Address or device out of range!'), KL_ERROR);
				//echo "no response from device, wrong IP Address or device out of range!";
				$this->SetStatus(201);
				return false;
			}
			else
			{
				$this->SendDebug(__FUNCTION__, 'Device is reachable' . $curl_error, 0);
				$this->LogMessage($this->Translate('CheckConnection(): Device is reachable'), KL_MESSAGE);
				//echo "Device is reachable!";
				
				if ($this->GetStatus() == 201) 
				{
					$this->SetStatus(102);
				}
				return true;
			}
			$responseData = json_decode($response, TRUE);
			$this->SendDebug(__FUNCTION__, $response, 0);
			return $responseData;

		}

		private function WriteSetting(string $setting, int $value)
		{
			$ipaddress	 		= $this->ReadPropertyString('IPAddress');
			$uri       			= 'http://'.$ipaddress.':5333/Pontos-Base';
			
			$this->EnableAdminMode(true);

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
				case 'SLP':
					$uri = $uri."/set/slp/".$value;	
					Sys_getURLContent($uri);
					$this->LogMessage($this->Translate('set self learning procedure ').$value, KL_MESSAGE);
				break;
				case 'IDS':
					$uri = $uri."/set/ids/".$value;	
					Sys_getURLContent($uri);
					$this->LogMessage($this->Translate('set daylight saving mode ').$value, KL_MESSAGE);
				break;
				case 'TMP':
					$uri = $uri."/set/tmp/".$value;	
					Sys_getURLContent($uri);
					$this->LogMessage($this->Translate('set deactivation time for temporary leakage detection ').$value, KL_MESSAGE);
				break;
			}
			$this->EnableAdminMode(false);

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
				case 'getSLPSW':
					$this->SetValue("getSLPSW", $Value);
					$this->WriteSetting("SLP", $Value);
				break;
				case 'getIDSSW':
					$this->SetValue("getIDSSW", $Value);
					$this->WriteSetting("IDS", $Value);
				break;
				case 'getTMPSW':
					$this->SetValue("getTMPSW", $Value);
					$this->WriteSetting("TMP", $Value);
				break;
				case 'ClearAlarmFromForm':
					$this->WriteSetting("ClearAlarm", 0);
				break;
			}
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