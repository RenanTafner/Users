# Trabalho de PHP Symfone 
   - Renan
   - Jonatan Souza

# Instalação 
  composer update

# Instalação do Banco de Dados
  php bin/console doctrine:database:create
  php bin/console doctrine:schema:create

# Instalação MySQL Docker

docker run -p 3306:3306 --name mysql1 -e MYSQL_ROOT_PASSWORD=root -d mysql --default-authentication-plugin=mysql_native_password -h 127.0.0.1

# Iniciar o Servidor
  php -S localhost:8000 -t public


# APIs

   # Users
      1 - GET /users
         
      2 - POST /users
          Body: {
            "nome":"Jonatan",
            "sobreNome": "Souza",
            "email":"jonatan@gmail.com"
          }

      3 - DELETE /users/{id}
         
   # Phone  
      1 - GET /user-phone

      2 - POST /user-phone
          Body: {
               "user":1,
               "ddd":"31",
               "number":"9998-4458"
           }
      
      3 - DELETE /user-phone/{id}

   # Address  
      1 - GET /user-address

      2 - POST /user-address
          Body: {
                    "user":1,
                    "rua":"Rua Olimpia",
                    "numero":"123",
                    "complemento":"casa 1",
                    "bairro":"centro",
                    "cidade":"Belo Horizonte",
                    "estado":"MG"
                }
      
      3 - DELETE /user-address/{id}

# Users
  Para executar os testes, execute o comando dentro da pasta raíza depois de ter instalado todas as dependências:

.\vendor\bin\phpunit
