# Tecnologias utilizadas
- PHP 8.2
- Nginx
- Laravel 11
- Docker

## Instalação
#### Requisitos
- Docker

Rodar comando:
```shell
cd $CAMINHO_PROJETO/src
docker-compose up -d
```

#### Execução de testes
```shell
docker exec precpago-api "./vendor/bin/phpunit"
```
