Ext.define('sisscsj.store.beneficiario.BeneficiarioTipoIdentificacion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiariotipoidentificacion',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioTipoIdentificacion'
    ],
    restPath: 'BeneficiarioTipoIdentificacion',
    storeId: 'BeneficiarioTipoIdentificacion',
    model: 'sisscsj.model.beneficiario.BeneficiarioTipoIdentificacion'
});