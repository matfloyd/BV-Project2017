<?php

/*Generate a random and strong password of 8 characters
*/

function randomPassGen()
{
    //lower and uppercase alphabets, digits from 0 to 9
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '';

    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

//uncomment the lines below to test

$password = randomPassGen();
echo "Your randomly generated password is: $password";
