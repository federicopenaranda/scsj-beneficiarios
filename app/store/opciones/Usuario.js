Ext.define('sisscsj.store.opciones.Usuario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.usuario',
    requires: [
        'sisscsj.model.opciones.Usuario'
    ],
    restPath: 'Usuario',
    storeId: 'Usuario',
    model: 'sisscsj.model.opciones.Usuario'
});

