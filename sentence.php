<?php
/**

You have sentence without spaces & dictionary with words. Need insert spaces as need. 

c - amount chars in sentence's string
w - amount words in dictionary

Runtime: O(w*log(c))

*/

$sentence = "we will go to a cinema together on a new film brainstorm too before touch tooth";

$sentence = "wewillgotoacinematogetheronanewfilmbrainstormtoobeforetouchtooth";
//$sentence = "zxcczxczxcz";
$dictionary = array('a','go','to','we', 'car', 'too','get','the', 'new', 'drive', 'will','brain', 'storm', 'tooth', 'brush', 'cinema','together','on','film','brainstorm','toothbrush','before', 'touch');
echo "dictionary=".count($dictionary)."\n";
$sArr = str_split($sentence);

$initWord = '';
$len = count($sArr);
echo "len=$len\n";
$wordIndStart = 0;
$resultSentence = array();

$maxG =20;
$g = 0;
$amountOperations = 0;

$resultArr = getWords($sentence,$resultSentence,$initWord,0,$len,$dictionary,$sArr);
echo implode($resultArr, ' ');

echo "\n\n$amountOperations";

function getWords(&$sentence, &$resultSentence, $initWord, $wordIndStart, $len, $dictionary,$sArr) {
  global $g, $maxG,$amountOperations;
  echo "initWord=$initWord, $wordIndStart\n";
  $wordIndexes = array();
  $i = $wordIndStart;
  $word = $initWord;  
  while ($i < $len) {    
    $word .= $sArr[$i];    
    $ind = array_search($word, $dictionary);    
    if ($ind !== false) {      
      $resultSentence[] = $word;            
      $wordIndStart = $i+1;      
      $word = '';
      $initWord = '';
    }
    $amountOperations++;
    $i++;
  }
  //word not found, back previous word
  if ($ind === false && count($resultSentence) > 0) {
    echo "g=$g <> $maxG\n";
    $lastWord = array_pop($resultSentence);
    print_r($resultSentence);
    $initWord = $lastWord.$initWord;    
    $g++;
    if ($g < $maxG) {      
      $resultSentence = getWords($sentence,$resultSentence,$initWord,$wordIndStart,$len,$dictionary,$sArr);
    }      
  }
  else {
    $resultSentence[] = $word;
  }

  return $resultSentence;
}