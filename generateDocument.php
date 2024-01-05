<?php

require 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;

// Get the HTML content from the POST request
$content = json_decode(file_get_contents('php://input'))->content;

// Create a new PhpWord instance
$phpWord = new PhpWord();

// Add a section and use addHtml to insert HTML content into the document
$section = $phpWord->addSection();
$htmlElement = $section->addHtml($content);

// Save the document to the public directory with explicit Word2007 format
$publicDirectory = __DIR__;
$documentPath = $publicDirectory . '/generated_document.docx';
$phpWord->save($documentPath, 'Word2007');

// Return the relative path to the generated document
echo json_encode(['fileUrl' => '/generated_document.docx']);
