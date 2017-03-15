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
$t = 7;
#$i = 1;

$addr=$ARGV[0];
        $exp = new Expect();
        $exp->raw_pty(1);
        $exp->spawn("telnet $addr") ;
        $exp->expect($t, '-re','User name:');
        $exp->send("hwadmin\r");
        $exp->expect($t,'-re','word:');
        $exp->send("hwadmin123\r");
        $exp->expect($t,'-re','>');
        $exp->send("enable\r");
        $exp->expect($t,'-re','#');
        $exp->send("display ont autofind all\r");
        $exp->send("   \r");
        $exp->expect($t,'-re','#');
        $exp->send("quit\r");
        $exp->expect($t,'-re',':');
        $exp->send("y\r");
$exp->soft_close();
        
        
        
        
        
    
