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
                            let [name, price, stock, image, url] = response;
                            let productObj = { name, price, stock, image, url };
                            self.productData(productObj);
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
