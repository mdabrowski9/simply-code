<?php
/**
 * Prosty kod w PHP7.1
 * Inicjuje tabele zawierajace przykladowe adresy URL
 * Sprawdzenie poprawnosci adresow url i stworzenie tabeli wynikowej
 * Wybranie losowej wartosci z tabeli poprawnych adresow URL
 * Sprawdzenie Czy dlugosc adresu URL mniejsza rowna czy wieksza od 15
 * Wykonanie odpowiedniej akcji w zaleznosci od dlugosci adresu
 */

$lengthUrlAddress = 16;
$urlAddresses = array(
    'www.blablabla.com',
    'to_jest_poprawny_URL',
    'www.to-nie-jest-poprawny-url.pl',
    'http://test1234.com',
    'https://t4.com',
    'https://test1234.com.pl',
    'www.wp.pl',
    'www.wp.pl.com',
    'http://www.wp.pl',
);

echo "You chose a length equal to $lengthUrlAddress letters \n \n";

$validUrl = createValidUrlArray($urlAddresses);
var_dump($validUrl);

$url = $validUrl[array_rand($validUrl)];
echo "$url \n";

switch (strlen($url) <=> $lengthUrlAddress) {
    case -1:
        echo "The selected parameter is shorter than $lengthUrlAddress letters \n";
        try{
            tryToAddMoreLetters($url);
        } catch (EngineException $e) {
            echo $e->getMessage();
        }
        break;
    case 0:
        echo "The selected parameter is perfect \n";
        break;
    case 1:
        echo "The selected parameter is too long \n";
        break;
    default:
        echo 'This is unlikely';
}
echo "Result after switch case \n $url \n";

function createValidUrlArray($urlAddresses) : array {
    $validUrl = [];
    foreach($urlAddresses as $urlAddress) {
        if(filter_var($urlAddress, FILTER_VALIDATE_URL)){
            array_push($validUrl, $urlAddress);
        }
        else{
            echo "It`s not valid URL $urlAddress \n";
        }
    }

    return $validUrl;
}
function tryToAddMoreLetters($url) : string {

    return $url + 1;
}