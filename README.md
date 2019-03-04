# bordeaux-0918-php-world-wide-job

Vous partez ici d'un projet Symfony déjà initialisé (website-skeleton) avec le versioning déjà prêt. 
Il y a déjà différentes librairies pré-configurées. 


## Comment démarrer ?

La marche à suivre pour récupérer le "kit de démarrage" du projet est la suivante : 

1. Cloner le projet,
2. Faire un `composer install`
3. Faire un `sudo apt-get install nodejs`

## Installer yarn

4. Faire
``` 
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt-get update && sudo apt-get install yarn
```
   La documentation se trouve ici : https://yarnpkg.com/fr/docs/install#debian-stable
   
## Installer Elasticsearch via FOSElasticaBundle

1. Installer elasticsearch 
http://www.elastic.co/guide/en/elasticsearch/reference/current/getting-started-install.html
    * Download : `curl -L -O https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.5.4.tar.gz`
    * Unzip and Install : `tar -xvf elasticsearch-6.5.4.tar.gz`
    * Dans le terminal : `cd elasticsearch-6.5.4/bin`
    * Lancer le server elastic `./elasticsearch` 

2. Check version Java `java -version` `echo $JAVA_HOME`
3. Si JAVA JDK n'est pas installer récupérer les paquets via `apt`
( https://stackoverflow.com/questions/14788345/how-to-install-the-jdk-on-ubuntu-linux )

## Configuration Symfony

1. Créer un fichier .`env.local` à partir du fichier` .env` (ne surtout pas renommer ou supprimer le `.env` initial)
2. Configurer le `.env.local` avec les accès que je vous ai donné dans vos répertoires respectifs.
3. Lancer le server elastic `./elasticsearch`
4. Populate l'index elasticsearch `$ php bin/console fos:elastica:populate`
    
    La documentation elaticsearch se trouve ici : https://github.com/FriendsOfSymfony/FOSElasticaBundle/blob/master/doc/setup.md
    
## Les librairies :

1. Travis, pour l'intégration continue sur github,
2. Code Sniffer, pour la prepreté du code et le respect des PSR,
3. GrumPHP, pour lancer des tests au pré-commit,
4. PHPUnit, pour les tests unitaires.
# WorldWideJob-Php-Symfony4
# WorldWideJob-Php-Symfony4
