# Api de Cnae e Cid

Essa API foi criada com a função de encontrar cids relacionados a cnaes. Originalmente a 
api foi pensada para ser um módulo do meu outro projeto **ManegerControllGo** que também 
pode ser encontrado aqui no github.

## Inicialização

1. Primeiramente como de costume em aplicativos laravel/lumen iremos configurar 
o arquivo `.env`, copie e cole os dados do arquivo `.env.exemple`

   
2. Após criar o arquivo, insira às suas informações nas três variáveis a seguir.

```
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
```

3. Utilize o seguinte comando para criar as tabelas no banco de dados `php artisan migrate`

Obs. Caso o último passo tenha resultado em algum erro, verifique as configurações
do banco de dados no arquivo `.env`.

4. Após isso execute o comando `php artisan db:seed`

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

`relationship/exists-group`: Essa rota pode receber vários CNAES e vários CIDS
e retorna todos os CNAES e CIDS relacionados

Exemplo de resposta utilizando o seguinte json:

```
{
    "cnaes": [ "1012-1/02", "8411-6/00"],
    "cid10": [ "F10", "F10.0", "A02.0", 
	    "A02.0", "F10.1", "F19", "E10.5", 
	    "E10.6", "E10.7"
	    ]
}
```

resposta: 

```
{
  "status": true,
  "message": [
    {
      "label": "Relações",
      "total": 11,
      "relationship": [
        {
          "codigo_cnae": "1012-1\/02",
          "codigo_cid": "F10"
        },
        ...
        {
          "codigo_cnae": "8411-6\/00",
          "codigo_cid": "F10.1"
        },
        {
          "codigo_cnae": "8411-6\/00",
          "codigo_cid": "F19"
        }
      ]
    }
  ]
}


```











