define([
    'ko',
    'uiComponent',
    'jquery'
], function (ko, Component, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'PerfectCode_ConnectionButton/connection',
            connectionFailedMessage: 'Connection test failed.',
            url: '',
            success: false,
            message: '',
            visible: false
        },

        /**
         * Init observable variables
         * @return {Object}
         */
        initObservable: function () {
            this._super()
                .observe([
                    'success',
                    'message',
                    'visible'
                ]);

            return this;
        },

        /**
         * @override
         */
        initialize: function () {
            this._super();
            this.messageClass = ko.computed(function () {
                return 'message-validation message message-' + (this.success() ? 'success' : 'error');
            }, this);

            if (!this.success()) {
                this.showMessage(false, this.connectionFailedMessage);
            }
        },

        /**
         * @param {bool} success
         * @param {String} message
         */
        showMessage: function (success, message) {
            this.message(message);
            this.success(success);
            this.visible(true);
        },

        /**
         * Send request to server to test connection to Adobe Stock API and display the result
         */
        testConnection: function () {
            this.visible(false);

            $.ajax({
                type: 'POST',
                url: this.url,
                dataType: 'json',
                success: function (response) {
                    this.showMessage(response.success === true, response.message);
                }.bind(this),
                error: function () {
                    this.showMessage(false, this.connectionFailedMessage);
                }.bind(this)
            });
        }
    });
});
