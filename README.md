Olá meu nome é Marcelo Pereira 😉
é com satifação que faço esse teste, pois é uma experiência a mais.

Aqui listarei o passo-a-passo para a instalação do projeto, como foi requisito, usei docker para conteinizar meu projeto.

Vamos começando subindo o projeto, basta digitar o comando:
`docker-compose up -d`

É esperado que o projeto estaja rodando, se for esse o caso vamos intalar as dependencias do laravel, digitando o comando:
`docker-compose exec laravel.test composer install`

NOTA: `laravel.test` foi criado, pode ser que o nome possa estar diferente para você. Para ver o nome da imagem, basta digitar:
`docker-compose ps`

Estando com as depencias OK 👌, vamos agora rodar as migrates, utilizando o comando:
`docker-compose exec laravel.test php artisan migrate`

NOTA: lembre-se que o nome da imagem pode ser diferente, basta consultar utilizando o comando:
`docker-compose ps`


MUITO OBRIGADO PELA OPORTUNIDADE, SÃO ESSAS EXPERIÊNCIAS QUE NOS TORNAM MELHORES A CADA DIA!
FIQUEM COM DEUS! 🫡
