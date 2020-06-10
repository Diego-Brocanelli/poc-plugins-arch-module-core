# Arquitetura de Plugins: Módulo Core

Este é um exemplo de módulo compartilhado para uma "Arquitetura de Plugins".

## Objetivo deste pacote

Este é o Módulo Core (módulo principal) de um sistema com Arquitetura de Plugins.

Neste módulo devem se implementadas somente funcionalidades globais que serão 
usadas por todos os outros módulos do sistema.

## A funcionalidade principal

Para gerenciamento do FrontEnd, o "Módulo Core", contém o mecanismo que 
orquestra as dependências para scripts e estilos, decidindo quais devem ser 
desenhados na página HTML.

Para gerenciamento do Backend, o Laravel já faz seu trabalho através dos 
ServiceProviders. Por esse motivo, é desnecessário reinventar a roda.

## Recursos para FrontEnd

### Componentes Javascript e CSS

Este módulo **NÃO deve conter temas ou personalizações**, mas somente a aparência 
padrão que acompanha cada ferramenta.

Por exemplo:

O "Bootstrap4" é um framwork e deverá estar presente em sua forma padrão. 
O "Sweetalert2" é um componente e deve estar presente da aparência padrão.

### Diretivas do Blade

Diretivas do blade, correpondente às ferramentas deverão ser implementados aqui.
Ao invés de implementar o HTML sempre que for usar um componente, é mais produtivo 
criar diretivas no Módulo Core.

> **Importante**: Os recursos de FrontEnd no módulo principal devem se limitar 
a componentização e disponibilidade apenas.

## Recursos para BackEnd

Os recursos do lado do servidor que serão usados de forma global por qualquer 
módulo, devem ser implementados aqui.

### Componentes

Entre os "Componentes Javascript e CSS", podem existir helpers do lado do 
servidor para auxiliar na devolução de dados formatados para a comunicação com 
o FronEnd. O DataTables é um bom exemplo, pois ele precisa receber um formato 
diferente do devolvido pelo Laravel. Um adaptador pode ser implemtado para ser 
usado sempre que for necessário devolver dados para o DataTables.

### Validações

Outra excelente utilidade é a centralização para validações adicionais do Laravel.

Validações de formulário repetitivas devem ser implementadas aqui, propiciando o 
reaproveitamento em qualquer módulo que precise.

### Ferramental

Por fim, todos os comandos e ferramentas que auxiliem na manutenção do sistema 
devem ser providas pelo Módulo Core.

- Comandos do Artisan
- Helpers
- Bibliotecas específicas

