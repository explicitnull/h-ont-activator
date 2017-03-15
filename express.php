<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ($_GET['pse'] == 41) {
    echo "PSE-422"
    ?><pre><?
    print_r(explode("\n", passthru("./express.pl 10.131.41.10")));
    ?></pre><?
}
if ($_GET['pse'] == 420) {
    echo "PSE-25"
    ?><pre><?
    print_r(explode("\n", passthru("./express.pl 10.131.41.6")));
    ?></pre><?
}
if ($_GET['pse'] == 422) {
    echo "PSE-558";
    ?>
    <pre>
        <?
        print_r(explode("\n", passthru("./express.pl 10.131.41.2")));
        ?>
    </pre>
    
    <?
    }
if ($_GET['pse'] == 467) {
    
     ?>
        <pre>
        <?
    	print_r(explode("\n",passthru("./express.pl 10.131.41.14")));
    	?>
    	</pre>
    <?
    
}    
if ($_GET['pse'] == 261) {
    
     ?>
        <pre>
        <?
    	print_r(explode("\n",passthru("./express.pl 10.131.41.26")));
    	?>
    	</pre>
    <?
    
    
}

if ($_GET['pse'] == 43) {
    
     ?>
        <pre>
        <?
    	print_r(explode("\n",passthru("./express.pl 10.131.41.22")));
    	?>
    	</pre>
    <?
    
    
}

if ($_GET['pse'] == gusinka) {
    
     ?>
        <pre>
        <?
    	print_r(explode("\n",passthru("./express.pl 10.131.41.18")));
    	?>
    	</pre>
    <?
    
    
}


//if ($_GET['pse'] == 222) {
    
//     ?>
//        <pre>
//        <?
//    	print_r(explode("\n",passthru("./express.pl 10.121.10.22")));
//    	?>
//    	</pre>
//    <?
    
    
//}
//if ($_GET['pse'] == 451) {
    
//     ?>
//        <pre>
//        <?
//    	print_r(explode("\n",passthru("./express.pl 10.121.10.26")));
//    	?>
//    	</pre>
//    <?
    
    
//}
?>
