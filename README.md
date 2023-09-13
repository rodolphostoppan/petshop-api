# FindAFriend Petshop - API

Essa aplicação foi desenvolvida para executar todo o backend, desde tratamento de dados e erros, até registro no banco de dados.

## Pré-Requisitos

- Linguagem de programação: PHP 8.1+
- Dependências: Composer

## Instalação

1. Clone este repositório: `git clone https://github.com/rodolphostoppan/petshop-api.git`
2. Acesse o diretório da aplicação: `cd petshop-api`
3. Instale as dependências: `composer install`

## Observação

1. Caso queira conectar ao banco de dados do projeto:
   - Vá até o arquivo php.ini (pode-se ver onde ela está localizada através do comando `php --ini` no terminal).
   - Abra o arquivo com qualquer editor de texto e procure pela linha que está escrito "extension=pdo_sqlite", descomente e salve o arquivo.
2. Agora é só usar a ferramenta de manipulação de banco de dados que preferir, usei o DBeaver durante esse projeto.

## Instruções de Uso

1. Clone a aplicação do repositório https://github.com/rodolphostoppan/petshop-front e rode na porta do localhost que preferir ou então acesse o link https://rodolphostoppan.github.io/petshop-front/ e use a vontade.
   - Esse link acima trata-se do frontend da aplicação com um formulário de contato
   - A ideia desse backend é manipular e tratar os dados recebidos desse site do petshop
2. Inicie o servidor na porta 8080: `php -S localhost:8080`
3. Acesse a aplicação em http://localhost:8080
4. Na página inicial não mostrará nada, já em http://localhost:8080/showdb.php mostrará todos os dados cadastrados no banco de dados em formato JSON.
