# Teste Irroba PHP

Este projeto é um teste prático desenvolvido em Laravel, com o objetivo de demonstrar habilidades em desenvolvimento de APIs RESTful para gerenciamento de um cadastro de produtos.

## Pré-requisitos

Antes de iniciar, certifique-se de ter instalado:

-   PHP (>= 8.0)
-   Composer
-   MySQL
-   Node.js e npm (opcional, para compilar assets)
-   Git

## Instalação

1.  **Clone o repositório:**

    ```bash
    git clone [https://github.com/cadu1324/teste-irroba-php.git](https://github.com/cadu1324/teste-irroba-php.git)
    cd teste-irroba-php
    ```

2.  **Instale as dependências do Composer:**

    ```bash
    composer install
    ```

3.  **Crie o banco de dados e configure o arquivo `.env`:**

    -   Acesse o MySQL usando um cliente de sua preferência (linha de comando, phpMyAdmin, etc.).
    -   Execute o seguinte comando SQL para criar o banco de dados:

    ```sql
    CREATE DATABASE teste_irroba;
    ```

    -   Copie `.env.example` para `.env`: `cp .env.example .env`
    -   Edite o arquivo `.env` com as configurações do banco de dados que você acabou de criar:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=teste_irroba
    DB_USERNAME=seu_usuario_mysql
    DB_PASSWORD=sua_senha_mysql
    ```

    -   Substitua `seu_usuario_mysql` e `sua_senha_mysql` pelas suas credenciais do MySQL.

4.  **Gere a chave da aplicação:**

    ```bash
    php artisan key:generate
    ```

5.  **Execute as migrations:**

    ```bash
    php artisan migrate
    ```

6.  **(Opcional) Instale as dependências do npm e compile os assets:**

    ```bash
    npm install
    npm run dev
    ```

## Execução

1.  **Inicie o servidor de desenvolvimento:**

    ```bash
    php artisan serve
    ```

2.  **Acesse a API:**

    -   A API estará disponível em `http://localhost:8000`.

## Rotas da API

-   `GET /api/produtos`: Lista todos os produtos.
-   `POST /api/produtos`: Cria um novo produto.
-   `GET /api/produtos/{id}`: Exibe um produto específico.
-   `PUT /api/produtos/{id}`: Atualiza um produto.
-   `DELETE /api/produtos/{id}`: Exclui um produto.

## Comandos Úteis

-   `php artisan migrate`: Executa as migrations do banco de dados.
-   `php artisan serve`: Inicia o servidor de desenvolvimento.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

## Licença

Este projeto não possui uma licença definida.
