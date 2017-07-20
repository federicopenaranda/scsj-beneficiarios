Ext.define('sisscsj.store.opciones.TipoMonitoreoActor', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.tipomonitoreoactor',
    requires: [
        'sisscsj.model.opciones.TipoMonitoreoActor'
    ],
    restPath: 'TipoMonitoreoActor',
    storeId: 'TipoMonitoreoActor',
    model: 'sisscsj.model.opciones.TipoMonitoreoActor'
});