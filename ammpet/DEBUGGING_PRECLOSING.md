# Diagnóstico de Comissões Zeradas - Módulo Pre-Closing

## Logs Implementados para Debugging

Para identificar por que os valores das comissões estão saindo zerados no módulo Pre-Closing, foram adicionados logs detalhados usando a função `amm_log()`. Os logs são armazenados em:

```
/workspaces/amm001/ammpet/classes/core/log_amm/log_amm_YYYY-MMM-DD.log
```

## Logs Adicionados

### 1. Controller PreClosing - Construtor
- **Log**: Quando o controller é instanciado
- **Formato**: `PRE_CLOSING: Controller PreClosing instanciado por usuário: [username]`

### 2. Método update_comission() - Entrada
- **Log**: Parâmetros recebidos
- **Formato**: 
  - `PRE_CLOSING: update_comission chamado com inputs: [JSON dos inputs]`
  - `PRE_CLOSING: Ano processado: [ano], Mês processado: [mês]`
  - `PRE_CLOSING: Modo de operação: [calc|batch]`

### 3. Funcionário Individual - Dados
- **Log**: Informações do funcionário sendo processado
- **Formato**:
  - `PRE_CLOSING: ID do funcionário: [id]`
  - `PRE_CLOSING: Dados do funcionário encontrados: [JSON dos dados]`
  - `PRE_CLOSING: Tipo do funcionário: '[tipo]', Nome: '[nome]'`

### 4. Modo Batch - Processamento
- **Log**: Cada funcionário processado no modo batch
- **Formato**:
  - `PRE_CLOSING: Processando funcionário (batch) - ID: [id], Nome: '[nome]', Tipo: '[tipo]'`
  - `PRE_CLOSING: Resultado cálculo (batch) - Serv: [valor], Prod: [valor], Banhos: [quantidade]`

### 5. Função compute_commissions() - Entrada
- **Log**: Parâmetros da função de cálculo
- **Formato**:
  - `PRE_CLOSING: compute_commissions iniciado - Ano: [ano], Mês: [mês], Tipo: [tipo], Nome: [nome]`
  - `PRE_CLOSING: Opções recebidas: [JSON das opções]`
  - `PRE_CLOSING: Dias no mês: [quantidade]`

### 6. Query de Banhos
- **Log**: Query SQL e resultado dos banhos
- **Formato**:
  - `PRE_CLOSING: Query banhos - SQL: [SQL]`
  - `PRE_CLOSING: Resultado query banhos: [JSON do resultado]`
  - `PRE_CLOSING: Total de banhos encontrados: [total]`
  - `PRE_CLOSING: Contagem por dia: [JSON por dia]`

### 7. Parâmetro de Banhistas
- **Log**: Número de banhistas usado no cálculo
- **Formato**:
  - `PRE_CLOSING: Número de banhistas das opções: [valor]`
  - `PRE_CLOSING: Buscando parâmetro BAN_PRE_CLOSING com nome: [YYYYMM]`
  - `PRE_CLOSING: Resultado do parâmetro: [JSON]`
  - `PRE_CLOSING: Número de banhistas do parâmetro: [valor]`
  - `PRE_CLOSING: Número final de banhistas usado: [valor]`

### 8. Cálculo de Comissão de Serviço
- **Log**: Processo de cálculo para diferentes tipos de funcionário
- **Formato**:
  - `PRE_CLOSING: Iniciando cálculo de comissão de serviço para tipo: [tipo]`
  - **Para Banhista**:
    - `PRE_CLOSING: Calculando comissão para Banhista`
    - `PRE_CLOSING: Dia [dia] - Banhos: [quantidade], Fator: [fator], Comissão dia: [valor]`
    - `PRE_CLOSING: Comissão total serviço (Banhista): [valor]`
  - **Para Veterinário**:
    - `PRE_CLOSING: Calculando comissão para Veterinário`
    - `PRE_CLOSING: Query veterinário - SQL: [SQL]`
    - `PRE_CLOSING: Resultado query veterinário: [JSON]`
    - `PRE_CLOSING: Item veterinário - VWD: [valor], QTY: [qtd], EXT: [custo], PERC: [percentual]`
    - `PRE_CLOSING: Comissão item (qty > 0): [valor]` ou `PRE_CLOSING: Comissão item (qty = 0): [valor]`
    - `PRE_CLOSING: Comissão total serviço (Veterinário): [valor]`

