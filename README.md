# Tecnologias utilizadas
- PHP 8.2
- Nginx
- Laravel 11
- Docker

## Instalação
### Com Docker
#### Requisitos
- Docker

Execute no seu terminal:
```shell
cd $CAMINHO_PROJETO/src
docker-compose up -d
```

#### Execução de testes
```shell
docker exec precpago-api "./vendor/bin/phpunit"
```

### Sem Docker
#### Requisitos
- PHP 8.2
- Composer v2

Execute no seu terminal:
```shell
cd $CAMINHO_PROJETO/src
composer install
php artisan serve
```

#### Execução de testes
```shell
./src/vendor/bin/phpunit
```