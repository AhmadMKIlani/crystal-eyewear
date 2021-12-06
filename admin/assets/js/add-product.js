"use strict";

// Class definition
var KTproductsAddproduct = function() {
    // Shared variables
    const element = document.getElementById('kt_modal_add_product');
    const form = element.querySelector('#kt_modal_add_product_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddproduct = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'product_name': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    'price': {
                        validators: {
                            notEmpty: {
                                message: 'price is required'
                            }
                        }
                    },

                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
    }

    return {
        // Public functions
        init: function() {
            initAddproduct();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTproductsAddproduct.init();
});