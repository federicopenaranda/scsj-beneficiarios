Ext.define('sisscsj.store.monitoreopc.ResultadoMonitoreoPc', {
    extend: 'sisscsj.store.Base',
    alias: 'store.monitoreopc.resultadomonitoreopc',
    requires: [
        'sisscsj.model.monitoreopc.ResultadoMonitoreoPc'
    ],
    restPath: 'ResultadoMonitoreoPc',
    storeId: 'ResultadoMonitoreoPc',
    model: 'sisscsj.model.monitoreopc.ResultadoMonitoreoPc'
});