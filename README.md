# Pontos Base V2
die Pontos Base ist ein Wassermanagmentsystems der Firmware Hansgrohe und wird, am besten unmittelbar hinter dem ersten Absperrhahn der Hauptwasserleitung installiert. Es überwacht zum einen - nach einer Selbstlernphase- den üblichen Verbrauch und sperrt bei überproportionalen Vebrauch die Hauptleitung. Zudem besitzt es eine Mikroleckageerkennung. Danker verschiedener umschaltbaren Profile kann man für Urlaub oder kurzfristig überhöhten Verbrauch (Poolbefüllung bspw) umschalten.

Seit Version 2.1 des Moduls wird auch wieder die Syr Safe-Tech experimentell unterstützt.

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [WebFront](#6-webfront)
7. [PHP-Befehlsreferenz](#7-php-befehlsreferenz)
8. [manuelles flashen der Firmware](#8-manuelles-flashen-der-firmware)

### 1. Funktionsumfang

* Auslesen diverser Variablen wie Wasservolumen, Ventilstatus, Wasserdruck u.v.a.m 
* Sperren und freigeben des Ventils
* Umschalten von Profilen 
* (de)aktivieren der Selbstlernphase
* (de)aktiveren des Schlafmodus vom Display

### 2. Voraussetzungen

- IP-Symcon ab Version 6.3

### 3. Software-Installation

* Über den Module Store das 'Pontos Base V2'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen https://github.com/lorbetzki/net.lorbetzki.pontosbase.git

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'Pontos Base V2'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name          				     | Beschreibung
-------------------------------- | -------------------------------------------------------
IP Adresse                       | IP Adresse oder Hostname des Gerätes
Modellauswahl				     | Auswahl um welches Modell es sich handelt.
Intervall in sek                 | Abrufintervall. 0 deaktiviert das automatische abrufen
Auswahl Standardvariablen        | Auswahl diverser Variablen
Auswahl zusätzlicher Variablen   | Auswahl diverser Variablen

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name                          							| Typ     | Beschreibung
----------------------------- 							| ------- | ------------
Name des aktiven Profils      							| string  | Name des aktiven Profils
Wasservolumen des aktiven Profils       	    	    | Integer | Eingestelltes Wasservolumen des aktiven Profil
Dauer Wasserentnahme des aktiven Profils   		 	    | Integer | Eingestellte Dauer Wasserentnahme des aktiven Profil
Wasserdurchfluss l/h des aktiven Profils        		| Integer | Eingestellter Wasserdurchfluss des aktiven Profil
Mikroleckageschutz des aktiven Profils           		| Boolean | Status Mikroleckageschutz des aktiven Profil
Status des Alarmpiepser des aktiven Profils 	  		| Integer | Status des Alarmpiepser des aktiven Profils
Ventilstatus                  							| Integer | Ventilstatus, Ventil offen oder geschlossen
Gesamtverbrauch Liter         							| Integer | Gesamtverbrauch. Wird zurückgesetzt bei leerer Batterie/Spannungsvermögen 
Batteriespannung          	    						| Float   | Spannung der Batterie im System
Netzspannung 											| Float   | Netzspannung, vom Netzteil kommend
Wasserleitfähigkeit           							| Integer | Leitfähigkeit des Wassers in Mikrosiemens
Wasserhärtegrad               							| Integer | Wasserhärtegrad in dH
Wasserdruck                   							| Integer | Druck in mBar
aktueller Alarm               							| String  | Aktueller Alarm.
Wifi Verbindungsstatus									| Integer | Wifi Verbindungsstatus, nicht verbunden, verbunden oder wird verbunden
Wifi Signalstärke RSSI									| Integer | Wifi Signalstärke
Wassertemperatur              							| Float   | Temperatur des Wassers* Achtung, der ausgelesene Wert scheint mir Merkwürdig! 
zeit in sek. seit Turbine keinen Impuls bekommt			| Integer | gibt an, wie lange kein Wasser mehr entnommen wurde in sek. 
Volumen des aktuellen Wasserverbrauchs in ml			| Integer | Volumen des aktuellen Wasserverbrauchs in ml
konfigurierter Micro Leakage-Test, Druckabfall in bar   | Integer | Druckabfallprüfung in bar. Wird für Mikroleckagetest verwendet, des aktiven Profils
Ventil sperren oder freigeben 							| Integer | Schaltbares Aktion, Ventil öffnen oder schließen
schalte aktives Profil        							| Integer | Schaltbares Aktion, Aktives Profil umschalten
lösche Alarm											| Integer | Schaltbares Aktion, löscht den aktuellen Alarm
aktiviere dauer in tage für Selbstlernprogramm			| Integer | Schaltbares Aktion, aktiviert das Selbstlernprogramm in tage. 0 deaktivert das Programm
aktiviere Stromsparmodus des Display					| Integer | Schaltbares Aktion, aktiviert den Stromsparmodus des Displays
temporäre Deaktivierung der Leckageerkennung in sek.	| Integer | Schaltbares Aktion, temporäre Deaktivierung der Leckageerkennung in sek.
Serien-Nr.                    							| Integer | Seriennr des Gerätes
Firmware Version             							| String  | Firmwareversion des Gerätes
Typ                           							| Integer | Typ
Codenummer                    							| String  | Codenummer
MAC Adresse                   							| String  | MAC Adresse des Gerätes



#### Profile

Name                    | Typ
------------------------| -------
PontosBase.Hardness		| Integer
PontosBase.DSM			| Integer
PontosBase.clrAla		| Integer
PontosBase.Alarm		| String
PontosBase.Profile		| Integer
PontosBase.Valve		| Integer
PontosBase.SLP			| Integer
PontosBase.Mbar			| Integer
PontosBase.Conductivity	| Integer
PontosBase.Mliter		| Integer
PontosBase.Liter		| Integer
PontosBase.WifiStatus	| Integer

### 6. WebFront

Name                          							| Typ     | Beschreibung
--------------------------------------------------------| ------- | ------------
Ventil sperren oder freigeben 							| Integer | Schaltbares Aktion, Ventil öffnen oder schließen
schalte aktives Profil        							| Integer | Schaltbares Aktion, Aktives Profil umschalten
lösche Alarm											| Integer | Schaltbares Aktion, löscht den aktuellen Alarm
aktiviere dauer in tage für Selbstlernprogramm			| Integer | Schaltbares Aktion, aktiviert das Selbstlernprogramm in tage. 0 deaktivert das Programm
aktiviere Stromsparmodus des Display					| Integer | Schaltbares Aktion, aktiviert den Stromsparmodus des Displays
temporäre Deaktivierung der Leckageerkennung in sek.	| Integer | Schaltbares Aktion, temporäre Deaktivierung der Leckageerkennung in sek.


### 7. PHP-Befehlsreferenz

`PB_UpdateData(integer $InstanzID);`

Aktualisierung aller Daten.

`PB_GetData(integer $InstanzID, string $Key="all");`

wird `PB_GetData(12345);` ohne Paramter aufgerufen werden viele Daten abgeholt, jedoch nicht alle. Möchte man bestimmte Daten. Bspw. 
`PB_GetData(12345, "CND");` wird die Wasserleitfähigkeit abgeholt.

### 8. manuelles flashen der Firmware

Derzeit scheint es mit der ausgerollten Version 1.30 (Stand 06/2023) Probleme mit dem WLAN zu kommen. Um manuell auf eine Firmware downzugraden müsste ihr euch [hier](https://husty.pl/firmware/pontosbase/) eine Firmware runterladen. Derzeit ist die Version 1.29 als Stabil zu betrachten. 

Habt Ihr die passende Firmware runtergeladen müsst Ihr euch mit einem PC/Laptop mit der Pontosbase und einem USB zu MikroUSB Kabel verbinden. Dazu müsst Ihr an der Pontosbase den Deckel abnehmen (dort wo sich auch die 9V Batterie befindet), dort befindet sich oben rechts ein MikroUSB Anschluss.

![grafik](docs/pontos.jpg?raw=true)

Nachdem Ihr beides miteinander verbunden habt, erscheint ein neues Laufwerk, dabei handelt es sich um einen freien Speicherbereich der Pontos. Schiebt nun die runtergeladene Firmware auf das freie Laufwerk und benennt die Datei in "pontosbase.bin". Ist der Kopiervorgang beendet, löst ihr nun das USB Kabel, die 9V Batterie UND das Netzteil. Wartet 10 sek. und steckt das Netzteil und dann die 9V Batterie wieder an. Die Pontosbase fängt an, Rot zu blinken.

Der Flashvorgang ist beendet und die Firmware auf dem gewünschten Stand.

[def]: 8#-manuelles-flashen-der-firmware