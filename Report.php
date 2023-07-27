<?php

/**
 * This file is part of the PHPJasper/phpjasper
 * @author Daniel Rodrigues Lima (geekcom)
 */

namespace Report;

use PHPJasper\PHPJasper;

require 'vendor/autoload.php';

class Report
{
    private $PHPJasper;

    public function __construct()
    {
        $this->PHPJasper = new PHPJasper();
        $this->generate_report();
    }

    public function generate_report()
    {
        $input = 'input/books.jrxml';
        $output = 'output';
        $options = [
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [],
            'db_connection' => [
                'driver' => 'mysql', //mysql, postgres, oracle, generic (jdbc)
                'username' => 'root',
                'password' => '""',
                'host' => 'localhost',
                'database' => 'elibrary',
                'port' => '3306'
            ]
        ];

        $x = $this->PHPJasper->process(
            $input,
            $output,
            $options
        )->output();

        print_r($x);

        $this->PHPJasper->process(
            $input,
            $output,
            $options
        )->execute();


        // Replace 'path/to/your/pdf/file.pdf' with the actual path to your PDF file
        $filePath = __DIR__ . 'output/books.pdf';

        // Check if the file exists
        if (file_exists($filePath)) {
            // Set the appropriate headers to force the browser to open the file in a new tab
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="file.pdf"');
            header('Content-Length: ' . filesize($filePath));

            // Output the PDF file content
            readfile($filePath);

        } else {
            // Handle the case when the file is not found
            echo 'The PDF file does not exist.';
        }

        // go back to index page
        header('Location: index.php');
    }
}

$reporter = new Report();
