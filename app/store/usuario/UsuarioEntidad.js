Ext.define('sisscsj.store.usuario.UsuarioEntidad', {
    extend: 'sisscsj.store.Base',
    alias: 'store.usuario.UsuarioEntidad',
    requires: [
        'sisscsj.model.usuario.UsuarioEntidad'
    ],
    restPath: 'UsuarioEntidad',
    storeId: 'UsuarioEntidad',
    model: 'sisscsj.model.usuario.UsuarioEntidad'
});