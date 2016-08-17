<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 10:43
 */

//$ch = curl_init('http://www.saasebay.com/api/update/analit_views');
//$ch = curl_init('http://www.saasebay.com/api/update/analit_sold');
//$ch = curl_init('http://www.saasebay.com/api/update/analit_publish');
$ch = curl_init('http://www.saasebay.com/api/update/analit_products_by_brand_category');

print "Start \n";

$nowTime = new \DateTime();
$nextTime = $nowTime->add(new \DateInterval("PT2S"));

for ($i = 0; $i < 20000;) {
    if ($nowTime >= $nextTime) {
        $startTime = microtime();
        if(!curl_exec($ch)){
            echo "error in curl. number:". $i . "\n";
        }
        $endTime = microtime();
        print (float)($endTime-$startTime) . "\n(i:". $i .")\n\n";
        $i+=1;
        $nextTime = $nowTime->add(new \DateInterval("PT2S"));
    }
    $nowTime = new \DateTime();
}

curl_close($ch);