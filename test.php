<?php
namespace test;
function _load_all($a)
{
    foreach (glob($a) as $b) {
        if (is_dir($b)) {
            _load_all($b . "/*"); // recursive include.
            continue;
        } else {
            if ($b == __FILE__) continue;
            if (pathinfo($b)['extension'] == "php") : include $b; endif;
        }
    }
}
_load_all("lib/*");


// // connect to the database / create instance
$si = new SlickInject("localhost", "username", "password", "database_name");
// $si->connect() is usable aswell, instead of passing the args via the constructor

// get rows from database as an array
$data = $_slickinject->SELECT([], "table", array("id"=>1)); // @Array : Returns array
print_r($data); // print data

// INSERT :: INSERT INTO `table` (`id`,`username`) VALUES (5, 'bob')
$si->INSERT('table', array("id"=>5,"username"=>"bob")); // @SQLResponce

// UPDATE :: UPDATE `table` SET `username`='bobo' WHERE `id`=5
$si->UPDATE('table', array("username"=>"bobo"), array("id"=>5)); // @SQLResponce

// DELETE :: DELETE FROM `table` WHERE `username`='bobo'
$si->DELETE('table', array("username"=>"bobo"));

// TRUNCATE
$si->TRUNCATE("table");

// Advanced Selecting
// :: SELECT id, username, email FROM `table` WHERE id > 5 AND active = 1
$si->SELECT(["id", "username", "email"], "table", array("id > 5", "AND", "active = 1"));

// Reserved Keyword Handler : Mistakes happens
// :: SELECT `from`, `where`, `key` FROM `table`
$si->SELECT(["from", "where", "key"], "table");

// CLOSE : ALWAYS CLOSE YOUR DATABASE IF NOT LONGER BEING USED
$si->close();

