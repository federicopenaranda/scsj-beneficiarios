Ext.define('sisscsj.store.familia.FamiliaServicioBasico', {
    extend: 'sisscsj.store.Base',
    alias: 'store.familia.familiaserviciobasico',
    requires: [
        'sisscsj.model.familia.FamiliaServicioBasico'
    ],
    restPath: 'FamiliaServicioBasico',
    storeId: 'FamiliaServicioBasico',
    model: 'sisscsj.model.familia.FamiliaServicioBasico'
});