Ext.define('sisscsj.store.monitoreoactor.MonitoreoActor', {
    extend: 'sisscsj.store.Base',
    alias: 'store.monitoreoactor.monitoreoactor',
    requires: [
        'sisscsj.model.monitoreoactor.MonitoreoActor'
    ],
    restPath: 'MonitoreoActor',
    storeId: 'MonitoreoActor',
    model: 'sisscsj.model.monitoreoactor.MonitoreoActor'
});