<?php
require "vendor/autoload.php";
require "customsearch.php";

$search = new CustomSearch();
$search->setIndex("knowledgebase");
$search->setType("storm");
$search->setSearchColumn("question");
$result = $search->search("I want to know the parentage of jon snow");
echo '<pre>';
print_r($result);
echo '</pre>';
?>
