Ext.define('sisscsj.store.usuario.Usuario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.usuario.usuario',
    requires: [
        'sisscsj.model.usuario.Usuario'
    ],
    restPath: 'Usuario',
    storeId: 'Usuario',
    model: 'sisscsj.model.usuario.Usuario'
});