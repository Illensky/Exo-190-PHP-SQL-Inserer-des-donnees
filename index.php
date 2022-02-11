<?php

/**
 * Pour cet exercice, vous allez utiliser la base de données table_test_php créée pendant l'exo 189
 * Vous utiliserez également les deux tables que vous aviez créées au point 2 ( créer des tables avec PHP )
 */

require __DIR__ . '/Classes/Config.php';
require __DIR__ . '/Classes/DBSingleton.php';

try {
    /**
     * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
     */
    $pdo = DBSingleton::PDO();

    /**
     * 1. Insérez un nouvel utilisateur dans la table utilisateur.
     */
    // TODO votre code ici.

    $password = password_hash('cuahxd6wzb3', PASSWORD_ARGON2I);
    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s');

    $preparedAddUserSQLRequest = "
            INSERT INTO user (family_name, name, email, password, address, postal_code, country, registering_date)
                        VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
        ";

    $SQLRequest1 = sprintf($preparedAddUserSQLRequest, 'Laroche', 'Alexis', 'alexis.laroche.02240@gmail.com',
        $password, '55 rue d Hirson', '02830', 'France', $date);

    /*$pdo->exec($SQLRequest1);*/


    /**
     * 2. Insérez un nouveau produit dans la table produit
     */

    // TODO votre code ici.

    $preparedAddProductSQLRequest = "INSERT INTO product (user_fk, title, price, short_description, long_description)
                                                 VALUES  ('%d', '%s', '%f', '%s', '%s')
    ";

    $long_description = "Ragoût de haricots blancs, de charcuterie (saucisse, saucisson à l\'ail, lard) et de viande 
                            (confit d\'oie ou de canard, mouton ou porc). Cassoulet au canard, au mouton.";

    $SQLRequest2 = sprintf($preparedAddProductSQLRequest, 1, 'Cassoulet', 12.78, 'Boite de péteux a la saucisse.', $long_description);

    /* $pdo->exec($SQLRequest2);  */

    /**
     * 3. En une seule requête, ajoutez deux nouveaux utilisateurs à la table utilisateur.
     */

    // TODO Votre code ici.

    $preparedAddTwoUserSQLRequest = "
            INSERT INTO user (family_name, name, email, password, address, postal_code, country, registering_date)
                        VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'),
                               ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
        ";

    $SQLRequest3 = sprintf($preparedAddTwoUserSQLRequest, 'Jean', 'Moulin', 'jeanmouline@gmail.com',
        $password, '55 rue piave', '02784', 'France', $date, 'Marcel', 'Pignole', 'pignololebraved@gmail.com',
        $password, '55 rue des écoles', '59610', 'France', $date);

    /* $pdo->exec($SQLRequest3); */

    /**
     * 4. En une seule requête, ajoutez deux produits à la table produit.
     */

    // TODO Votre code ici.

    $preparedAddTwoProductSQLRequest = "INSERT INTO product (user_fk, title, price, short_description, long_description)
                                                 VALUES  ('%d', '%s', '%f', '%s', '%s'),
                                                         ('%d', '%s', '%f', '%s', '%s')
    ";


    $SQLRequest4 = sprintf($preparedAddTwoProductSQLRequest, 1, 'Cassoulet', 12.78, 'Boite de péteux a la saucisse.',
        $long_description, 1, 'Cassoulet', 12.78, 'Boite de péteux a la saucisse.', $long_description);

    /*$pdo->exec($SQLRequest4);*/

    /**
     * 5. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux utilisateurs dans la table utilisateur.
     */

    // TODO Votre code ici.

    $SQLRequest51 = sprintf($preparedAddUserSQLRequest, 'Laroche', 'Alexis', 'alexis.laroche.02240@gma.com',
        $password, '55 rue d Hirson', '02830', 'France', $date);

    $SQLRequest52 = sprintf($preparedAddUserSQLRequest, 'Laroche', 'Alexis', 'alexis.lahe.02240@gmail.com',
        $password, '55 rue d Hirson', '02830', 'France', $date);

    $SQLRequest53 = sprintf($preparedAddUserSQLRequest, 'Laroche', 'Alexis', 'alexis.laroche.02240@gmail.co',
        $password, '55 rue d Hirson', '02830', 'France', $date);

    /*
    $pdo->beginTransaction();

    $pdo->exec($SQLRequest51);
    $pdo->exec($SQLRequest52);
    $pdo->exec($SQLRequest53);

    $pdo->commit();
    */

    /**
     * 6. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux produits dans la table produit.
     */

    $SQLRequest61 = sprintf($preparedAddProductSQLRequest, 1, 'Cassoulet', 12.78, 'Boite de péteux a la saucisse.', $long_description);

    $SQLRequest62 = sprintf($preparedAddProductSQLRequest, 1, 'Cassoulet', 12.78, 'Boite de péteux a la saucisse.', $long_description);

    $SQLRequest63 = sprintf($preparedAddProductSQLRequest, 1, 'Cassoulet', 12.78, 'Boite de péteux a la saucisse.', $long_description);

/*
    $pdo->beginTransaction();

    $pdo->exec($SQLRequest61);
    $pdo->exec($SQLRequest62);
    $pdo->exec($SQLRequest63);

    $pdo->commit();
*/
} catch (PDOException $e) {
    echo "Une erreur est survenue : " . $e->getMessage();

    $pdo->rollBack();
}