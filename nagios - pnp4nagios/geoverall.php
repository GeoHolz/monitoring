<?php
/*****************************************************************************
 *
 * overall-status.php 
 *
 * Copyright (c) 2010 Rene Storm
 *
 * License: Actually this software is under GPL 2, but will follow NagViz
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2 as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *
 *****************************************************************************
 *
 * This is a small Widget/Gadget which will show you the Overall Status of
 * your host and service via Matthias Kettler Livestatus.
 * You will need a livestatus socket in order to use this plugin
 *
 * Please edit $livestatus_socket 
 *****************************************************************************/

/** 
 * Dummy perfdata for WUI
 *
 * This string needs to be set in every gadget to have some sample data in the 
 * WUI to be able to place the gadget easily on the map
 ******************************************************************************/
$sDummyPerfdata = 'config=20%;80;90;0;100';

$livestatus_socket='unix:///var/lib/nagios/rw/livestatus';
$livestatus='/var/lib/nagios/rw/livestatus';


//$fp=fsockopen($livestatus_socket);
//fwrite($fp, "GET services\nColumns: host_name description state plugin_output\nFilter: state > 0\nFilter: acknowledged = 0\nColumnHeaders: on\n");
//$dada=fgets($fp,128);
//echo $dada;
//fclose($fp);

$tempoo = shell_exec('echo "GET services\nColumns: host_name description state plugin_output\nFilter: state > 0\nFilter: acknowledged = 0\nSeparators: 59 59\n" | unixcat '.$livestatus);
echo $tempoo."\n\n";
$status = explode(";", $tempoo);

$nbr=count($status);
$nbr--;
echo "Nombre d'occurence :".$nbr."\n";
$nbr_ligne=$nbr/4;
echo "Nombre d'hote :".$nbr_ligne."\n";
for($i = 0; $i <$nbr;$i++){
echo $i." ";
echo $status[$i];
echo "\n";
}

//echo count($status);

?>
