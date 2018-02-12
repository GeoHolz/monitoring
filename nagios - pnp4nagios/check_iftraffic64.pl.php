<?php
        #
        # Copyright (c) GeoHolz http://blog.jolos.fr
        # Plugin: check_iftraffic64.pl
        #
        #
        $ds_name[1] = "Traffic en %";
        $opt[1] = "--vertical-label \"Percent of use %\" --title \"Traffic in % for $hostname / $servicedesc\" ";

        $def[1]  = "DEF:var1=$RRDFILE[1]:$DS[1]:AVERAGE " ;
        $def[1] .= "DEF:var2=$RRDFILE[2]:$DS[2]:AVERAGE " ;
        
        $def[1] .= rrd::area("var1", "#00CC00", "in") ;
        $def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
        $def[1] .= "LINE1:var2#3300FF:\"out\" " ;
        $def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

        # Traffic IN
        $ds_name[2] = "Traffic";
        $opt[2]  = "--vertical-label \"KBytes per second\" --title \"Interface Traffic IN for $hostname / $servicedesc\" ";
        
        $def[2]  = "DEF:var1=$RRDFILE[3]:$DS[3]:AVERAGE " ;

        
        $def[2] .= "LINE1:var1#00CC00:\"in\" " ;
        $def[2] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

        
        # Traffic OUT
        $ds_name[3] = "Traffic";
        $opt[3]  = "--vertical-label \"KBytes per second\" --title \"Interface Traffic OUT for $hostname / $servicedesc\" ";
        
        $def[3]  = "DEF:var1=$RRDFILE[4]:$DS[4]:AVERAGE " ;

        $def[3] .= "LINE1:var1#3300FF:\"out\" " ;
        $def[3] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
