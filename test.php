<?php

$iban = 'DE93200505501280508647';

class Test
{
    const PEOPLE = array(
        'Alex' => array(
            'Age' => 42,
            'Job' => 'Programmer'
        ),
        'Robert' => array(
            'Age' => 35,
            'Job' => 'Programmer'
        )
    );

    public function showPeople()
    {
        foreach (array_keys(self::PEOPLE) as $person) {
            echo $person . PHP_EOL;
        }
    }

    public function getAge($name)
    {
        var_dump(self::PEOPLE[$name]['Age']);
    }

    public function getJob($name)
    {
        var_dump(self::PEOPLE[$name]['Job']);
    }

    
}

$test = new Test();
$test->showPeople();
$test->getAge('Alex');
$test->getAge('Robert');
$test->getJob('Robert');
