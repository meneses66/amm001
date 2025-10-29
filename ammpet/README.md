# AMMPet — Aplicação (ammpet)

Este repositório contém a aplicação AMMPet (PHP) — um sistema web com arquitetura simples baseada em namespaces, controllers, models e views.

## Objetivo
Breve guia para desenvolvedores: como configurar, executar e entender as convenções do projeto.

## Requisitos
- PHP 8.0+ (recomendado 8.1+)
- MySQL/MariaDB
- Extensão PDO MySQL habilitada

## Estrutura principal
- `public/` — ponto de entrada (contém `index.php`) e assets públicos.
- `classes/core/` — bootstrap, configuração, helpers, classes base e autoload.
- `classes/controllers/` — controllers da aplicação (namespace `Controller`).
- `classes/models/` — models (namespace `Model`).
- `classes/views/` — views organizadas por área.
- `classes/builder/` — código utilitário/gerador (samples podem conter código de exemplo incompleto).

## Convenções importantes
- Autoload personalizado: mapeia `Controller\Name` -> `classes/controllers/Name.php` e `Model\Name` -> `classes/models/Name.php`.
- Use a função helper `instantiate(string $fqcn)` em `classes/core/functions.php` para criar instâncias dinamicamente a partir de FQCNs quando necessário.
- Evitar `require_once` manuais para controllers/views — o autoloader resolve as classes automaticamente.

## Configuração via `.env`
Coloque um arquivo `.env` na raiz do projeto (`/path/to/ammpet/.env`). Não comite esse arquivo no repositório.

Exemplo mínimo (`.env`):

```
DB_HOST=seu-host-do-banco
DB_PORT=3306        # opcional
DB_NAME=dbpetshop
DB_USER=ammphp
DB_PASS=sua_senha
```

Notas sobre formatos aceitos:
- Recomendado: `DB_HOST=hostname` e opcional `DB_PORT=3306`.
- Suportado: `DB_HOST=hostname:3307` (o parser vai extrair a porta).
- Suportado: `DB_HOST=hostname/` (a barra final será removida).

O loader de `.env` reside em `classes/core/functions.php` e tenta carregar `../../.env` relativo a `classes/core` (ou seja, `ammpet/.env`). Ele popula `getenv()`, `$_ENV` e `$_SERVER` sem sobrescrever variáveis já existentes no ambiente.

### Diferença entre `localhost` e `127.0.0.1`
- `localhost` frequentemente usa socket UNIX no PHP/MySQL — o MySQL identifica conexões como `'user'@'localhost'`.
- `127.0.0.1` força conexão TCP — o MySQL identifica como `'user'@'127.0.0.1'` (ou corresponde a `'user'@'%'`).
- Se o usuário do MySQL foi criado como `'ammphp'@'%'`, usar `127.0.0.1` ou o host real costuma funcionar. Caso o usuário exista apenas como `'ammphp'@'localhost'`, use `DB_HOST=localhost` ou crie o usuário/grant apropriado.

## Teste rápido de conexão (CLI)
No diretório do projeto, rode:

```bash
php -r 'define("ROOTPATH", true); require "classes/core/functions.php"; require "classes/core/properties.php"; try { $dsn = "mysql:host=".SERVERNAME.(defined("DB_PORT")?";port=".DB_PORT:"").";dbname=".DBNAME.";charset=utf8mb4"; $pdo=new PDO($dsn, DBUSER, DBPWD); echo "CONNECTED\n"; } catch (PDOException $e) { echo "PDO ERROR: ".$e->getMessage()."\n"; }'
```

Isto retornará `CONNECTED` em caso de sucesso, ou uma mensagem de erro do PDO para diagnóstico.

## Logs
A aplicação grava logs em `classes/log_amm/` quando `DEBUG` está ativado (configuração em `classes/core/properties.php`).

## Como rodar localmente (dev)
A partir da raiz do projeto (`ammpet/`):

```bash
php -S 0.0.0.0:8000 -t public
```

Abra `http://localhost:8000` no navegador.

## Boas práticas e segurança
- Não comite `.env` — inclua apenas `.env.example` no repositório.
- Restrinja privilégios do usuário do banco: privilégios CRUD (SELECT/INSERT/UPDATE/DELETE) costumam ser suficientes. Conceda DDL só se necessário e com cautela.

## Mudanças recentes importantes
- Padronizei instanciações dinâmicas com `instantiate()` e removi várias instâncias inválidas (ex.: `new('\Controller\\'+...)`) que causavam erros fatais no PHP.
- Adicionado loader simples de `.env` e suporte a `DB_HOST` com `:port` ou `DB_PORT` separado. O `classes/core/_DAO.php` agora monta corretamente o DSN com host e port.

## Próximos passos sugeridos
- Adicionar testes automáticos básicos (unit e integração mínima).
- Remover `require` manuais restantes e confiar completamente no autoloader.
- Externalizar outras configurações sensíveis para variáveis de ambiente.

## Contribuindo
1. Crie uma branch baseada em `main20251020` para suas mudanças.
2. Faça pequenas commits e abra PR para revisão.

---

Se quiser, eu posso:
- Criar um `scripts/db_check.php` para facilitar testes de conexão;
- Atualizar README com instruções para execução via Docker/compose;
- Criar um branch e commitar as mudanças aplicadas.

Diga o que prefere e eu implemento.
