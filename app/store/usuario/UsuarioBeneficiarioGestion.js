Ext.define('sisscsj.store.usuario.UsuarioBeneficiarioGestion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.usuario.usuariobeneficiariogestion',
    requires: [
        'sisscsj.model.usuario.UsuarioBeneficiarioGestion'
    ],
    restPath: 'beneficiario/gestionbeneficiarioactual',
    storeId: 'UsuarioBeneficiarioGestion',
    model: 'sisscsj.model.usuario.UsuarioBeneficiarioGestion'
});