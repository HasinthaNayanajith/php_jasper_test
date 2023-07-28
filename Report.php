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
        $input = 'input/grouped_books.jrxml';
        $output = 'output';
        $options = [
            'format' => ['pdf', 'html'],
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

        // $x = $this->PHPJasper->process(
        //     $input,
        //     $output,
        //     $options
        // )->output();

        // print_r($x);

        // $this->PHPJasper->clearCompile(); // Clear the cache

        // $this->PHPJasper->process(
        //     $input,
        //     $output,
        //     $options
        // )->execute();

        // go back to index page
        header('Location: index.php');
    }
}

$reporter = new Report();
