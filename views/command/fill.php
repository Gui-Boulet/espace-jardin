<?php

$pdo = new PDO('mysql:dbname=garden;host=localhost', 'root', 'R00T_My5q!',
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Création des utilisateurs - Users creation
$users = [
  [
    'email' => 'ascagne@albalonga.tr',
    'password' => password_hash('B@bilL0n', PASSWORD_BCRYPT),
    'role' => 'admin'
  ],
  [
    'email' => 'celine.duchemin@example.com',
    'password' => password_hash('Str33tC3!in3', PASSWORD_BCRYPT),
    'role' => 'user'
  ],
  [
    'email' => 'pierre.thullier@example.fr',
    'password' => password_hash('St0n3Thu!!13r', PASSWORD_BCRYPT),
    'role' => 'user'
  ],
  [
    'email' => 'sam.sonite@exemple.fr',
    'password' => password_hash('Suitc@s3S@m', PASSWORD_BCRYPT),
    'role' => 'user'
  ]
];
foreach ($users as $user) {
  $pdo->exec("
    INSERT INTO users (id, email, password, role) VALUES (UUID(), '$user[email]', '$user[password]', '$user[role]')
  ");
}

// Récupération des id des clients - Retrieving customers id
$query = $pdo->prepare("SELECT id FROM users WHERE role = :role");
$query->execute(['role' => 'user']);
$usersId = $query->fetchAll(PDO::FETCH_COLUMN);

// Création des clients - Customers creation
$customers = [
  [
    'first_name' => 'Céline',
    'last_name' => 'Duchemin',
    'phone' => '0033322222222',
    'street_number' => '12b',
    'street' => 'Avenue des Erables',
    'zip_code' => 58888,
    'city' => 'Saulane',
    'country' => 'France',
    'garden_size' => 'moins de 1000',
    'hedge_length' => 50,
    'fruit_tree' => 5,
    'shrub' => 15,
    'small_tree' => 10,
    'big_tree' => 0,
    'note' => 'Pas possible le lundi matin avant 10h',
    'user_id' => $usersId[0]
  ],
  [
    'first_name' => 'Pierre',
    'last_name' => 'Thullier',
    'phone' => '0033354545454',
    'street_number' => '5',
    'street' => 'Rue de la Prairie',
    'zip_code' => 59999,
    'city' => 'Verton',
    'country' => 'France',
    'garden_size' => 'entre 2000 et 3000',
    'hedge_length' => 120,
    'fruit_tree' => 0,
    'shrub' => 42,
    'small_tree' => 25,
    'big_tree' => 15,
    'note' => 'Numéro de portail : 5486',
    'user_id' => $usersId[1]
  ],
  [
    'first_name' => 'Sam',
    'last_name' => 'Saunite',
    'phone' => '0033198765432',
    'street_number' => '7',
    'street' => 'Impasse des Oliviers',
    'zip_code' => 64444,
    'city' => 'Pofar',
    'country' => 'France',
    'garden_size' => 'moins de 1000',
    'hedge_length' => 0,
    'fruit_tree' => 0,
    'shrub' => 0,
    'small_tree' => 0,
    'big_tree' => 0,
    'note' => '',
    'user_id' => $usersId[2]
  ]
];
foreach ($customers as $customer) {
  $pdo->exec("
    INSERT INTO customers (first_name, last_name, phone, street_number, street, zip_code, city, country, garden_size, 
    hedge_length, fruit_tree, shrub, small_tree, big_tree, note, user_id) VALUES (
      '$customer[first_name]', '$customer[last_name]', '$customer[phone]', '$customer[street_number]',
      '$customer[street]', '$customer[zip_code]', '$customer[city]', '$customer[country]', '$customer[garden_size]',
      '$customer[hedge_length]', '$customer[fruit_tree]', '$customer[shrub]', '$customer[small_tree]',
      '$customer[big_tree]', '$customer[note]', '$customer[user_id]'
    )
  ");
}

// Création des services - Services creation
$services = [
  'Tonte pelouses', 'Taille haies', 'Taille arbres fruitiers', 'Taille arbustes', 'Elagage petits arbres',
  'Elagage grands arbres'
];
foreach ($services as $service) {
  $pdo->exec("INSERT INTO services (name) VALUES ('$service')");
}

// Création des interventions - Interventions creation
$interventions = [
  ['week' => '202344', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202346', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202348', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202410', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202412', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202414', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202416', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202418', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202420', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202422', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202424', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202426', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202428', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202430', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202432', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202434', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202436', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202438', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202440', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202442', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202444', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202446', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202448', 'frequency' => '2semaines', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202340', 'frequency' => '6mois', 'customer_id' => $usersId[0], 'service_id' => 2],
  ['week' => '202414', 'frequency' => '6mois', 'customer_id' => $usersId[0], 'service_id' => 2],
  ['week' => '202440', 'frequency' => '6mois', 'customer_id' => $usersId[0], 'service_id' => 2],
  ['week' => '202340', 'frequency' => NULL, 'customer_id' => $usersId[0], 'service_id' => 3],
  ['week' => '202340', 'frequency' => '6mois', 'customer_id' => $usersId[0], 'service_id' => 4],
  ['week' => '202414', 'frequency' => '6mois', 'customer_id' => $usersId[0], 'service_id' => 4],
  ['week' => '202440', 'frequency' => '6mois', 'customer_id' => $usersId[0], 'service_id' => 4],
  ['week' => '202408', 'frequency' => NULL, 'customer_id' => $usersId[0], 'service_id' => 5],
  ['week' => '202341', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202343', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202345', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202347', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202409', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202411', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202413', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202415', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202417', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202419', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202421', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202423', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202425', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202427', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202429', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202431', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202433', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202435', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202437', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202439', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202441', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202443', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202445', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202447', 'frequency' => '2semaines', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202341', 'frequency' => NULL, 'customer_id' => $usersId[1], 'service_id' => 2],
  ['week' => '202341', 'frequency' => NULL, 'customer_id' => $usersId[1], 'service_id' => 4],
  ['week' => '202350', 'frequency' => NULL, 'customer_id' => $usersId[1], 'service_id' => 5],
  ['week' => '202404', 'frequency' => NULL, 'customer_id' => $usersId[1], 'service_id' => 6]
];
foreach ($interventions as $intervention) {
  $pdo->exec("
    INSERT INTO interventions (week, frequency, customer_id, service_id) VALUES (
      '$intervention[week]', '$intervention[frequency]', '$intervention[customer_id]', '$intervention[service_id]'
    )
  ");
}

// Création des messages - Messages creation
$messages = [
  [
    'date_comment' => '2023-08-16 16:47:36',
    'comment' => "Un nouveau client vous contacte pour fixer un rendez-vous pour l\'entretien de son jardin",
    'seen' => 1,
    'user_id' => $usersId[0]
  ],
  [
    'date_comment' => '2023-10-11 17:23:01',
    'comment' => "Bonjour, je vous informe que je ne suis pas présente le 04 octobre à mon domicile, mais le jardin est 
bien sûr accessible pour vous effectuer les tailles prévues.",
    'seen' => 1,
    'user_id' => $usersId[0]
  ],
  [
    'date_comment' => '2023-05-24 08:53:11',
    'comment' => "Un nouveau client vous contacte pour fixer un rendez-vous pour l\'entretien de son jardin",
    'seen' => 1,
    'user_id' => $usersId[1]
  ],
  [
    'date_comment' => '2023-11-13 18:12:48',
    'comment' => "Un nouveau client vous contacte pour fixer un rendez-vous pour l\'entretien de son jardin",
    'seen' => 1,
    'user_id' => $usersId[2]
  ]
];
foreach ($messages as $message) {
  $pdo->exec("
    INSERT INTO messages (date_comment, comment, seen, user_id) VALUES (
      '$message[date_comment]', '$message[comment]', '$message[seen]', '$message[user_id]'
    )
  ");
}