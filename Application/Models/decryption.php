<?php

class Decryption_Model
{
    public function alphabeticMD5HashcodeDecrypting($length, $hash, $str)
    {
        $alphabet = array ("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

        foreach ($alphabet as $value) {
            $current = $value.$str;
            if (md5($current) == $hash) {
                echo ("<b>Hashcode: </b>" . md5($current). " | <b>Password: </b>$current<br>\n");
                break;
            }
            if (strlen($current) == $length + 1) break;
            // Usage calling recursive function for brute MD5 hash-codes
            $this->alphabeticMD5HashcodeDecrypting ($length, $hash, $current);
        }
    }

    public function linuxDictionaryMD5HashcodeDecrypting($hash, $dictionary)
    {
        $words = file($dictionary);
        $total = count($hash);
        $tmpHash = $hash;
        $pwd = null;

        echo "<br>Hashcodes decrypted with dictionary: <b>$dictionary</b><br><br>";

        foreach ($words as $word) {
            foreach ($tmpHash as $key => $val) {
                $word = strtolower(trim($word));
                if ($val === md5($word)) {
                    $pwd [$key] = $word;
                    unset ($tmpHash [$key]);
                    $total--;
                    if (!$total) break 2; // exit of two levels
                }
            }
        }

        if (is_array ($pwd))
            foreach ($pwd as $key => $val) {
                echo "<b>Hashcode: </b>" . $hash [$key] . " | <b>Password: </b> " . $pwd [$key] . "<br>\n";
            }
    }
}
