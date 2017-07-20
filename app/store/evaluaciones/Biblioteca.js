Ext.define('sisscsj.store.evaluaciones.Biblioteca', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.biblioteca',
    requires: [
        'sisscsj.model.evaluaciones.Biblioteca'
    ],
    restPath: 'Biblioteca',
    storeId: 'Biblioteca',
    model: 'sisscsj.model.evaluaciones.Biblioteca'
});