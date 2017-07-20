Ext.define('sisscsj.store.objetivoespecifico.ObjetivoEspecifico', {
    extend: 'sisscsj.store.Base',
    alias: 'store.objetivoespecifico.objetivoespecifico',
    requires: [
        'sisscsj.model.objetivoespecifico.ObjetivoEspecifico'
    ],
    restPath: 'ObjetivoEspecifico',
    storeId: 'ObjetivoEspecifico',
    model: 'sisscsj.model.objetivoespecifico.ObjetivoEspecifico'
});