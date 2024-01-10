define(['uiComponent', 'jquery', 'ko'], function (Component, $, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'MagentoModules_FeaturedProduct/featured-product-template',
            tracks: {
                stock: true
            },
            intervalPeriod: 5000 // Atualiza a cada 5 segundos
        },

        initialize: function () {
            this._super();
            this.productData = ko.observable({
                name: null,
                price: null,
                stock: null,
                image: null,
                url: null
            });
            this.dataLoaded = false; // Flag para verificar se os dados foram carregados inicialmente
            this.loadProductData();
            this.startAutoRefresh();
        },

        loadProductData: function () {
            let self = this;
            $.ajax({
                url: '/rest/V1/get-featured-product/',
                type: 'GET',
                success: function (response) {
                    if (Array.isArray(response) && response.length === 5) {
                        // Transforma o array em um objeto
                        let [name, price, stock, image, url] = response;

                        if (!self.dataLoaded) {
                            // Carrega todos os dados na primeira vez
                            self.productData({ name, price, stock, image, url });
                            self.dataLoaded = true;
                        } else {
                            // Atualiza apenas o stock nas vezes subsequentes
                            let currentData = self.productData();
                            self.productData(Object.assign({}, currentData, { stock: stock }));
                        }
                    }
                }
            });
        },

        startAutoRefresh: function () {
            let self = this;
            setInterval(function () {
                self.loadProductData();
            }, this.intervalPeriod);
        }
    });
});
