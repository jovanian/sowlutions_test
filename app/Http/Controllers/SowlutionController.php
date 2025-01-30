<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SowlutionController extends Controller
{
    //I made them all dynamic the string is being taken from the url
    public function toCamelCase($str){

        //based on the example there was an option for the word not to be snack case so i dummy proofed it

        //In case the word was snake cased
        if (str_contains($str,'_')) {
            //I made all the words start with an UpperCase character
            $upperStr = ucwords($str, '_');
            // I replaced the underscore '_' with an empty character
            $pascalStr = str_replace('_', '',$upperStr);
        }
        //In case the word was no snake cased and had spaces between the words
        else{
            //I made all the words start with an UpperCase character
            $upperStr = ucwords($str);
            //I replaced the empty space ' ' with an empty character
            $pascalStr = str_replace(' ', '',$upperStr);
        }

        //In my Case because i have another function that transforms into Pascal Case i couldv'e called that as below:
        // $pascalStr = $this->toPascalCase($str);

        // I made the first letter to a LowerCase character
        $camelStr = lcfirst($pascalStr);

        return($camelStr);


    }
    public function toPascalCase($str){

        //based on the example there was an option for the word not to be snack case so i dummy proofed it

        //In case the word was snake cased
        if (str_contains($str,'_')) {
            //I made all the words start with an UpperCase character
            $upperStr = ucwords($str, '_');
            // I replaced the underscore '_' with an empty character
            $pascalStr = str_replace('_', '',$upperStr);
        }
        //In case the word was no snake cased and had spaces between the words
        else{
            //I made all the words start with an UpperCase character
            $upperStr = ucwords($str);
            //I replaced the empty space ' ' with an empty character
            $pascalStr = str_replace(' ', '',$upperStr);
        }

        return($pascalStr);

    }
    public function toKebabCase($str){

        if (str_contains($str,'_')) {
            // I replaced the underscore '_' with an '-'
            $kebabStr = str_replace('_', '-',$str);
        }
        //In case the word was no snake cased and had spaces between the words
        else{
            //I replaced the empty space ' ' with an '-'
            $kebabStr = str_replace(' ', '-',$str);
        }

        return($kebabStr);
    }
    public function toSnakeCase($str){

        //I replaced the empty space ' ' with an '_'
        $snackStr = str_replace(' ', '_',$str);

        return($snackStr);
    }

    public function predicutResult($card,$animal,$fruit){

        $prediction = 0;

        //i read the file and mapped it into an array
        $predictionfile = array_map('str_getcsv', file('C:\Users\jovansimidian\Herd\sowlutions_test\public\files\prediction.csv'));

        // adding an html tag for the visual
        echo '<pre>';

        //i removed the first itteration which was the headers of the csv
        print_r(array_slice($predictionfile,1));
        echo '</pre>';

        return($prediction);
    }

    //I tried to get the combination probability based on previous games but this isn't the task

    // public function predicutResult($suit, $animal, $fruit)
    // {
    //     $filePath = public_path('\files\prediction.csv'); // Adjust path as needed

    //     if (!file_exists($filePath)) {
    //         return response()->json(['error' => 'CSV file not found'], 404);
    //     }

    //     $totalMatches = 0;
    //     $successfulWins = 0;

    //     if (($handle = fopen($filePath, "r")) !== false) {
    //         fgetcsv($handle); // Skip header

    //         while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    //             if (count($data) < 4) continue; // Skip invalid rows

    //             list($csvSuit, $csvAnimal, $csvFruit, $win) = $data;

    //             if (strtolower(trim($csvSuit)) === strtolower(trim($suit)) &&
    //                 strtolower(trim($csvAnimal)) === strtolower(trim($animal)) &&
    //                 strtolower(trim($csvFruit)) === strtolower(trim($fruit))) {

    //                 $totalMatches++;
    //                 if (strtolower(trim($win)) === "true") { // Check for "True"
    //                     $successfulWins++;
    //                 }
    //             }
    //         }
    //         fclose($handle);
    //     }

    //     if ($totalMatches === 0) {
    //         return response()->json(['probability' => 'No data available for this combination'], 404);
    //     }

    //     $probability = ($successfulWins / $totalMatches) * 100;
    //     return response()->json(['probability' => round($probability, 2) . '%']);
    // }



    public function filterData($data,$filter){

        // cleaning the string
        $data = trim($data,'[');
        $data = trim($data,']');

        // makeing the clean string an array
        $data = explode(',',$data);
        $cleandata = array();

        // dd(strpos($filter,'='));r

        //get the psoition of the end of the devier in case was more than 1 character
        $loc = strpos($filter,'=') - 2;

        //get the devider
        $devider = substr($filter,2,$loc);

        // dd($data[1],$devider, $data[1] % $devider == 0);
        if($filter[1] == '%'){

            //loop over the hole array
            for($i = 0; $i < count($data); $i++){
                if( $data[$i] % $devider == 0){

                    //add the ones that are correct to the new array
                    array_push($cleandata,$data[$i]);
                }
            }
        }

        // dd($filter);
        return($cleandata);
    }
    public function transformData($data,$trans){

        // cleaning the string
        $data = trim($data,'[');
        $data = trim($data,']');

        // makeing the clean string an array
        $data = explode(',',$data);

        for($i = 0; $i < count($data); $i++){
            $updated = str_replace('x',$data[$i],$trans);
            $data[$i] = eval('return '.$updated.';');
        }

        return $data;

    }
    public function sumData($data){

        // cleaning the string
        $data = trim($data,'[');
        $data = trim($data,']');

        // makeing the clean string an array
        $data = explode(',',$data);

        // adding the number i coulv'e looped over the array also to get the same result which adding on every itteration.
        $total = array_sum($data);

        return($total);
        // return $dataSum;
    }
    public function calculateAverage($data){

        // cleaning the string
        $data = trim($data,'[');
        $data = trim($data,']');

        // makeing the clean string an array
        $data = explode(',',$data);

        // getting the average by deviding the sum with the number of numbers there is
        $average = array_sum($data)/count($data);
        return($average);
    }
    public function findMax($data){

        // cleaning the string
        $data = trim($data,'[');
        $data = trim($data,']');

        // makeing the clean string an array
        $data = explode(',',$data);

        // getting the biggest number of the array
        $max = max($data);

        return $max;
    }
    public function findMin($data){

        // cleaning the string
        $data = trim($data,'[');
        $data = trim($data,']');

        // makeing the clean string an array
        $data = explode(',',$data);

        // getting the biggest number of the array
        $min = min($data);

        return $min;
    }

    // public function problem4(){

    //     //i was testing something
    //     // $outText = $this->xor_this('jovansimidian');
    //     // dd($outText);

    //     $cipheredmsg = file_get_contents('C:\Users\jovansimidian\Herd\sowlutions_test\public\files\p059_cipher.txt');
    //     $arrayciphered = explode(',',$cipheredmsg);

    //     for($i = 0; $i < count($arrayciphered); $i++){
    //         $arraymsg[$i] = chr($arrayciphered[$i]);
    //     }

    //     dd(implode(',',$arraymsg));
    // }

    //useless test

    // public function xor_this($string) {

    //     // Let's define our key here
    //     $key = 'abc';

    //     // Our plaintext
    //     $text = $string;

    //     // Our output text
    //     $outText = '';

    //     // dd(strlen($text));
    //     // Iterate through each character
    //     for($i = 0; $i < strlen($text);)
    //     {
    //         for($j = 0; $j < strlen($key); $j++, $i++)
    //         {
    //             $outText = $outText . ($text[$i] ^ $key[$j]);
    //         }
    //         dd($outText);

    //      }

    //      return $outText;
    //     }

    // XOR decrypt function
    function xorDecrypt($cipherText, $key) {
        $decryptedText = '';
        $keyLength = strlen($key);
        for ($i = 0; $i < strlen($cipherText); $i++) {
            // XOR decrypt each character and convert it to ASCII
            $decryptedText .= chr((int)$cipherText[$i] ^ ord($key[$i % $keyLength]));
        }
        return $decryptedText;
    }

    function containsCommonEnglishWords($text) {
        $commonWords = ['the', 'and', 'is', 'in', 'it', 'you', 'that', 'this', 'of', 'to', 'a', 'with', 'for', 'on', 'at', 'was', 'i', 'I', 'congrats', 'message', 'Sowlution'];
        foreach ($commonWords as $word) {
            if (strpos($text, $word) !== false) {
                return true;
            }
        }
        return false;
    }

    // Function to check if the decrypted text has a sentence-like structure
    function isSentenceLike($text) {
        // Check if text starts with an uppercase letter and ends with a punctuation mark (., ?, or !)
        return preg_match('/^[A-Z].*[.!?]$/', $text);
    }

    // Brute-force function for a 3-letter key
    function problem4() {
    $letters = range('a', 'z'); // Alphabet letters
    $found = false;
    $filePath = public_path('/files/p059_cipher.txt'); // Modify if necessary to match your file's location
    $cipherText = file_get_contents($filePath);

    // Loop through all possible 3-letter keys (lowercase only)
    foreach ($letters as $first) {
        foreach ($letters as $second) {
            foreach ($letters as $third) {
                $key = $first . $second . $third; // Construct the 3-letter key
                $decryptedText = $this->xorDecrypt($cipherText, $key);

                // Check if the decrypted text contains readable English
                // if (preg_match('/[a-z]/', $decryptedText)) {
                if (preg_match('/[a-z]/', $decryptedText) && $this->containsCommonEnglishWords($decryptedText) && $this->isSentenceLike($decryptedText)) {
                    echo "Possible key: $key\n";
                    echo "Decrypted text: $decryptedText\n\n";
                    $found = true;
                }
            }
        }
    }

        if (!$found) {
            echo "No readable or meaningful plaintext found.\n";
        }
    }

}
