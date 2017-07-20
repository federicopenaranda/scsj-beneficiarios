Ext.define('sisscsj.store.opciones.TipoUsuario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.tipousuario',
    requires: [
        'sisscsj.model.opciones.TipoUsuario'
    ],
    restPath: 'TipoUsuario',
    storeId: 'TipoUsuario',
    model: 'sisscsj.model.opciones.TipoUsuario'
});

