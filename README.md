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
    git clone [https://github.com/cadu1324/teste-irroba-php.git](https://www.google.com/search?q=https://github.com/cadu1324/teste-irroba-php.git)
    cd teste-irroba-php
    ```

2.  **Instale as dependências do Composer:**

    ```bash
    composer install
    ```

3.  **Configure o arquivo `.env`:**

    -   Copie `.env.example` para `.env`: `cp .env.example .env`
    -   Configure as variáveis de ambiente, especialmente as configurações do banco de dados.

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
