## Processo seletivo UC0026

Este é o projeto desenvolvido para o teste do processo seletivo UC0026. As linguagens utilizadas foram PHP / JavaScript, por meio do framework Laravel. O gerenciador de banco de dados utilizado foi o MySQL.
Um CRUD da tabela de contatos foi criado, e a manipulação da página e banco de dados é auxiliada pelo plugin DataTables.

### Banco de dados

O gerenciador de banco de dados utilizado é o MySQL. O banco de dados (BD) deve ser criado manualmente com o nome de "uau", bem como o login e senha do BD devem ser "root" para ambos. Consultas e/ou alterações dessas informações podem ser feitas no arquivo .env, presente na pasta raíz.
Após a criação do BD, o comando "php artisan migrate" deve ser utilizado para a criação da tabela "contacts". Ao fim da migration, o sistema se encontra pronto para uso, devendo ser iniciado pelo comando "php artisan serve".

### DataTables

O plugin DataTables (https://datatables.net) auxilia na gestão, tanto da view, quanto do banco de dados.
Os contatos são, através do AJAX, exibidos, criados, editados e deletados facilmente, exibindo as alterações sem a necessidade de se atualizar a página.
Os registros podem ser encontrados através do campo de busca, bem como organizados de acordo com o critério desejado (id, nome, telefone, sendo sem ordem crescente ou decrescente).
A base do plugin é em inglês, e o "cross-site request forgery", utilizado pelo Laravel, bloqueia o uso do CDN da tradução, o que justifica algumas partes da view serem na língua estrangeira. Mais tempo e estudo seriam essenciais para a correção do incômodo.

### Rotas

As rotas podem ser encontradas no arquivo "routes/web.php", podendo ser também alteradas, mas alterações na view (contacts.blade.php) também seriam necessárias.
As rotas estabelecidas são:

-   (GET) http://localhost:8000/crud-datatable
-   (POST) http://localhost:8000/store-contact
-   (PATCH) http://localhost:8000/edit-contact
-   (DELETE) http://localhost:8000/delete-contact

Na prática, entretanto, o CRUD é todo feito pelo usuário na rota GET, enquanto as outras rotas são acessadas apenas pelo AJAX.
