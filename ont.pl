#!/usr/bin/perl -w
    

#	use strict;

use Expect; 
use Fcntl;

#$Expect::Log_Stdout=1;
#$Expect::Debug=3;
#$Expect::Exp_Internal=1;

#my $addr = "10.131.26.3";
#my $exp = new Expect();
#$exp->raw_pty(1);
$t = 9;
#$i = 1;

$slot = $ARGV[0];
$port=$ARGV[1];
$fio=$ARGV[2];
$pass=$ARGV[3];
$cvid=$ARGV[4];
$ontid=$ARGV[5];
$svid=$ARGV[6];
$addr=$ARGV[7];
$srvport=$ARGV[8];
$srv_port_iptv=$ARGV[9];
$desc=$ARGV[10];
$iptv_vlan=$ARGV[11];
$mc_vlan=$ARGV[12];

        $exp = new Expect();
        $exp->raw_pty(1);
        $exp->spawn("telnet $addr") ;
        $exp->expect($t, '-re','name:');
        $exp->send("hwadmin\r");
#        $exp->spawn("ssh hwadmin@$addr") ;
#        $exp->expect($t, '-re','name:');
#        $exp->send("hwadmin\r");
        $exp->expect($t,'-re','word:');
        $exp->send("hwadmin123\r");
        $exp->expect($t,'-re','>');
        $exp->send("enable\r");
        $exp->expect($t,'-re','#');
        $exp->send("config\r");
        $exp->expect($t,'-re','#');
        $exp->send("interface gpon 0/".$slot."\r");
        $exp->expect($t,'-re','#');
        $exp->send("ont add ".$port." ".$ontid." password-auth ".$pass." always-on omci ont-lineprofile-id 1 ont-srvprofile-id 1 desc ".$desc."\r");
        $exp->expect($t,'-re','#');
        $exp->send("ont port native-vlan ".$port." ".$ontid." eth 1 vlan 10\r");
        $exp->send("\r");
        $exp->expect($t,'-re','#');
        $exp->send("ont port native-vlan ".$port." ".$ontid." eth 2 vlan 20\r");
        $exp->send("\r");
        $exp->expect($t,'-re','#');
        $exp->send("quit\r");
        # exit interface mode to global config mode
        $exp->expect($t,'-re','#');
        $exp->send("service-port ".$srvport." vlan ".$svid." gpon 0/".$slot."/".$port." ont ".$ontid." gemport 1 multi-service user-vlan 10 tag-transform translate-and-add inner-vlan ".$cvid." inbound traffic-table index 6 outbound traffic-table index 6\r");
        $exp->expect($t,'-re','#');
        if ($srv_port_iptv>1) {
		$exp->send("service-port ".$srv_port_iptv." vlan ".$iptv_vlan. " gpon 0/".$slot."/".$port." ont ".$ontid." gemport 2 multi-service user-vlan 20 tag-transform translate inbound traffic-table index 6 outbound traffic-table index 6\r");           
		$exp->expect($t,'-re','#');
		$exp->send("btv\r");
		$exp->expect($t,'-re','#');
		$exp->send("igmp user add service-port ".$srv_port_iptv." no-auth\r\r");
		$exp->expect($t,'-re','#');
		$exp->send("multicast-vlan ".$mc_vlan."\r");
		$exp->expect($t,'-re','#');
		$exp->send("igmp multicast-vlan member service-port ".$srv_port_iptv."\r\r");
		$exp->expect($t,'-re','#');
	        $exp->send("quit\r");
	        $exp->expect($t,'-re','#');
	        }
        # exit from config & disconnect
        $exp->send("quit\r");
        $exp->expect("$t,'-re','#'");
        $exp->send("quit\r");
        $exp->expect($t,'-re',':');
        $exp->send("y\r");
$exp->soft_close();
        
        
        
        
        
    