### 9. Cálculo de Comissão de Produto
- **Log**: Processo de cálculo de comissão de produtos
- **Formato**:
  - `PRE_CLOSING: Iniciando cálculo de comissão de produto para funcionário: '[nome]'`
  - `PRE_CLOSING: Query produto - SQL: [SQL]`
  - `PRE_CLOSING: Parâmetros query produto - YEAR: [ano], MONTH: [mês], SP: '[nome]'`
  - `PRE_CLOSING: Resultado query produto: [JSON]`
  - `PRE_CLOSING: Comissão produto encontrada: [valor]`
  - `PRE_CLOSING: Nome do funcionário está vazio, comissão de produto será 0`

### 10. Resultado Final
- **Log**: Resultado final dos cálculos
- **Formato**: `PRE_CLOSING: Resultado final - Serviço: [valor], Produto: [valor], Total Banhos: [quantidade]`

### 11. Ajax_call - Debug (já existente)
- **Log**: Chamadas AJAX quando DEBUG=true
- **Formato**:
  - `[HH:MM:SS] AJAX_IN class=[classe] method=[método] session=[usuário] keys=[[chaves]] csrf_present=[yes|no]`
  - `[HH:MM:SS] AJAX_OUT class=[classe] method=[método] type=[tipo] size=[tamanho]`

## Como Usar os Logs para Diagnóstico

### 1. Reproduzir o Problema
1. Acesse o módulo Pre-Closing
2. Tente calcular comissões (botão "Calcular" ou "Criar/Atualizar Comissões")
3. Observe se as comissões aparecem como zero

### 2. Verificar os Logs
```bash
# Ver o log do dia atual
tail -f /workspaces/amm001/ammpet/classes/core/log_amm/log_amm_$(date +%Y-%b-%d).log

# Ou filtrar apenas logs do PRE_CLOSING
grep "PRE_CLOSING" /workspaces/amm001/ammpet/classes/core/log_amm/log_amm_$(date +%Y-%b-%d).log
```

### 3. Pontos de Verificação

**Verificar se a função é chamada:**
```
PRE_CLOSING: update_comission chamado com inputs:
```

**Verificar dados do funcionário:**
```
PRE_CLOSING: Dados do funcionário encontrados:
PRE_CLOSING: Tipo do funcionário: '[tipo]', Nome: '[nome]'
```

**Verificar se existem banhos no período:**
```
PRE_CLOSING: Total de banhos encontrados: [número]
```

**Verificar parâmetro de banhistas:**
```
PRE_CLOSING: Número final de banhistas usado: [número]
```

**Verificar cálculo de comissão:**
```
PRE_CLOSING: Comissão total serviço (Banhista): [valor]
PRE_CLOSING: Comissão produto encontrada: [valor]
PRE_CLOSING: Resultado final - Serviço: [valor], Produto: [valor]
```

## Possíveis Causas de Comissões Zeradas

Com base nos logs, você pode identificar:

1. **Nenhum dado de ORDER_ITEM** - Total de banhos = 0
2. **Parâmetro de banhistas não configurado** - Usando valor padrão 1.0
3. **Tipo de funcionário não reconhecido** - Não é "Banhista" nem "Veterinaria"
4. **Nome do funcionário vazio** - Comissão de produto sempre 0
5. **Query SQL não retorna resultados** - Problema com filtros de data/funcionário
6. **Fatores diários incorretos** - Todos os fatores são 0 ou muito baixos
7. **Percentuais de comissão zerados** - COMISSION_PERCENTAGE = 0 nos produtos/serviços

## Teste dos Logs

Um arquivo de teste foi criado em `/workspaces/amm001/ammpet/test_log.php` para verificar se a função `amm_log` está funcionando corretamente.

Execute: `php test_log.php` no diretório `/workspaces/amm001/ammpet/`