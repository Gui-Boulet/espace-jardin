<?php

use App\Connection;

// Instance de PDO pour la connexion à la base de données - PDO instance for connecting to the database
$pdo = Connection::getPDO();

// Création des utilisateurs - Users creation
$users = [
  [
    'email' => 'ascagne@albalonga.tr',
    'password' => password_hash('xxxxxxxxxxxxx', PASSWORD_BCRYPT),
    'role' => 'admin'
  ],
  [
    'email' => 'celine.duchemin@example.com',
    'password' => password_hash('xxxxxxxxxxxxx', PASSWORD_BCRYPT),
    'role' => 'user'
  ],
  [
    'email' => 'pierre.thullier@example.fr',
    'password' => password_hash('xxxxxxxxxxxxx', PASSWORD_BCRYPT),
    'role' => 'user'
  ],
  [
    'email' => 'sam.sonite@exemple.fr',
    'password' => password_hash('xxxxxxxxxxxxx', PASSWORD_BCRYPT),
    'role' => 'user'
  ]
];
// Insertion des données des utilisateurs dans la base de données - Inserting user data into the database
foreach ($users as $user) {
  $pdo->exec(
    "INSERT INTO users (id, email, password, role)
    VALUES (UUID(), '{$user['email']}', '{$user['password']}', '{$user['role']}')"
  );
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
    'street' => 'Avenue des Érables',
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
// Insertion des données des clients dans la base de données - Inserting customer data into the database
foreach ($customers as $customer) {
  $pdo->exec(
    "INSERT INTO customers (first_name, last_name, phone, street_number, street, zip_code, city, country, garden_size, 
      hedge_length, fruit_tree, shrub, small_tree, big_tree, note, user_id)
    VALUES ('{$customer['first_name']}', '{$customer['last_name']}', '{$customer['phone']}',
      '{$customer['street_number']}', '{$customer['street']}', {$customer['zip_code']}, '{$customer['city']}',
      '{$customer['country']}', '{$customer['garden_size']}', {$customer['hedge_length']}, {$customer['fruit_tree']},
      {$customer['shrub']}, {$customer['small_tree']}, {$customer['big_tree']}, '{$customer['note']}',
      '{$customer['user_id']}')"
  );
}


// Création des services - Services creation
$services = [
  ['name' => 'Tonte pelouse', 'status' => 1],
  ['name' => 'Taille haies', 'status' => 1],
  ['name' => 'Taille arbres fruitiers', 'status' => 1],
  ['name' => 'Taille arbustes', 'status' => 1],
  ['name' => 'Elagage petits arbres', 'status' => 1],
  ['name' => 'Elagage grands arbres', 'status' => 1]
];
// Insertion des services dans la base de données - Inserting services into the database
foreach ($services as $service) {
  $pdo->exec("INSERT INTO services (name, status) VALUES ('{$service['name']}', {$service['status']})");
}


// Création des interventions - Interventions creation
$interventions = [
  ['week' => '202348', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202410', 'customer_id' => $usersId[0], 'service_id' => 1],
  ['week' => '202340', 'customer_id' => $usersId[0], 'service_id' => 2],
  ['week' => '202405', 'customer_id' => $usersId[0], 'service_id' => 2],
  ['week' => '202347', 'customer_id' => $usersId[0], 'service_id' => 3],
  ['week' => '202447', 'customer_id' => $usersId[0], 'service_id' => 3],
  ['week' => '202340', 'customer_id' => $usersId[0], 'service_id' => 4],
  ['week' => '202405', 'customer_id' => $usersId[0], 'service_id' => 4],
  ['week' => '202405', 'customer_id' => $usersId[0], 'service_id' => 5],
  ['week' => '202347', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202409', 'customer_id' => $usersId[1], 'service_id' => 1],
  ['week' => '202341', 'customer_id' => $usersId[1], 'service_id' => 2],
  ['week' => '202406', 'customer_id' => $usersId[1], 'service_id' => 2],
  ['week' => '202341', 'customer_id' => $usersId[1], 'service_id' => 4],
  ['week' => '202406', 'customer_id' => $usersId[1], 'service_id' => 4],
  ['week' => '202404', 'customer_id' => $usersId[1], 'service_id' => 5],
  ['week' => '202404', 'customer_id' => $usersId[1], 'service_id' => 6]
];
// Insertion des interventions dans la base de données - Insertion interventions into the database
foreach ($interventions as $intervention) {
  $pdo->exec(
    "INSERT INTO interventions (id, week, customer_id, service_id)
    VALUES (UUID(), '{$intervention['week']}', '{$intervention['customer_id']}', {$intervention['service_id']})"
  );
}


// Création des messages - Messages creation
$messages = [
  [
    'date_comment' => '2023-08-16 16:47:36',
    'comment' => "Un nouveau client vous contacte pour fixer un rendez-vous pour l\'entretien de son jardin",
    'user_id' => $usersId[0]
  ],
  [
    'date_comment' => '2023-10-11 17:23:01',
    'comment' => "Bonjour, je vous informe que je ne suis pas présente le 04 octobre à mon domicile, mais le jardin est 
bien sûr accessible pour vous effectuer les tailles prévues.",
    'user_id' => $usersId[0]
  ],
  [
    'date_comment' => '2023-05-24 08:53:11',
    'comment' => "Un nouveau client vous contacte pour fixer un rendez-vous pour l\'entretien de son jardin",
    'user_id' => $usersId[1]
  ],
  [
    'date_comment' => '2023-11-13 18:12:48',
    'comment' => "Un nouveau client vous contacte pour fixer un rendez-vous pour l\'entretien de son jardin",
    'user_id' => $usersId[2]
  ]
];
// Insertion des messages dans la base de données - Insertion messages into the database
foreach ($messages as $message) {
  $pdo->exec(
    "INSERT INTO messages (date_comment, comment, user_id)
    VALUES ('{$message['date_comment']}', '{$message['comment']}', '{$message['user_id']}')"
  );
}
