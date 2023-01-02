# PontosBase
Beschreibung des Moduls.

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [WebFront](#6-webfront)
7. [PHP-Befehlsreferenz](#7-php-befehlsreferenz)

### 1. Funktionsumfang

* Auslesen diverser Variablen wie Wasservolumen, Ventilstatus, Wasserdruck u.v.a.m 
* Sperren und freigeben des Ventils
* Umschalten von Profilen 

### 2. Voraussetzungen

- IP-Symcon ab Version 6.0

### 3. Software-Installation

* Über den Module Store das 'PontosBase'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen https://github.com/lorbetzki/net.lorbetzki.watermanagement.git

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'PontosBase'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name          | Beschreibung
------------- | ------------------
 IP Adresse                      |
 Welches Modell besitzen Sie?    |
Intervall in sek                 |   
Auswahl Standardvariablen        |
Auswahl zusätzlicher Variablen   |

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name                          | Typ     | Beschreibung
----------------------------- | ------- | ------------
Name des aktiven Profils      | string  | Name des aktiven Profils
Wasservolumen                 | Integer | Eingestelltes Wasservolumen im verwendeten Profil
Dauer Wasserentnahme          | Integer | Eingestellte Dauer Wasserentnahme im verwendeten Profil
Wasserdurchfluss l/h          | Integer | Eingestellter Wasserdurchfluss im verwendeten Profil
Mikroleckageschutz            | Boolean | Mikrosleckageschutz im verwendeten Profil aus oder eingeschaltet
Ventilstatus                  | Integer | Ventilstatus, Ventil offen oder geschlossen
Gesamtverbrauch Liter         | Integer | Gesamtverbrauch. Wird zurückgesetzt bei leerer Batterie/Spannungsvermögen 
Batteriespannung              | Float   | Spannung der Batterie im System
Wassertemperatur              | Float   | Temperatur des Wassers 
Wasserleitfähigkeit           | Integer | Leitfähigkeit des Wassers in Mikrosiemens
Wasserhärtegrad               | Integer | Wasserhärtegrad in dH
Wasserdruck                   | Integer | Druck in mBar
Ventil sperren oder freigeben | Integer | Schaltbares Profil, Ventil öffnen oder schließen
schalte aktives Profil        | Integer | Schaltbares Profil, Aktives Profil umschalten
Serien-Nr.                    | Integer | Seriennr des Gerätes
Firmware Version              | String  | Firmwareversion des Gerätes
Typ                           | Integer | Typ
Codenummer                    | String  | Codenummer
MAC Adresse                   | String  | MAC Adresse des Gerätes
letztes Aktualisierungsdatum  | Integer | letztes Datum der Aktualiserung in UTC
aktueller Alarm               | String  | Aktueller Alarm. Derzeit keine Auswertung.


#### Profile

Name                          | Typ
----------------------------- | -------
 WaterManagement.Profile      | Integer
 WaterManagement.Valve        | Integer
 WaterManagement.Mbar         | Integer 
 WaterManagement.Liter        | Integer 
 WaterManagement.Mliter       | Integer 
 WaterManagement.Conductivity | Integer
 WaterManagement.Hardness     | Integer

### 6. WebFront

Name                          | Typ     | Beschreibung
----------------------------- | ------- | ------------
Ventil sperren oder freigeben | Integer | Schaltbares Profil, Ventil öffnen oder schließen
schalte aktives Profil        | Integer | Schaltbares Profil, Aktives Profil umschalten

### 7. PHP-Befehlsreferenz

`HGPB_UpdateData(integer $InstanzID);`

Aktualisierung aller Daten.

`HGPB_GetOneData(integer $InstanzID, string $Key);`

Aktualisierung bestimmter Daten. Bspw. 
`HGPB_GetOneData(12345, "CND");` 
holt die Wasserleitfähigkeit ab.

`HGPB_GetAllData(integer $InstanzID);`

holt alle Daten ab und stellt diese als Array zur Verfügung

`HGPB_CheckAdminMode(integer $InstanzID);`

INTERNE FUNKTION: prüft ob der Adminmodus aktiv ist.

`HGPB_WriteSetting(integer $InstanzID, string $Setting, integer $Value);`

INTERNE FUNKTION: ermöglicht es, bestimmte Settings zu schreiben.

`HGPB_FirstRun(integer $InstanzID);`

INTERNE FUNKTION: wird ausgeführt sobald man den Button "Verbinden" im Konfigurationsformular drückt.

`HGPB_FirstRunReset(integer $InstanzID);`

Zu Debuggingszwecke. Setzt bestimmte interne Variablen zurück.

`HGPB_ChangeFormField(integer $InstanzID, string $Field, string $Parameter, string $Value);`

INTERNE FUNKTION: um das Konfigurationsformular dynamisch anzupassen.
