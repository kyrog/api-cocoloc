# api-cocoloc
ma lubule


renter dans l'image :

- docker exec -it mydockersymfony5_php_1 sh

puis faire un :

composer i (ou install)

run les migration avec:

- php bin/console do:mi:mi

run les fixtures :

php bin/console doctrine:fixtures:load

Générer les clés publiques et priver de jwt 

symfony console lexik:jwt:generate-keypair