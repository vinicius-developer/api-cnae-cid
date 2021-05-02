# Api de Cnae e Cid

Essa API foi criada com a função de encontrar cids relacionados a cnaes. Originalmente a 
api foi pensada para ser um módulo do meu outro projeto **ManegerControllGo** que também 
pode ser encontrado aqui no github.

Para fazer a inicialização rápida do projeto, recomendo que o **docker** e o **docker-compose** 
esteja instalado no dispositivo local, mas caso não esteja não nada o impede de configurar o 
banco de dados de forma simples.


## Inicialização

1. Primeiramente como de costume em aplicativos laravel/lumen iremos configurar 
o arquivo `.env`, copie e cole os dados do arquivo `.env.exemple`

   
2. Após criar o arquivo, insira às suas informações nas três variáveis a seguir.

```
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
```

3. Caso possua o `docker-compose` instalado, rode o seguinte comando no 
terminal `docker-compose build`


4. Rode o comando `docker-compose up` para levantar os containers.


5. Agora precisaremos utilizar um comando dentro do container `app` para realizar
todas as migrations necessárias, utilize o comando `docker-compose exec app php artisan migrate`.

Obs. Caso o último passo tenha resultado em algum erro, verifique as configurações 
do banco de dados no arquivo `.env`.


## Rotas

### CNAE

Exemplo de cnae sem pontuação: 1012101

`/cnae/find/{codigo do cnae sem pontuação}`: É utilizado para pesquisar a informações
de um **cnae**.

Exemplo de resposta do código 1012101: 

```
{
  "status": true,
  "message": [
    {
      "codigo": "1012-1\/01",
      "nome": "Abate de aves"
    }
  ]
}
```

`/cnae/cids/{codigo do cnae sem pontuação}`: É utilizado para listar todos os 
**cid** relacionados a um **cnae** especifico.

Exemplo de resposta do código 1012101:

```
{
  "status": true,
  "message": [
    [
      {
        "codigo": "T90",
        "nome": " de Traumatismo da Cabeça"
      },
      {
        "codigo": "T90.0",
        "nome": " de Traumatismo Superficial da Cabeça"
      },
      ...
      {
        "codigo": "T98.3",
        "nome": " de Complicações Dos Cuidados Médicos e Cirúrgicos Não Classificados em Outra Parte"
      }
    ]
  ]
}
```



### CID

Exemplo de cid em pontuação: T90 

`/cid/find/{codigo do cid sem pontuação}`: É utilizado para retornar as informações
do **cid específico** com base no código dele.

Exemplo de resposta com código T90:

```
{
  "status": true,
  "message": [
    {
      "codigo": "T90",
      "nome": "Sequelas de Traumatismo da Cabeça"
    }
  ]
}
```



`/cid/cnae/{codigo do cid sem pontuação}`: É utilizado para retornar todas dos
**cnaes** que o **cid** tem relação.

Exemplo de resposta do codigo T90:

```
{
  "status": true,
  "message": [
    [
      {
        "codigo": "0210-1\/01",
        "nome": "Cultivo de eucalipto"
      },
      {
        "codigo": "0210-1\/02",
        "nome": "Cultivo de acácia-negra"
      },
      ...
      {
        "codigo": "9420-1\/00",
        "nome": "Atividades de organizações sindicais"
      }
    ]
  ]
}
```

### Relações

Exemplo de cnae sem pontuação: 1012102.

Exemplo de cid sem pontuação: T90.

`relationship/exists/{codigo do cid sem pontuação}/{codigo do cid sem pontuação}`: Essa rota retorna 
um booleano dizendo se **cid** e **cnae** estão relacionados ou não.  

Exemplo de resposta com cnea 1012102 e cid T90.

```
{
  "status": true,
  "message": [
    {
      "exists": true
    }
  ]
}
```












