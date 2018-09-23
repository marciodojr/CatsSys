# CatsSys - Sistema administrativo para cursos assistenciais

## Primeira Parte - Setup do ambiente

### Docker

Para execução do ambiente de desenvolvimento é necessário possuir o docker e docker-compose instalados:

- Docker (CE): https://docs.docker.com/install/linux/docker-ce/ubuntu/
- Docker Compose: https://docs.docker.com/compose/install/

### Repositório base:

Clone o repositório

```sh
git clone https://github.com/CATSInformatica/CatsSys && cd CatsSys
git remote add upstream https://github.com/CATSInformatica/CatsSys
git checkout develop
```

**_Importante_**: Todos os comandos a seguir devem ser executados na raiz do repositório clonado.

```sh
tee config/autoload/local.php > /dev/null <<EOF
<?php
// ./config/autoload/local.php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'host'     => getenv('DB_HOST'),
                    'port'     => getenv('DB_PORT'),
                    'user'     => getenv('DB_USER'),
                    'password' => getenv('DB_PASS'),
                    'dbname'   => getenv('DB_NAME'),
                ],
            ],
        ],
    ],
    'email' => [
        'recruitment' => [
            'from' => 'name@yourdomain.com',
            'from_name' => 'Your Name',
            'replyTo' => [
                'replyto@yourdomain.com' => 'Reply name',
            ],
        ],
        'contact' => [
            /* lista de pares do tipo: email => nome */
            'from' => 'name@yourdomain.com',
            'from_name' => 'Your Name',
            'to' => [
                'contact@exemple.com' => 'Recebedor de emails de contato',
            ],
        ],
    ],
];
EOF
```
### Permissões

Alterar permissões de pastas que manipulam arquivos

```sh
chmod a+w public/docs
chmod a+w data/profile
chmod a+w data/captcha
chmod a+w data/session
chmod a+w data/email
chmod a+w data/script
chmod a+w data/DoctrineModule -R
chmod a+w data/DoctrineORMModule -R
```

### Inicializar o ambiente

Utilizando o docker-compose inicialize o ambiente de desenvolvimento. O ambiente ficará ativo enquanto comando abaixo estiver rodando. Para finalizar pressione Ctrl + C.

A url de acesso é: [localhost:3000](http://localhost:3000).

```
docker-compose up
```

### Criar e importar tabelas do banco de dados

**Importante**: Caso já tenha rodado uma vez os comandos abaixo e queira refazer o banco é aconselhavel remover os arquivos do mysql e recriar o container (não se esqueça de dar Ctrl+c no comando docker-compose up antes de fazer o processo abaixo):

```
sudo rm .docker/mysql/mysql-data/ -rf
docker rm -f catssyssql
docker-compose up
```

Em uma nova aba do terminal:

```sh
docker container exec catssysphp php public/index.php orm:validate-schema
docker container exec catssysphp php public/index.php orm:schema-tool:create
docker container exec catssysphp php public/index.php orm:generate-proxies
docker container exec -it catssyssql sh
cat data/dev-helpers/catssys_data_*.sql | mysql -u catssysdev -p catssys
# Enter password: catssysdev
exit
```

### Instalar as dependências de frontend

Em uma nova aba do terminal:

```
docker container exec catssysjs npm install
```

## Quarta Parte

Abra o navegador e digite http://localhost:3000/. Será exibida uma página que representa o site. Clique em login e insira as credenciais:

```
    username: fcadmin
    password: 177598230afbg#
```

@Todo:

- Adicionar dependencias do composer separadamente (sair do zendframework)

    - Mail
    - Mime
    - Loader
    - Session
    - View
    - ServiceManager
    - Form
    - InputFilter
    - Validator
    - Authentication
    - Mvc
    - Crypt
    - EventManager
    - Permissions
    - Json
    - I18n
    - File
    - Http
    - Filter
    - Stdlib
    - Captcha
    - Hydrator
    - Navigation

- Converter todos os javascripts para versão node e remover o bower

Modulos:
- Authentication: ok
- Authorization: ok

**Observação: Recriar o banco.**