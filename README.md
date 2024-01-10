# Módulo Featured Product para Magento 2

## Descrição
O módulo "Featured Product" para Magento 2 foi desenvolvido para destacar um produto específico na página inicial da sua loja. Compatível com Magento 2.4.6 e PHP 8.1 ou superior, ele exibe informações importantes do produto como nome, preço, imagem e estoque disponível, atualizando a quantidade de estoque em tempo real.

## Requisitos
- Magento 2.4.6
- PHP 8.1 ou superior

## Instalação
1. Baixe o módulo e descompacte o conteúdo na pasta `app/code/MagentoModules/FeaturedProduct` da sua instalação do Magento.

2. Execute os seguintes comandos no terminal do seu servidor para habilitar o módulo:

    ```bash
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy
    ```

3. Após executar os comandos, limpe o cache do Magento:

    ```bash
    php bin/magento cache:clean
    php bin/magento cache:flush
    ```

## Configuração
Para configurar o módulo:

1. No painel administrativo do Magento, vá para `Lojas -> Todas as Lojas -> Configuração`.

2. Navegue até `Featured Product -> Configurações do Produto em Destaque`.

3. Defina "Habilitar Módulo" para "Sim".

4. Preencha "SKU do Produto em Destaque" com o SKU do produto que deseja destacar.

   _![configure-featured-product](https://github.com/raphaelcordeiro/featured-product-magento2/assets/16678995/febb7dc3-c21d-4733-a3a3-dbe4796fbc19)_

5. Salve a configuração.

## Uso
Uma vez configurado, o produto destacado será exibido na página inicial da sua loja Magento com informações atualizadas em tempo real.

## Suporte
Se você tiver alguma dúvida ou encontrar problemas com a instalação ou configuração do módulo, entre em contato com o suporte técnico.

---
