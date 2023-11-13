# Projeto de Consulta de Endereços


Este sistema permite a consulta de endereços via CEP e armazenamento dos dados. Utiliza-se JavaScript para interação com a API [ViaCEP](https://viacep.com.br/). Os registros armazenados podem ser ordenados por cidade, bairro e estado, tanto em ordem crescente quanto decrescente.

## Como Executar

### Com Docker Compose (Recomendado)
> **Nota:** *Para utilização do docker-compose, não são necessárias configurações adicionais. Use apenas o comando a seguir:*
```shell
docker-compose up -d
``````

### Execução Local
1. **Configuração do Ambiente**:
   - Copie `.env.example` para `.env` e ajuste as variáveis conforme necessário.
2. **Criação do Banco de Dados**:
   - Execute `docker build -t custom_postgres ./database`.
3. **Iniciar Servidor**:
   - Execute `composer serve`.

### O projeto estará rodando em:
- http://localhost:8000/
### Características
- **Arquitetura**: Como decidi não utilizar framworks foi necessário seguir alguns padrões de arquitetura e design como
Clean Architecture e Domain-Driven Design (DDD) para uma estrutura de projeto clara e manutenível.
- **Tecnologia**: Uso de PHP puro para flexibilidade e controle detalhado.
- **Infraestrutura**: Sistema dockerizado com build multistage para facilitar a configuração e o deployment.
- **CI**: Integração contínua para garantir qualidade e estabilidade do código.

## Componentes

### Use-Cases
- **ListAddresses**: Lista endereços armazenados, demonstrando aplicação dos princípios de DDD.
- **StoreAddress**: Permite o armazenamento de endereços consultados, integrando front-end e back-end.

### Domain
- **AddressEntity**: Entidade central no domínio, representando um endereço.
- **Value Objects**:
  - **ZipCode**: Validação e encapsulamento de lógica relacionada a CEPs.
  - **BrazilianState**: Representação e validação de estados brasileiros.

### Infrastructure
- **Controllers**: Pontos de entrada da aplicação, gerenciando requisições e respostas.
- **Models**: Representação dos dados e lógica de negócios.
- **Routes**: Mapeamento de URLs para controllers, definindo a estrutura da aplicação web.
- **Views**: Interface com o usuário, implementada em PHP para renderização dinâmica.
