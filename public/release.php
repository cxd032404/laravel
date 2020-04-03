<?php
$command = "cd ../ && git status  && git pull";
(exec($command,$return));
echo implode("\n",$return)."\n";
unset($return);
$command = "cd ../ && php artisan config:cache";
(exec($command,$return));
echo implode("\n",$return)."\n";
unset($return);
$command = "cd ../ && php artisan route:cache";
(exec($command,$return));
echo implode("\n",$return)."\n";
unset($return);

