uKnowWhatImean
====================

If you're here U know what I mean.

Prerequisites
-----

- [Docker](https://docs.docker.com/engine/installation/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

Usage
-----

1. Clone the Project.
```
git clone git@github.com:dramirezbcn/uKnowWhatImean.git
```
2. Copy /etc/development/docker-compose.yml.dist to project root removing .dist extension.
```
cd uKnowWhatImean
cp etc/development/docker-compose.yml.dist docker-compose.yml
```
3. Start containers using: 
```
docker-compose up -d --build
```
4. Check containers
```
docker ps
```

5. Access to php-fpm:
```
docker exec -it app_dev_fpm bash
```

6. Install dependencies (inside fpm):
```
composer install
```

7. Create and initialize database(inside fpm):
```
nuke
```

Troubleshooting
-----
- /var/cache denied permission
```
sudo chown -R xxxx:xxxx  ~/Proyectos/uKnowWhatImean/var/cache/
```

Symfony Commands
-----
- Create User
```
php7.0 bin/console app:create-user 'Test'
```
- Create a new game
```
php7.0 bin/console app:create-new-game 1 2
```
- Make a move
```
php7.0 bin/console app:make-move 1 2 2 X 1
```
- Check a winner
```
php7.0 bin/console app:check-winner 1
```
- Delete User
```
php7.0 bin/console app:delete-user 1
```
- Start interactive game
```
php7.0 bin/console app:start
```
Running Tests
-----
```
php7.0 /app/vendor/phpunit/phpunit/phpunit --configuration /app/phpunit.xml.dist /app/tests
```