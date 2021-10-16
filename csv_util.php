<?php
function readCSV($filename){
  $items=[];
  if (($handle = fopen($filename, 'r')) !== FALSE) { // Check the resource is valid
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Check opening the file is OK!
          //print_r($data);
          $items[]= $data;// Array
      }
      fclose($handle);
  }
  return $items;
}

function writeCSV($filename,$data){  //Overwrite csv files
  $handle = fopen($filename, 'w');      //Open file
  foreach ($data as $fields) {            //loop to iterate and ovewrite values
      fputcsv($handle, $fields, ';');
  }
  fclose($handle);
}

function removeData($quote){              //removes quote
  unset($quote[$_GET['i']]);               //unset the index from get
  $quote = array_values($quote);              //replace the value
  return $quote;
}

function addAuthor($authors) {           //adds a new author
$newAuthor = array(                          //create array with new data
    0 => array(
      0 => $_GET['author'])
);
$data = array_merge($authors, $newAuthor);           //append data to csv file
return $data;
}

function addQuote($quotes, $authors) {         //adds a new quote
$newIndex=count($authors);
$newQuote = array(                      //put new data in array
    0 => array(
      0 => $_GET['quote'],
      1 => $newIndex
    )
);
$data = array_merge($quotes, $newQuote);      //append data to csv file
return $data;
}
function replaceQuote($quotes) {                //function to replace with new quote
$replacementQuote = array(                    //put new data in array
    $_GET['i'] => array(
      0 => $_POST['quote'],
      1 => $quotes[$_GET['i']][1]
    )
);
$newQuotes = array_replace($quotes, $replacementQuote);       //replace selected index with new data
return $newQuotes;
}
function replaceAuthor($authors) {             //function to replace with new author
$replacementAuthor = array(                   //put new data in array
    $_GET['i'] => array(
      0 => $_POST['author'])
);
$newAuthors = array_replace($authors, $replacementAuthor);    //replace selected index with new data
return $newAuthors;
}
?>
