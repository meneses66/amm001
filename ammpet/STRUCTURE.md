# Estrutura do projeto ammpet

Resumo rápido do layout e convenções para desenvolvimento

- Ponto de entrada
  - `public/index.php` — define `ROOTPATH`, carrega `../classes/core/init.php`, cria `new \Core\App` e chama `$app->loadController()`.

- Inicialização
  - `classes/core/init.php` — inclui helpers e arquivos core (`functions.php`, `properties.php`, `_DAO.php`, `_GlobalModel.php`, `_GlobalController.php`, `config.php`, `App.php`).

- Autoload / Namespaces
  - `classes/core/config.php` registra um `spl_autoload_register` que mapeia namespaces para pastas:
    - `Controller\Name` -> `classes/controllers/Name.php`
    - `Model\Name` -> `classes/models/Name.php`
    - `Core\Name` -> `classes/core/Name.php`
    - fallback: procura em `controllers/`, `models/`, `views/` e arquivo base
  - O autoloader usa a constante `ROOTPATH_CLASSES` (definida em `classes/core/properties.php`) e a função `removeFromEnd()` (em `functions.php`) para calcular caminhos.

- Roteamento simples
  - `classes/core/App.php::loadController()` lê `$_GET['url']` (ex.: `animal/list/123`), divide em segmentos e:
    - primeiro segmento -> controller (ex.: `Animal` -> `classes/controllers/Animal.php`)
    - segundo segmento opcional -> método do controller
    - restante -> argumentos passados ao método
  - Constantes `URL_0` e `URL_1` são definidas com controller e method detectados.

- Convenções de pastas
  - Controllers: `classes/controllers/`
  - Models: `classes/models/`
  - Views: `classes/views/` (subpastas por área: `animal/`, `client/`, `orderx/`, etc.)
  - Core/shared: `classes/core/`

- Config e constantes
  - `classes/core/properties.php` define `ROOTPATH_CLASSES`, `ROOT`, `DEBUG`, `DS` e credenciais do DB (atualmente com valores padrão que podem ser sobrescritos por variáveis de ambiente).

- Utilitários
  - `classes/core/functions.php` contém helpers de URL (`URL()`), escape (`esc()`), sessões, CSRF, funções utilitárias e helpers para trabalhar com models/controllers.

Correções realizadas nesta sessão

- Corrigi várias ocorrências de sintaxe inválida do tipo `new ('\\Controller\\'."Name")`, que causavam erro fatal no PHP.
  - Adicionei `instantiate(string $fqcn)` em `classes/core/functions.php` como helper para criar instâncias dinâmicas com segurança.
  - Substituí as instâncias inválidas por chamadas a `instantiate()` em:
    - `classes/core/App.php`
    - `classes/core/functions.php` (uso interno)
    - diversas views em `classes/views/*` (`animal/`, `breed/`, `client/`, `orderitem/`, `orderpayment/`, `orderx/`, `params/`, `product/`, `preclosing/`, `service/`, `salary/`, `supplier/`, etc.)

Observações e recomendações

- Segurança: `properties.php` contém credenciais de DB em texto — recomendo mover para variáveis de ambiente e remover senhas do código.
- Autoload vs require: `App::loadController()` ainda faz `require` manual do arquivo do controller; com o autoloader em funcionamento você pode remover esse `require` e simplesmente instanciar pelo FQCN.
- Tests: Não há testes automatizados (pelo menos não encontrados). Recomendo adicionar um conjunto mínimo de testes (unitários para modelos e integração básica para roteamento).

Como rodar rápido (no container/dev)

- A partir da raiz do projeto, abra um servidor PHP embutido apontando para `public/`:

```bash
# a partir de dentro do container ou devbox na pasta ammpet/
php -S 0.0.0.0:8000 -t public
```

- Acesse `http://localhost:8000` (ou a URL configurada em `properties.php`).

Próximos passos que posso executar

- Remover `require` manual em `App::loadController()` e confiar no autoloader.
- Extrair credenciais sensíveis para variáveis de ambiente e documentar `.env.example`.
- Adicionar um script que lista controllers/models/views disponíveis.
- Incluir testes básicos e rodar um check rápido de sintaxe (php -l) em todo o código.

Se quiser que eu prossiga, diga qual item prefere: 1) remover requires e simplificar o carregamento; 2) extrair credenciais para env; 3) adicionar testes mínimos; 4) outra coisa.
