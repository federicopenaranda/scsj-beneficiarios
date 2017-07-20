Ext.define('sisscsj.store.beneficiario.Beneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiario',
    requires: [
        'sisscsj.model.beneficiario.Beneficiario'
    ],
    restPath: 'Beneficiario',
    storeId: 'Beneficiario',
    model: 'sisscsj.model.beneficiario.Beneficiario'
});