Ext.define('sisscsj.store.privilegio.Privilegio', {
    extend: 'sisscsj.store.Base',
    alias: 'store.privilegio.privilegio',
    requires: [
        'sisscsj.model.privilegio.Privilegio'
    ],
    restPath: 'usuario/listaPrivilegiosUsuario',
    storeId: 'Privilegio',
    model: 'sisscsj.model.privilegio.Privilegio'
});