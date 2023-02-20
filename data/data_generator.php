<?php
$tables = [
    'users' => [
        'nome' => 'varchar(50) not null',
        'cognome' => 'varchar(50) not null',
        'email' => 'varchar(50) not null'
    ],
    'products' => [
        'productName' => 'varchar(50)'
    ],
    'orders' => [
        'userId' => 'int(10) not null',
        'productId' => 'int(10) not null',
        'createdAt' => 'date'
    ]
];

$data = [
    'users' => [
        ['marco', 'rossi', 'm.rossi@gmail.com'],
        ['andrea', 'verdi', 'andrea.verdi@yahoo.it'],
        ['piero', 'maso', 'p.maso2@yahoo.it'],
        ['alice', 'minna', 'alice_minna@gmail.com'],
        ['laura', 'alessi', 'lauretta.a@gmail.com'],
        ['mara', 'venier', 'maravenier@tiscali.it'],
        ['roberta', 'tomalino', 'robitomalino@gmail.com']
    ],
    'products' => [
        ['maglietta'],
        ['agenda'],
        ['cellulare'],
        ['abbonamento'],
        ['automobile'],
        ['integratori'],
        ['televisore'],
        ['libro'],
        ['massaggio']
    ],
    'orders' => []
];
//popolo gli ordini in maniera casuale prendendo date degli ultimi due mesi
$numOrdini = 100;
$numUsers = count($data['users']);
$numProducts = count($data['products']);
$nowTime = time();
$dueMesiFa = strtotime('-60 days');
$timeRangeDueMesi = $nowTime - $dueMesiFa;
for($i = 1; $i <= $numOrdini; $i ++) {
    $data['orders'][] = [rand($numUsers, 1), rand($numProducts, 1), date('Y-m-d', $dueMesiFa + rand($timeRangeDueMesi, 1))];
}

function createTable ($db, $name, $data) {

    $db->rawQuery("DROP TABLE IF EXISTS $name");
    $q = "CREATE TABLE $name (id INT(9) UNSIGNED PRIMARY KEY AUTO_INCREMENT";
    foreach ($data as $k => $v) {
        $q .= ", $k $v";
    }
    $q .= ")";
    $db->rawQuery($q);
}

function insertValues($db, $table, $fields, $dataArray) {

    $fieldsStr = implode(',', array_keys($fields));
    $q = "INSERT INTO $table ($fieldsStr) VALUES ";
    //uso il formato json dell'array per creare rapidamente ilformato di inserimento INSERT ... VALUES ...
    $vals = substr(str_replace(['[', ']'], ['(', ')'], json_encode($dataArray)), 1, -1);
    $q .= $vals;
    $db->rawQuery($q);
}
foreach ($tables as $name => $fields) {
    createTable ($db, $prefix.$name, $fields);
    insertValues ($db, $prefix.$name, $fields, $data[$name]);
}
