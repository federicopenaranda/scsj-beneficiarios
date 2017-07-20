Ext.define('sisscsj.store.monitoreopc.MonitoreoPc', {
    extend: 'sisscsj.store.Base',
    alias: 'store.monitoreopc.monitoreopc',
    requires: [
        'sisscsj.model.monitoreopc.MonitoreoPc'
    ],
    restPath: 'MonitoreoPuntoComunitario',
    storeId: 'MonitoreoPc',
    model: 'sisscsj.model.monitoreopc.MonitoreoPc'
});