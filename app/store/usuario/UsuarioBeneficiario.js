Ext.define('sisscsj.store.usuario.UsuarioBeneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.usuario.UsuarioBeneficiario',
    requires: [
        'sisscsj.model.usuario.UsuarioBeneficiario'
    ],
    restPath: 'UsuarioBeneficiario',
    storeId: 'UsuarioBeneficiario',
    model: 'sisscsj.model.usuario.UsuarioBeneficiario'
});