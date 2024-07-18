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
```
cd $CAMINHO_PROJETO/src
docker-compose up -d
```

#### Execução de testes
```
docker exec precpag-api "./vendor/bin/phpunit"
```

### Sem Docker
#### Requisitos
- PHP 8.2
- Composer v2

Execute no seu terminal:
```
cd $CAMINHO_PROJETO/src
composer install
php artisan serve
```

#### Execução de testes
```
./vendor/bin/phpunit
```