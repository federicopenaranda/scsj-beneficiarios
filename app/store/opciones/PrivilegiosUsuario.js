Ext.define('sisscsj.store.opciones.PrivilegiosUsuario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.privilegiosusuario',
    requires: [
        'sisscsj.model.opciones.PrivilegiosUsuario'
    ],
    restPath: 'PrivilegiosUsuario',
    storeId: 'PrivilegiosUsuario',
    model: 'sisscsj.model.opciones.PrivilegiosUsuario'
});

